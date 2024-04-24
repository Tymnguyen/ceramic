<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogComment;
use App\Models\Role;
use App\Models\SalesVolumeByCategory;
use App\Models\SellingOrder;
use App\Models\SellingOrderDetails;
use App\Models\SellOrderSummary;
use App\Models\User_Employee;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }


    public function index()
    {
        return view('/admin/index');
    }

    public function dashboard()
    {
        //Yearly selling orders
        $salesQuantityPivot = SellOrderSummary::where('sellingyear',$this->now->year)->get();
        $orderQuantityData = [];
        foreach($salesQuantityPivot as $item){
            $orderQuantityData[] = [
                'x' => $item->sellingyear.' '.$item->sellingmonth,
                'y' => $item->ordercount
            ];
        }
        $jsonStringOrders = json_encode($orderQuantityData);

        //Total sales amount (yearly)
        $currentYear = date('Y'); 
        $totalSales = SellingOrder::where('status', 1)
                                    ->whereYear('createdat', $currentYear)
                                    ->sum('grandtotalamount');

        //Current month selling amount compare with privious month    
        $currentMonthSales = SellingOrder::where('status', 1)
            ->whereMonth('createdat', $this->now->month)
            ->whereYear('createdat', $this->now->year)
            ->sum('grandtotalamount');

        $priviousMonthSales = SellingOrder::where('status', 1)
            ->whereMonth('createdat', $this->now->subMonth()->month)
            ->whereYear('createdat', $this->now->year)
            ->sum('grandtotalamount');

        if ($priviousMonthSales != 0) {
            $montlySalesCompare = (($currentMonthSales - $priviousMonthSales) / $priviousMonthSales) * 100;
        } else {
            // Handle the case where $previousMonthSales is zero to avoid division by zero
            $montlySalesCompare = 100;
        }

        //Blog summary  
        $blogSummary = [
            'totalarticle' => BlogArticle::where('deleted', 0)->count(),
            'totalview' => BlogArticle::where('deleted', 0)->sum('viewcount'),
            'totalcomment' => BlogComment::where('deleted', 0)->where('status', 1)->count(),
            'mostviewarticle' => BlogArticle::where('viewcount', BlogArticle::max('viewcount'))->pluck('name')->first(),
            'mostviewarticleid' => BlogArticle::where('viewcount', BlogArticle::max('viewcount'))->pluck('id')->first(),
        ];

        //Employee summary  
        $employeeSummary = [
            'totalemployee' => User_Employee::where('deleted', 0)->count(),
            'totallocked' => User_Employee::where('deleted', 0)->whereNotNull('lockendat')->count(),
            'totalrole' => Role::where('deleted', 0)->count(),
            'supperadminusers' => User_Employee::where('deleted', 0)->where('roleid',1)->count(),
        ];

        //Sale volume by category    
        $salesByCategory = SalesVolumeByCategory::get();

        $data = [
            'totalSales' => $totalSales,
            'monthlySalesCompare' => [
                'thismonth' => $currentMonthSales,
                'percentage' => round($montlySalesCompare,2)
            ],
            'yearlyOrders' => [
                'year' => $this->now->year,
                'ordercount' => SellingOrder::where('status', 1)->count(),
                'monthlyquantity' => $jsonStringOrders
            ],
            'blogsummary'=>$blogSummary,
            'employeesummary'=>$employeeSummary,
            'salesbycategory'=>$salesByCategory,
        ];

        return view('/admin/dashboard')->with($data);
    }
}
