<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleFunction;
use App\Models\User_Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    protected  $maximumLoginFailCount;
    protected  $accountLockDuration; 
    protected  $tokenDuration;
    protected  $now; //UTC

    public function __construct()
    {
        $this->maximumLoginFailCount = 5;
        $this->accountLockDuration = 1;
        $this->tokenDuration = 10;
        $this->now = Carbon::now()->utc();
    }
    //Login screen
    public function login()
    {
        if(Auth::guard('admin')->check()) return Redirect('/admin/index');
        return view('/admin/login');
    }

    // This POST function will be triggered after the user enters a username and password and hits login on the login screen.
    // The login process includes locking the user if there are repeated login attempts over a specific number of times (both the number of attempts and the duration are specified in the constructor).
    public function verifylogin(Request $request)
    {
        //Get username, password and remember me check box value from HTTP request
        $username = $request->input('email_username');
        $password = $request->input('password');
        $rememberme = $request->input('remember_me') == null ? false : $request->input('remember_me');

        //Check: username or password is empty
        if ($username == null || $password == null)
            return Redirect('/admin/login')->with('errorMessage', 'Email or Password is empty, Please enter value!');

        // Check: Ensure that the username exists uniquely in the database. If there are multiple entries for the same username, prevent the user from logging in.
        $UserHasSameUsername = User_Employee::where('email', $username)->get();
        
        if ($UserHasSameUsername->count() != 1)
            return Redirect('/admin/login')->with('errorMessage', 'Something is wrong with your email');

        // Identify the user who needs to check their login status
        $userNeedToAuthenticate = $UserHasSameUsername->first();

        // Check: Reset lockout if duration has expired
        if ($userNeedToAuthenticate->lockendat != null && $this->now->gt($userNeedToAuthenticate->lockendat)) {
            $userNeedToAuthenticate->loginfailcount = 0;
            $userNeedToAuthenticate->lockendat = null;
            $userNeedToAuthenticate->save();
        }

        // Warning: Notify user of final login attempt
        if ($userNeedToAuthenticate->loginfailcount == ($this->maximumLoginFailCount - 1)) {
            $userNeedToAuthenticate->loginfailcount++;
            $userNeedToAuthenticate->save();

            return Redirect('/admin/login')->with('errorMessage', 'Your account will be locked if an incorrect password is entered one more time');
        }

        // Check: If user's login failure count exceeds quota, add lock duration
        // Only need to check if lockendat == null since we have a script to reset lock duration upon expiry
        if ($userNeedToAuthenticate->loginfailcount >= $this->maximumLoginFailCount) {
            if ($userNeedToAuthenticate->lockendat == null)
                $userNeedToAuthenticate->lockendat = $this->now->addMinutes($this->accountLockDuration);

            $userNeedToAuthenticate->save();

            return Redirect('/admin/login')->with('errorMessage', 'Your account has been locked due to multiple login fail attempts. Please try again after ' . strval($this->accountLockDuration) . ' minutes');
        }

        // Check: Authenticate username and password
        if (Auth::guard('admin')->attempt(['email' => $username, 'password' => $password], $rememberme)) {

            // Reset login failure count if user login is successful
            $userNeedToAuthenticate->loginfailcount = 0;
            $userNeedToAuthenticate->save();

            //Generate session    
            $request->session()->regenerate();
            $userrole = Role::find($userNeedToAuthenticate->roleid);
            $userfunctions = RoleFunction::where('roleid', $userNeedToAuthenticate->roleid)
                ->where('deleted', 0)
                ->with('function')
                ->get();

            $request->session()->put('role', $userrole->name);
            $request->session()->put('profilepic', $userNeedToAuthenticate->profilepicture);
            $request->session()->put('userfunctions', $userfunctions);

            return Redirect('/admin/index');

        } else {

            // Increment login failure count if user enters incorrect password
            $userNeedToAuthenticate->loginfailcount++;
            $userNeedToAuthenticate->save();

            return Redirect('/admin/login')->with('errorMessage', 'Password is not correct');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect('/admin/login');
    }

    public function forgotpassword()
    {
        return view('/admin/forgotpassword');
    }

    public function sendresetpasswordtoken(Request $request)
    {
        $emailToReset = $request->input('email');

        // Check: Return error when user does not input an email
        if($emailToReset == null || $emailToReset == '') return Redirect('/admin/forgotpassword')->with('errorMessage', 'Please enter email');;

        // Check: Return an error if the provided email does not exist in the database
        $checkUserExists = User_Employee::where('deleted',0)->where('email',$emailToReset)->first();
        if(!$checkUserExists) return Redirect('/admin/forgotpassword')->with('errorMessage', 'Email is not correct');

        // Generate a token and add it to the database
        $checkUserExists->resetpasswordtoken = Str::random(45);
        $checkUserExists->tokenexpiredat = $this->now->addMinutes($this->tokenDuration);
        $checkUserExists->save();
        
        // Send email with token with provided email
        Mail::send('/mailingtemplate/forgotpassword', array('name'=>$checkUserExists->firstname,'resettoken'=>$checkUserExists->resetpasswordtoken), function($message) use ($emailToReset){
	        $message->to($emailToReset, 'Admin')->subject('Cera Tiles - Reset password!');
	    });
        
        return Redirect('/admin/login')->with('successMessage', 'Reset token has been sent to your mail box!');
    }

    // Access to this screen is restricted to users with a valid and existing token
    public function setnewpassword($token)
    {  
        // Check if token exists
        $checkTokenExist = User_Employee::where('deleted',0)->where('resetpasswordtoken',$token)->first();
        if($checkTokenExist == null) return Redirect('/admin/login')->with('jsalert', 'This reset password request has expired. Please generate a new one');
        if($checkTokenExist->tokenexpiredat != null && $this->now->gt($checkTokenExist->tokenexpiredat)) return Redirect('/admin/login')->with('errorMessage', 'This token is expired!');

        // Send token to the view for use by the resetpasswordwithtoken function, which identifies the user.
        $data = [
            'token' => $token,
        ];

        return view('/admin/setnewpassword')->with($data);
    }

    public function resetpasswordwithtoken(Request $request)
    {  
        $token = $request->input('token'); 
        $newPassword = $request->input('password'); 
        $confirmPassword = $request->input('confirmpassword'); 

        if($token == null || $newPassword == null || $confirmPassword == null) return Redirect('/admin/setnewpassword/'.$token)->with('errorMessage', 'Please enter require information');
        if($newPassword != $confirmPassword) return Redirect('/admin/setnewpassword/'.$token)->with('errorMessage', 'Password and confirm password are not matched');
        if(strlen($newPassword) < 8) return Redirect('/admin/setnewpassword/'.$token)->with('errorMessage', 'Password must contain at least 8 characters');

        // Check if token one more time
        $checkTokenExist = User_Employee::where('deleted',0)->where('resetpasswordtoken',$token)->first();

        if($checkTokenExist == null) return Redirect('/admin/login')->with('errorMessage', 'Token is not correct');

        $userToResetPassword = User_Employee::where('deleted',0)->where('resetpasswordtoken',$token)->first();
        if($userToResetPassword->tokenexpiredat != null && $this->now->gt($userToResetPassword->tokenexpiredat)) return Redirect('/admin/login')->with('errorMessage', 'This token is expired!');

        // Update password in the database and clear the token
        $password_brcrypt = password_hash($newPassword, PASSWORD_BCRYPT);
        $userToResetPassword->resetpasswordtoken = null;
        $userToResetPassword->tokenexpiredat = null;
        $userToResetPassword->password = $password_brcrypt;
        $userToResetPassword->save();

        return Redirect('/admin/login')->with('successMessage', 'Change password successfully!');
    }


    public function changepassword(){
        return view('admin/changepassword');
    }

    public function changepassword_post(Request $request){
        $userInput = $request->all();

        
        $validator = validator($request->all(), [
            'currentpassword' => 'required|max:250',
            'newpassword' => 'required|max:250|confirmed',
            'password_confirmation' => 'required|max:250',

        ], [
            'currentpassword.required' => 'Please enter current password',
            'currentpassword.max' => 'Current password cannot exceed 250 characters',

            'newpassword.required' => 'Please enter new password',
            'newpassword.max' => 'New password cannot exceed 250 characters',
            'newpassword.confirmed' => 'Password and confirm password are not matched',

            'password_confirmation.required' => 'Please enter confirm new password',
            'password_confirmation.max' => 'Confirm new password cannot exceed 250 characters',
        ]);

        //Validation fail
        if ($validator->fails()) 
            return Redirect('/admin/changepassword')
                ->withInput($request->all())
                ->withErrors($validator)
                ->with('errorMessage', 'Please kindly check your input data!');


        $sessionUser = Auth::guard('admin')->user();

        if (Hash::check($userInput['currentpassword'], $sessionUser->password)) {
            $userToUpdate = User_Employee::find($sessionUser->id);
            $userToUpdate->password = Hash::make($userInput['newpassword']);
            $userToUpdate->save();
            return Redirect('admin/index')->with('successMessage', 'Change password successfully!');;
        }
        else{
            return Redirect('admin/changepassword')->with('errorMessage', 'Password is not correct');
        }
    }


    public function notauthorized()
    {  
        return view('/admin/notauthorized');
    }
}
