<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCost;
use App\Models\DeliveryFee;
use App\Models\Functions;
use App\Models\Role;
use App\Models\RoleFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FeeController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function deliveryfee()
    {
        $deliveryFee = DeliveryFee::where('deleted', '=', 0)->get();
        $data = [
            'deliveryfees' => $deliveryFee
        ];
        return view('/admin/deliveryfee')->with($data);
    }

    public function editdeliveryfee($id)
    {
        return response()->json(DeliveryFee::find($id), 200);
    }

    public function deletedeliveryfee($id)
    {
        $sessionUser = Auth::guard('admin')->user();

        $deliveryFeeToDelete = DeliveryFee::find($id);

        if($deliveryFeeToDelete == null) return back()->with('errorMessage', 'Delivery fee id not found');
        
        $deliveryFeeToDelete->deleted = 1;
        $deliveryFeeToDelete->lastmodifiedby = $sessionUser->id;
        $deliveryFeeToDelete->lastmodifiedat = $this->now;

        $deliveryFeeToDelete->save();

        return Redirect('/admin/deliveryfee')->with('successMessage', 'Delivery fee has been deleted');
    }

    public function upsertdeliveryfee(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();
        $userInput = $request->all();
        //dd($userInput['cost']);
        $validator = Validator::make(['input' => $userInput['cost']], [
            'input' => 'numeric',
        ]);

        if (!$validator->passes()) return back()->with('errorMessage', 'Cost must be a number');

        //Add new
        if(isset($userInput['id']) && $userInput['id'] != null && $userInput['id'] != ''){
            $deliveryFeeToEdit = DeliveryFee::find($userInput['id']);
            $deliveryFeeToEdit->name = $userInput['name'];
            $deliveryFeeToEdit->cost = $userInput['cost'];
            $deliveryFeeToEdit->remark = $userInput['remark'];
            $deliveryFeeToEdit->lastmodifiedat = $this->now;
            $deliveryFeeToEdit->lastmodifiedby = $sessionUser->id;
            $deliveryFeeToEdit->save();

            return Redirect('/admin/deliveryfee')->with('successMessage', 'Delivery fee has been revised');
        }
        else{
            $newDeliveryFee = [
                'name' => $userInput['name'],
                'cost' => $userInput['cost'],
                'remark' => $userInput['remark'],
                'deleted' => 0,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];
            $returnedId = DeliveryFee::create($newDeliveryFee)->id;

            return Redirect('/admin/deliveryfee')->with('successMessage', 'Delivery fee has been created');
        }

    }
}
