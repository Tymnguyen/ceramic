<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SellingOrder;
use App\Models\SellingOrderDetails;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function orderlist()
    {
        $orders = SellingOrder::where('status',1)->with('buyer')->orderBy('createdat', 'desc')->get();
        return view('/admin/orders')->with(['orders'=>$orders]);
    }

    public function orderdetails($id)
    {
        $orderDetails = SellingOrderDetails::where('sellingorderid',$id)->with('product')->with('delivery')->with('voucher')->get();
        if($orderDetails == null) return redirect()->back()->with('errorMessage', 'Order ID not found');
        return view('/admin/orderdetails')->with(['orderdetails'=>$orderDetails]);
    }

}
