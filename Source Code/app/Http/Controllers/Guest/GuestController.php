<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\ContactRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GuestController extends Controller {
    public function index(){
        $newProducts = Product::where('deleted',0)->latest('createdat')->take(8)->get();
        $data = [
            'newproducts'=> $newProducts,
        ];
        return view('/guest/index')->with($data);
    }

    public function contact(){
        $companyInfo = CompanyInfo::find(1);
        $data = [
            'companyinfo'=>$companyInfo
        ];
        return view('/guest/contact')->with($data);
    }

    public function requestcontactme(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        $validator = validator($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|string|max:250',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'Please enter your name',
            'name.string' => 'Your name must be a string',
            'name.max' => 'Your name cannot exceed 250 characters',

            'email.required' => 'Please enter your email',
            'email.string' => 'Email must be a string',
            'email.max' => 'Email cannot exceed 250 characters',

            'message.required' => 'Please input your message',
            'message.string' => 'Message must be a string',
            'message.max' => 'Message cannot exceed 1000 characters',
        ]);

        //Validation fail
        if ($validator->fails()) 
            return Redirect('/contact')
                ->withInput($request->all())
                ->withErrors($validator)
                ->with('errorMessage', 'Please check errors and correct your input!');

        $request = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'contactback' => 0,
            'deleted' => 0,
            'createdat' => Carbon::now()->utc(),        
        ];

        $createdUser = ContactRequest::create($request);
        
        return Redirect('/contact')->with('successMessage', 'Thank you, your contact info has been sent. Our staff will contact you as soon as they are available');
    }


}

?>