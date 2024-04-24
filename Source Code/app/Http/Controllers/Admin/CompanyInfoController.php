<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CompanyInfoController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function companyinfo()
    {
        $companyInfo = CompanyInfo::find(1);
        if($companyInfo == null){
            return view('/admin/companyinfo');
        }
        else{
            $data = [
                'companyinfo' => $companyInfo,
            ];
            return view('/admin/companyinfo')->with($data);
        }
    }

    public function upsertcompanyinfo(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();

        $id = $request->input('id');
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $fax = $request->input('fax');
        $email = $request->input('email');
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $embedmapurl = $request->input('embedmapurl');

        $validator = validator($request->all(), [
            'name' => 'required|string|max:250',
            'address' => 'required|string|max:250',
            'phone' => 'required|string|max:50',
            'fax' => 'max:100',
            'email' => 'required|string|max:250',
            'longitude' => 'max:50',
            'latitude' => 'max:50',
            'embedmapurl' => 'string|max:1000',

        ], [
            'name.required' => 'Please enter company name',
            'name.string' => 'Company name must be a string',
            'name.max' => 'Company name cannot exceed 250 characters',

            'address.required' => 'Please enter address',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address cannot exceed 250 characters',

            'phone.required' => 'Please enter phone',
            'phone.string' => 'Phone must be a string',
            'phone.max' => 'Phone cannot exceed 250 characters',

            'fax.max' => 'Fax cannot exceed 100 characters',

            'email.required' => 'Please enter company email',
            'email.string' => 'Email must be a string',
            'email.max' => 'Email cannot exceed 250 characters',

            'longitude.max' => 'Longitude cannot exceed 50 characters',

            'latitude.max' => 'Latitude cannot exceed 50 characters',

            'embedmapurl.max' => 'Embed map url cannot exceed 1000 characters',
        ]);

        //Validation fail
        if ($validator->fails()) 
            return Redirect('/admin/companyinfo')
                ->withInput($request->all())
                ->withErrors($validator)
                ->with('errorMessage', 'Please kindly check your input data!');

        if($id == null || $id == ''){
            $role = [
                'name' => $name,
                'address' => $address,
                'phone' => $phone,
                'fax' => $fax,
                'email' => $email,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'embedmapurl' => $embedmapurl,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now,
                'lastmodifiedby' => $sessionUser->id,
                'lastmodifiedat' => $this->now,
            ];

            $returnedId = CompanyInfo::create($role)->id;

            return Redirect('/admin/companyinfo')->withInput($request->all())->with('successMessage', 'Company information has been created');
        }
        else{
            $companyInfo = CompanyInfo::find(1);
            if($companyInfo == null) return Redirect('/admin/companyinfo')->with('errorMessage', 'Company information not found');

            $companyInfo->name = $name;
            $companyInfo->address = $address;
            $companyInfo->phone = $phone;
            $companyInfo->fax = $fax;
            $companyInfo->email = $email;
            $companyInfo->longitude = $longitude;
            $companyInfo->latitude = $latitude;
            $companyInfo->embedmapurl = $embedmapurl;
            $companyInfo->lastmodifiedby = $sessionUser->id;
            $companyInfo->lastmodifiedat = $this->now;

            $companyInfo->save();

            return Redirect('/admin/companyinfo')->withInput($request->all())->with('successMessage', 'Company information has been revised');
        }
    }



}
