<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\SellingOrder;
use App\Models\SellingOrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class GuestPaymentController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function transactioncomplete()
    {
        return view('/guest/transactioncomplete');
    }

    public function checkout(Request $request)
    {
        if (!session()->has('shoppingcart')) return Redirect('product/shoppingcart');

        $validator = validator($request->all(), [
            'fullname' => 'required|string|max:250',
            'address' => 'required|string|max:1000',
            'phone' => 'required|max:50',
            'email' => 'required|email|max:250',
        ], [
            'fullname.required' => 'Please enter full name',
            'fullname.string' => 'Full name must be a string',
            'fullname.max' => 'Full name cannot exceed 250 characters',

            'address.required' => 'Please enter address',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address cannot exceed 1000 characters',

            'phone.required' => 'Please enter your phone number',
            'phone.max' => 'Phone number cannot exceed 500 characters',

            'email.required' => 'Please enter your email',
            'email.email' => 'Email is not valid',
            'email.max' => 'Email cannot exceed 250 characters',
        ]);

        if ($validator->fails())
            return Redirect('/product/confirmorder')
                ->withInput($request->all())
                ->withErrors($validator)
                ->with('errorMessage', 'Please kindly check your input data!');

        $cart = Session::get('shoppingcart', []);
        $userInput = $request->all();
        $transaction = [
            'buyerid' => (session()->has('userid') ? session('userid') : null),
            'fullname' => $userInput['fullname'],
            'address' => $userInput['address'],
            'phone' => $userInput['phone'],
            'email' => $userInput['email'],
            'transactionid',
            'status' => 0,
            'completepaymentat' => null,
            'subtotalamount' => $cart['subtotalamount'],
            'voucheramount' => (isset($cart['voucher']) ? $cart['voucher']['amount'] : 0),
            'deliverycostamount' => (isset($cart['delivery']) ? $cart['delivery']['amount'] : 0),
            'grandtotalamount' => $cart['grandtotalamount'],
            'createdat' => $this->now,
        ];

        $currentTransactionId = SellingOrder::create($transaction)->id;
        Session::put('currenttransaction', $currentTransactionId);

        //Connect with paypal
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => url('/payment/checkoutresult'),
                "cancel_url" => url('/payment/checkoutresult'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $cart['grandtotalamount']
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    public function checkoutresult(Request $request)
    {
        if ($request->token == null || $request->token == '') return Redirect('product/shoppingcart');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['error'])) {
            $data = [
                'status' => 'Error',
                'message' => 'Your order have not placed yet due to some issue: <b>' . $response['error']['name'] . '</b> during payment process',
            ];
            return view('/guest/transactioncomplete')->with($data);
        } else {
            $transaction = SellingOrder::find(session('currenttransaction'));
            $buyerEmail = $transaction->email;
            $transId = $transaction->id;
            $transaction->transactionid = $response['id'];
            $transaction->status = 1;
            $transaction->completepaymentat = $this->now;
            $transaction->save();

            $cart = Session::get('shoppingcart', []);
            //Add delivery data
            if (isset($cart['delivery'])) {
                $transactionDetails = [
                    'sellingorderid' => session('currenttransaction'),
                    'type' => 'Delivery',
                    'productid' => null,
                    'deliveryid' => $cart['delivery']['id'],
                    'voucherid' => null,
                    'quantity' => 1,
                    'amount' => $cart['delivery']['amount'],
                    'addedat' => $this->now,
                ];
                SellingOrderDetails::create($transactionDetails);
            }
            //Add voucher data
            if (isset($cart['voucher'])) {
                $transactionDetails = [
                    'sellingorderid' => session('currenttransaction'),
                    'type' => 'Voucher',
                    'productid' => null,
                    'deliveryid' => null,
                    'voucherid' => $cart['voucher']['id'],
                    'quantity' => 1,
                    'amount' => $cart['voucher']['amount'],
                    'addedat' => $this->now,
                ];
                SellingOrderDetails::create($transactionDetails);
            }
            if (isset($cart['products'])) {
                foreach ($cart['products'] as $item) {
                    $transactionDetails = [
                        'sellingorderid' => session('currenttransaction'),
                        'type' => 'Product',
                        'productid' => $item['productid'],
                        'deliveryid' => null,
                        'voucherid' => null,
                        'quantity' => $item['quantity'],
                        'amount' => $item['itemamount'],
                        'addedat' => $item['modifiedat'],
                    ];
                    SellingOrderDetails::create($transactionDetails);
                }
            }

            // Send email with token with provided email
            Mail::send('/mailingtemplate/orderplacement', array('name' => $transaction->fullname,'orderid' => $transaction->id, 'subtotal' => $transaction->subtotalamount,'voucheramount' => $transaction->voucheramount,'deliverycost' => $transaction->deliverycostamount, 'totalamount' => $transaction->grandtotalamount), function ($message) use ($buyerEmail,$transId) {
                $message->to($buyerEmail, 'Guest')->subject('Cera Tiles - Order placement ('.$transId.')');
            });


            $data = [
                'status' => 'Success',
                'message' => 'Your order will be delivered in the next 4-7 days, depending on your area',
                'transactionid' => $response['id'],
            ];

            $request->session()->forget('shoppingcart');
            $request->session()->forget('currenttransaction');

            return view('/guest/transactioncomplete')->with($data);
        }
    }

    public function myorders()
    {
        if(!session()->has('userid')) return Redirect('/');
        $myOrders = SellingOrder::where('status',1)->where('buyerid',session('userid'))->get();

        return view('/guest/myorders')->with(['myorders'=>$myOrders]);
    }

    public function myorderdetails($id)
    {
        if(!session()->has('userid')) return Redirect('/');
        $myOrderDetails = SellingOrderDetails::where('sellingorderid',$id)->with('product')->with('delivery')->with('voucher')->get();
        //dd($myOrderDetails);
        return view('/guest/myorderdetails')->with(['myorderdetails'=>$myOrderDetails]);
    }
}
