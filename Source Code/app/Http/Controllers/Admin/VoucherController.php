<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class VoucherController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }


    public function voucherlist()
    {
        $voucherList = Voucher::where('deleted', '=', 0)->get();
        $data = [
            'vouchers' => $voucherList
        ];
        return view('/admin/voucherlist')->with($data);
    }

    public function upsertvoucher($id = null)
    {
        $voucherToRevise = Voucher::find($id);
        $data = [
            'vouchers' => $voucherToRevise
        ];
        return view('/admin/upsertvoucher')->with($data);
    }

    public function upsertvoucherpost(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();

        $userInput = $request->all();

        $validator1 = Validator::make(['input' => $userInput['type']], [
            'type' => 'in:Percentage discount on amount,Fixed discount value on amount,Percentage discount on shipping,Fixed discount value on shipping',
        ]);

        if (!$validator1->passes())             
            return Redirect('/admin/upsertvoucher')
            ->withInput($request->all())
            ->withErrors($validator1)
            ->with('errorMessage', 'Please kindly check your input data!');

        $validator2 = validator($request->all(), [
            'type' => 'required|string|max:150',
            'vouchercode' => 'required|string|min:5|max:50',
            'description' => 'max:500',
            'value' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'validfrom' => 'required|date|date_format:Y-m-d',
            'validto' => 'required|date|date_format:Y-m-d|after:validfrom',
        ], [

            'type.required' => 'Please select voucher type',
            'type.string' => 'Voucher type must be a string',
            'type.max' => 'Voucher type cannot exceed 150 characters',

            'vouchercode.required' => 'Please enter voucher code',
            'vouchercode.string' => 'Voucher code must be a string',
            'vouchercode.min' => 'Voucher code cannot exceed 150 characters',
            'vouchercode.max' => 'Voucher code cannot exceed 150 characters',

            'description.max' => 'Description cannot exceed 500 characters',

            'value.required' => 'Please enter value number',
            'value.numeric' => 'Value must be a number',
            'value.min' => 'Value must greater than 0',

            'quantity.required' => 'Please enter quantity',
            'quantity.numeric' => 'Quantity must be a number',
            'quantity.min' => 'Quantity must greater than 0',

            'validfrom.required' => 'Please enter valid from',
            'validfrom.date' => 'Valid from must be a number',
            'validfrom.date_format' => 'Vlaid from date format is not correct',

            'validto.required' => 'Please enter valid from',
            'validto.date' => 'Valid from must be a number',
            'validto.date_format' => 'Vlaid from date format is not correct',
            'validto.after' => 'Valid to must be greater than valid from',
        ]);

        if ($validator2->fails()) 
            return Redirect('/admin/upsertvoucher')
                ->withInput($request->all())
                ->withErrors($validator2)
                ->with('errorMessage', 'Please kindly check your input data!');



        if(isset($userInput['id']) && $userInput['id'] != ''&& $userInput['id'] != null){
            $voucherToEdit = Voucher::find($userInput['id']);

            $checkDuplicateCode = Voucher::where('vouchercode',$userInput['vouchercode'])->count();
            if ($checkDuplicateCode > 0) 
                return Redirect('/admin/upsertvoucher')
                    ->withInput($request->all())
                    ->withErrors($validator2)
                    ->with('errorMessage', 'Voucher code exists. Please use different voucher code');

            $voucherToEdit->type = $userInput['type'];
            $voucherToEdit->description = $userInput['description'];
            $voucherToEdit->vouchercode = str_replace(' ','',$userInput['vouchercode']);
            $voucherToEdit->quantity = $userInput['quantity'];
            $voucherToEdit->validfrom = $userInput['validfrom'];
            $voucherToEdit->validto = $userInput['validto'];
            $voucherToEdit->lastmodifiedat = $this->now;
            $voucherToEdit->lastmodifiedby = $sessionUser->id;

            $voucherToEdit->save();

            return Redirect('/admin/voucherlist')->with('successMessage', 'Voucher revised');
        }
        else{
            $checkDuplicateCode = Voucher::where('vouchercode',str_replace(' ','',$userInput['vouchercode']))->count();
            if ($checkDuplicateCode > 0) 
                return Redirect('/admin/upsertvoucher')
                    ->withInput($request->all())
                    ->withErrors($validator2)
                    ->with('errorMessage', 'Voucher code exists. Please use different voucher code');

            $voucher = [
                'type' => $userInput['type'],
                'vouchercode' => $userInput['vouchercode'],
                'description' => $userInput['description'],
                'value' => $userInput['value'],
                'quantity' => $userInput['quantity'],
                'validfrom' => $userInput['validfrom'],
                'validto' => $userInput['validto'],
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];
    
            Voucher::create($voucher);
            return Redirect('/admin/voucherlist')->with('successMessage', 'Voucher created');
        }

    }


}
