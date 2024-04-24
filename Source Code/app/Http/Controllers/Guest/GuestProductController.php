<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeliveryFee;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\SellingOrder;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;


class GuestProductController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function listproduct(Request $request)
    {
        $products = Product::where('deleted', 0)
        ->whereHas('subcategory', function ($query) {
            $query->whereHas('category', function ($query) {
                $query->where('deleted', 0);
            })->where('deleted', 0);
        });

        //dd($products);

        $minselling = max(0, Product::orderBy('sellingprice', 'asc')->first()->sellingprice - 1);;
        $maxselling = max(0, Product::orderBy('sellingprice', 'desc')->first()->sellingprice + 1);

        if ($request->query('categoryid') != null && $request->query('categoryid') != '') {
            $category = Category::where('deleted', 0)->where('id', $request->query('categoryid'))->with('subcategories')->first();
            if ($category) {
                $subcategoryIds = $category->subcategories->pluck('id')->toArray();
                $products =  $products->whereIn('subcategoryid', $subcategoryIds);
            }
        }
        if ($request->input('searchtext') != null && $request->input('searchtext') != '')
            $products =  $products->where('name', 'like', '%' . $request->input('searchtext') . '%');

        if ($request->query('subcategoryid') != null && $request->query('subcategoryid') != '')
            $products =  $products->where('subcategoryid', $request->query('subcategoryid'));

        if ($request->query('min') != null && $request->query('min') != '' && $request->query('max') != null && $request->query('max') != '') {
            $minPrice = $request->query('min');
            $maxPrice = $request->query('max');
            if (isset($minPrice) || isset($maxPrice)) {
                $minPrice = $minPrice ?? 0;
                $maxPrice = $maxPrice ?? PHP_INT_MAX;
                $products = $products->where('sellingprice', '>=', $minPrice)->where('sellingprice', '<=', $maxPrice);
            }
        }

        $products = $products->paginate(9);
        // dd($products);
        $categories = Category::where('deleted', 0)->with('subcategories')->get();
        $data = [
            'products' => $products,
            'categories' => $categories,
            'minselling' => $minselling,
            'maxselling' => $maxselling,
        ];
        return view('/guest/listproduct')->with($data);
    }



    public function addtocart($id,$quantity = null)
    {
        $productToAdd = Product::find($id);


        $cart = Session::get('shoppingcart', []);

        // Check if the item is already in the cart
        if (isset($cart[$id])) {
            // If so, update the quantity
            $cart['products'][$id]['quantity'] += 1;
            $cart['products'][$id]['modifiedat'] = $this->now;
            $cart['products'][$id]['itemamount'] = round($cart['products'][$id]['quantity'] * $cart['products'][$id]['sellingprice'], 2);
        } else {
            // Otherwise, add a new item to the cart
            $cart['products'][$id] = [
                'productid' => $productToAdd->id,
                'mainimage' => $productToAdd->mainimage,
                'quantity' => ($quantity == null ? 1: $quantity),
                'modifiedat' => $this->now,
                'productname' => $productToAdd->name,
                'sellingprice' => $productToAdd->sellingprice,
                'itemamount' => ($quantity == null ? $productToAdd->sellingprice : round($quantity*$productToAdd->sellingprice,2)),
            ];
        }

        Session::put('shoppingcart', $cart);

        return response()->json(count($cart['products']), 200);
    }

    public function removefromcart($id)
    {
        $cart = Session::get('shoppingcart', []);

        // Remove the item from the cart if it exists
        if (isset($cart['products'][$id])) {
            unset($cart['products'][$id]);
        }
        // Store the updated cart data back in the session
        Session::put('shoppingcart', $cart);

        return Redirect('/product/shoppingcart')->with('warningMessage', 'Item removed');
    }

    public function addtocompare($id)
    {
        $productToAdd = Product::find($id);
        $compare = Session::get('comparecart', []);
        $compare['products'][$id] = $productToAdd->id;
        Session::put('comparecart', $compare);

        return response()->json(count($compare['products']), 200);
    }

    public function removefromcompare($id)
    {
        $compare = Session::get('comparecart', []);

        // Remove the item from the cart if it exists
        if (isset($compare['products'][$id])) {
            unset($compare['products'][$id]);
        }
        // Store the updated cart data back in the session
        Session::put('comparecart', $compare);

        return redirect()->back()->with('warningMessage', 'Item removed');
    }

    public function compareproducts()
    {
        if (!session()->has('comparecart')) return view('/guest/compareproduct');
        $compareSession = session('comparecart')['products'];
        $listIds = array_values($compareSession);

        $compareProducts = Product::where('deleted', 0)->whereIn('id', $listIds)->get();

        return view('/guest/compareproduct')->with(['compareProducts' => $compareProducts]);
    }

    public function revisecartquantity($id, $quantity)
    {
        $cart = Session::get('shoppingcart', []);

        // Check if the item is already in the cart
        if (isset($cart['products'][$id])) {
            // If so, update the quantity
            $cart['products'][$id]['quantity'] = $quantity;
            $cart['products'][$id]['itemamount'] = round($quantity * $cart['products'][$id]['sellingprice'], 2);
            $cart['products'][$id]['modifiedat'] = $this->now;
        } else {
            // Otherwise, add a new item to the cart
            $productToAdd = Product::find($id);

            $cart['products'][$id] = [
                'productid' => $productToAdd->id,
                'mainimage' => $productToAdd->mainimage,
                'quantity' => 1,
                'modifiedat' => $this->now,
                'productname' => $productToAdd->name,
                'sellingprice' => $productToAdd->sellingprice,
                'itemamount' => $productToAdd->sellingprice,
            ];
        }

        $subTotalAmount = 0;
        foreach ($cart['products'] as $item) {
            $subTotalAmount += $item['itemamount'];
        }

        $cart['subtotalamount'] = round($subTotalAmount, 2);

        // Store the updated cart data back in the session
        Session::put('shoppingcart', $cart);

        $data = [
            'newquantity' => $quantity,
            'newamount' => $cart['products'][$id]['itemamount'],
            'subtotalamount' => $cart['subtotalamount'],
        ];

        return response()->json($data, 200);
    }


    public function shoppingcart()
    {
        if (!session()->has('shoppingcart')) return view('/guest/shoppingcart');

        $cart = Session::get('shoppingcart', []);
        //dd($cart);
        $products = Product::where('deleted', 0)->get();
        $subTotalAmount = 0;
        //&$item in this case, mean make a reference item to the original array element, not making a copy of it
        foreach ($cart['products'] as &$item) {
            $product = $products->find($item['productid']);
            if ($product == null) return back()->with('errorMessage', 'An item in your cart not found');

            $subTotalAmount +=  $item['itemamount'];
        }
        $cart['subtotalamount'] = $subTotalAmount;

        Session::put('shoppingcart', $cart);

        return view('/guest/shoppingcart');
    }

    public function confirmorder()
    {
        if (!session()->has('shoppingcart')) return view('/guest/shoppingcart');

        $deliveryCost = DeliveryFee::where('deleted', 0)->get();

        $cart = Session::get('shoppingcart', []);

        $subTotalAmount = 0;

        foreach ($cart['products'] as $item) {
            $subTotalAmount +=  $item['itemamount'];
        }

        $cart['subtotalamount'] = $subTotalAmount;

        $voucherAmount = isset($cart['voucher']) ? round($cart['voucher']['amount'], 2) : 0;
        $deliveryAmount = isset($cart['delivery']) ? round($cart['delivery']['amount'], 2) : 0;

        $cart['grandtotalamount'] = max(round(($subTotalAmount + $deliveryAmount) - $voucherAmount, 2), 0);

        Session::put('shoppingcart', $cart);

        return view('/guest/confirmorder')->with(['deliverycost' => $deliveryCost]);
    }

    public function getdeliverycost($id)
    {
        $deliveryCost = DeliveryFee::where('deleted', 0)->find($id);

        //Add/Update delivery code and amount to session shoppingcart    
        $cart = Session::get('shoppingcart', []);
        $cart['delivery']['id'] = $deliveryCost->id;
        $cart['delivery']['amount'] = round($deliveryCost->cost, 2);
        Session::put('shoppingcart', $cart);

        //Return data to update on view
        $data = [
            'deliverycost' => $cart['delivery']['amount'],
            'newamount' => round($cart['subtotalamount'] + $cart['delivery']['amount'], 2),
        ];

        return response()->json($data, 200);
    }

    public function applyvoucher(Request $request)
    {
        $voucherCode = $request->input('vouchercode');
        $voucherToCheck = Voucher::where('vouchercode', $voucherCode)->first();

        if ($voucherToCheck == null)
            return Redirect('/product/confirmorder')
                ->withInput($request->all())
                ->with('errorMessage', 'Voucher is not valid');

        if (($this->now < $voucherToCheck->validfrom) || ($this->now > $voucherToCheck->validto))
            return Redirect('/product/confirmorder')
                ->withInput($request->all())
                ->with('errorMessage', 'Voucher expired');

        if ($voucherToCheck->quantity == 0)
            return Redirect('/product/confirmorder')
                ->withInput($request->all())
                ->with('errorMessage', 'This voucher has been fully redeemed');

        //Update sessiong soppingcart
        $cart = Session::get('shoppingcart', []);
        $subTotalamount = 0;
        foreach ($cart['products'] as $item) {
            $subTotalamount +=  $item['itemamount'];
        }

        $cart['subtotalamount'] = $subTotalamount;
        $deliverycost = isset($cart['delivery']) ? $cart['delivery']['amount'] : 0;
        $cart['voucher']['code'] =  $voucherCode;
        $cart['voucher']['type'] =  $voucherToCheck->type;
        $cart['voucher']['id'] =  $voucherToCheck->id;
        if ($voucherToCheck->type == 'Percentage discount on amount') {
            $amountDiscount = $subTotalamount * (round($voucherToCheck->value / 100, 2));
            $cart['voucher']['amount'] = round($amountDiscount, 2);
        } else if ($voucherToCheck->type == 'Fixed discount value') {
            $amountDiscount = $voucherToCheck->value;
            $cart['voucher']['amount'] = round($amountDiscount, 2);
        } else if ($voucherToCheck->type == 'Percentage discount on shipping') {
            $amountDiscount = isset($cart['delivery']) ? $cart['delivery']['amount'] * (round($voucherToCheck->value / 100, 2)) : 0;
            $cart['voucher']['amount'] = round($amountDiscount, 2);
        }

        $cart['grandtotalamount'] = max(($subTotalamount + $deliverycost) - $amountDiscount, 0);
        Session::put('shoppingcart', $cart);

        //dd(session('shoppingcart'));

        return Redirect('/product/confirmorder')
            ->withInput($request->all())
            ->with('successMessage', 'Voucher added');
    }

    public function removevoucher(Request $request)
    {
        $cart = Session::get('shoppingcart', []);

        // Remove the item from the cart if it exists
        if (isset($cart['voucher'])) {
            unset($cart['voucher']);
        }
        // Store the updated cart data back in the session
        Session::put('shoppingcart', $cart);

        return Redirect('/product/confirmorder')
            ->withInput($request->all())
            ->with('warningMessage', 'Voucher removed');
    }


    public function productdetails($id)
    {
        $categories = Category::where('deleted', 0)->with('subcategories')->get();
        //Get product data and related images that has deleted column = 0
        $product = Product::with(['productimages' => function ($query) {
            $query->where('deleted', 0);
        }])->find($id);

        $randomRelatedProducts = Product::where('deleted',0)->where('id','!=',$product->id)->where('subcategoryid',$product->subcategoryid)->inRandomOrder()->limit(4)->get();

        //Only user bought product can comment on it
        $alreayBuy = false;
        if(session()->has('userid')){
            $checkUserOrder = SellingOrder::where('buyerid',session('userid'))->whereHas('sellingDetails', function ($query) use ($id) {
                $query->where('productid', $id);
            })->first();

            if($checkUserOrder != null) $alreayBuy = true;
        }

        $reviews = ProductReview::where('deleted',0)->where('status',1)->where('productid',$id)->with('createby')->get();

        $data = [
            'categories' => $categories,
            'product' => $product,
            'relatedproducts' => $randomRelatedProducts,
            'alreadyboughtthisitem' => $alreayBuy,
            'reviews'=>$reviews,
        ];

        return view('/guest/productdetails')->with($data);
    }


    public function productaddreview(Request $request)
    {
        $inputData = $request->all();
        if($inputData['id'] == null || $inputData['id'] == 0) return back()->with('errorMessage', 'Product ID not found');

        if($inputData['commenttext'] == null || $inputData['commenttext'] == '') return back()->with('errorMessage', 'Please enter your review');
        if(strlen($inputData['commenttext']) >1000) return back()->with('errorMessage', 'Your review must under 1000 characters');

        $product = Product::where('deleted',0)->find($inputData['id']);
        if($product == null) return back()->with('errorMessage', 'Product not found');

        $review =[
            'userid'=>session('userid'),
            'commentcontent' => $inputData['commenttext'],
            'productid' => $inputData['id'],
            'status' => 0,
            'deleted' => 0,
            'createdby' => session('userid'),
            'createdat' => $this->now,
        ]; 

        ProductReview::create($review);

        return redirect()->back()->with('successMessage', 'Your review has been submitted');
    }


    public function deletemyreview($id)
    {
        $reviewTobeDeleted = ProductReview::where('deleted',0)->find($id);
        if($reviewTobeDeleted == null) return redirect()->back()->with('errorMessage', 'Review not found');

        if(session('userid') != $reviewTobeDeleted->createdby) return redirect()->back()->with('errorMessage', 'You cannot delete this review');

        $reviewTobeDeleted->deleted = 1;
        $reviewTobeDeleted->save();

        return redirect()->back()->with('successMessage', 'Your review has been deleted');
    }

}
