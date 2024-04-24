<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\UserBuyer;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GuestAuthController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function login(Request $request)
    {
        //Get current domain with port(if any)
        //This step to save current url, when user login successfully, they will be redirect to where they were
        $currentUrlDomain = url()->to('/');
        $allowedDomain =  env('DOMAIN_ALLOWED');    
        if ($currentUrlDomain === $allowedDomain) {
            Session::put('previous_url', url()->previous());
        } else {
            Session::put('previous_url', env('DOMAIN_ALLOWED'));
        }

        //If user already login, redirect them to myaccount page
        if(session()->has('userid')) return Redirect('auth/myaccount');

        return view('/guest/login');
    }


    public function verifylogin(Request $request)
    {

        //Get username and pssword from HTTP request
        $email = $request->input('signinemail');
        $password = $request->input('signinpassword');

        //Check: username or password is empty
        if ($email == null || $password == null)
            return Redirect('/auth/login')->with('errorMessage', 'Email or Password is empty, Please enter value!');

        //Check: username is exists in DB (If somehow there are 2 emails in DB, then prevent user from login)
        $UserHasSameUsername = UserBuyer::where('email', $email)->where('accounttype','Registed')->get();

        if ($UserHasSameUsername->count() != 1)
            return Redirect('/auth/login')->with('errorMessage', 'Email or Password is not correct');

        $userNeedToAuthenticate = $UserHasSameUsername->first();

        //Check: entered password is matched with user password (BCRYPT)
        if (Auth::guard('buyer')->attempt(['email' => $email, 'password' => $password])) {
            $userNeedToAuthenticate->resetpasswordtoken = null;
            $userNeedToAuthenticate->tokenexpiredat = null;
            $userNeedToAuthenticate->save();

            //Set session information
            $this->generateSession($userNeedToAuthenticate->id, $userNeedToAuthenticate->fullname, $userNeedToAuthenticate->email, asset('guestasset') . '/img/noAvatar.jpg', 'Registed', $request);
            
            //Get user current page to redirect them back to where they were
            $previousUrl = Session::pull('previous_url', '/');

            return redirect()->intended($previousUrl);
        } 
        //Process when username or password is not correct
        else {
            return Redirect('/auth/login')->with('errorMessage', 'Password is not correct');
        }
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookcallback(Request $request)
    {
        if(isset($request['error']))
            return Redirect('/auth/login')->with('errorMessage', 'Login using facebook fails!');

        //Get data from callback
        $user = Socialite::driver('facebook')->user();
        $userid = $user->getId();
        $useremail = $user->getEmail();
        $username = $user->getName();
        $useravatar = $user->getAvatar();

        //In facebook login, there is an option allow user not share their email, this step will inform user to share email to us
        if ($useremail == null ||  $useremail == '') return Redirect('/auth/login')->with('errorMessage', 'Login using facebook fails! You many need to let us know your email associate with your facebook!');

        $checkIfUserLoginBefore = UserBuyer::where('socialiteid', $userid)->where('accounttype', 'Facebook')->count();

        //If facebook account haven't login before, create an account on DB
        if ($checkIfUserLoginBefore == 0) {
            $buyer = [
                'accounttype' => 'Facebook',
                'socialiteid' => $userid,
                'fullname' => $username,
                'avatar' => $useravatar,
                'email' => $useremail,
                'password' => password_hash(Str::random(15), PASSWORD_BCRYPT),
                'dob' => null,
                'emailconfirmed' => 1,
                'deleted' => 0,
                'createdat' => $this->now,
                'lastmodifiedat' => $this->now,
            ];

            $createdUser = UserBuyer::create($buyer);
            $this->generateSession($createdUser->id, $username, $useremail, $useravatar, $createdUser->accounttype, $request);
        } 
        //If user logged in before, update name and avatar
        else {
            $user = UserBuyer::where('socialiteid', $userid)->where('accounttype', 'Facebook')->first();
            $user->fullname = $username;
            $user->avatar = $useravatar;
            $user->save();

            $this->generateSession($user->id, $username, $useremail, $useravatar, $user->accounttype, $request);
        }

        //Redirect user to where they were before login
        $previousUrl = Session::pull('previous_url', '/');
        return redirect()->intended($previousUrl);
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback(Request $request)
    {
        if(isset($request['error']))
        return Redirect('/auth/login')->with('errorMessage', 'Login using google account fails!');
        
        //Get data from callback
        $user = Socialite::driver('google')->user();
        $userid = $user->getId();
        $useremail = $user->getEmail();
        $username = $user->getName();
        $useravatar = $user->getAvatar();
        if ($useremail == null ||  $useremail == '') return Redirect('/auth/login')->with('errorMessage', 'Login using google fails! You many need to let us know your email!');

        $checkIfUserLoginBefore = UserBuyer::where('socialiteid', $userid)->where('accounttype', 'Google')->count();

        //If facebook account haven't login before, create an account on DB
        if ($checkIfUserLoginBefore == 0) {
            $buyer = [
                'accounttype' => 'Google',
                'socialiteid' => $userid,
                'fullname' => $username,
                'avatar' => $useravatar,
                'email' => $useremail,
                'password' => password_hash(Str::random(15), PASSWORD_BCRYPT),
                'dob' => null,
                'emailconfirmed' => 1,
                'deleted' => 0,
                'createdat' => $this->now,
                'lastmodifiedat' => $this->now,
            ];

            $createdUser = UserBuyer::create($buyer);
            $this->generateSession($createdUser->id, $username, $useremail, $useravatar, $createdUser->accounttype, $request);
        } 
        //If user logged in before, update name and avatar
        else {
            $user = UserBuyer::where('socialiteid', $userid)->where('accounttype', 'Google')->first();

            $user->fullname = $username;
            $user->avatar = $useravatar;
            $user->save();

            $this->generateSession($user->id, $username, $useremail, $useravatar, $user->accounttype, $request);
        }

        //Redirect user to where they were before login
        $previousUrl = Session::pull('previous_url', '/');
        return redirect()->intended($previousUrl);
    }


    private function generateSession($userid, $username, $useremail, $useravatar, $accounttype, $request)
    {
        $request->session()->regenerate();

        $request->session()->put('userid', $userid);
        $request->session()->put('accounttype', $accounttype);
        $request->session()->put('username', $username);
        $request->session()->put('email', $useremail);
        $request->session()->put('avartar', $useravatar);
    }

    public function signup(Request $request)
    {
        $inputData = $request->input();
        //Validate what user input
        if ($inputData['signupemail'] == null || $inputData['signupemail'] == '') return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'Email is empty, Please enter value!');
        if ($inputData['signupname'] == null || $inputData['signupname'] == '') return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'Full name is empty, Please enter value!');
        if ($inputData['signuppassword'] == null || $inputData['signuppassword'] == '') return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'Password is empty');
        if (strlen($inputData['signuppassword']) < 8) return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'Password must have at least 8 characters');
        if ($inputData['signupconfirmpassword'] == null || $inputData['signupconfirmpassword'] == '') return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'Confirm Password is empty');
        if ($inputData['signuppassword'] != $inputData['signupconfirmpassword']) return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'Password and confirm password are not matched!');
        if (!($inputData['signupdob'] <= now()->subYears(5))) return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'DOB is not correct!');
        
        $duplicateEmail = UserBuyer::where('deleted',0)->where('email',$inputData['signupemail'])->where('accounttype','Registed')->count();
        if($duplicateEmail > 0) return Redirect('/auth/login')->withInput($request->all())->with('signupErrorMessage', 'This email address already used!');
        // Create user on DB
        $buyer = [
            'accounttype' => 'Registed',
            'fullname' => trim($inputData['signupname']),
            'email' => trim($inputData['signupemail']),
            'password' => password_hash(trim($inputData['signuppassword']), PASSWORD_BCRYPT),
            'dob' => $inputData['signupdob'],
            'emailconfirmed' => 1,
            'deleted' => 0,
            'createdat' => $this->now,
            'lastmodifiedat' => $this->now,
        ];
        UserBuyer::create($buyer);

        return Redirect('/auth/login')->with('successMessage', 'Account created, please use it to login!');
    }


    public function myaccount()
    {
        return view('/guest/myaccount');
    }

    public function changepassword(Request $request)
    {
        if (session()->has('accounttype') &&  session('accounttype') != 'Registed') return Redirect('/');

        $currentPassword = $request->input('currentpassword');
        $newPassword = $request->input('newpassword');
        $confirmNewPasword = $request->input('newpassword_confirmation');

        $validator = validator($request->all(), [
            'currentpassword' => 'required|string|min:8|max:50',
            'newpassword' => 'required|string|min:8|max:50|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'newpassword_confirmation' => 'required|string|min:8|max:50',
        ], [
            'currentpassword.required' => 'Please enter current password',
            'currentpassword.string' => 'Current password must be a string',
            'currentpassword.min' => 'Current password must have at least 8 chracters',
            'currentpassword.max' => 'Current password cannot exceed 150 characters',

            'newpassword.required' => 'Please enter new password',
            'newpassword.string' => 'New password must be a string',
            'newpassword.min' => 'New password must have at least 8 chracters',
            'newpassword.max' => 'New password cannot exceed 150 characters',
            'newpassword.regex' => 'Password must have alphabet, number and special chracter(s)',
            'newpassword.confirmed' => 'New password and confirnm password are not matched',

            'newpassword_confirmation.required' => 'Please enter confirm new password',
            'newpassword_confirmation.string' => 'Confirm new password must be a string',
            'newpassword_confirmation.min' => 'Confirm new password must have at least 8 chracters',
            'newpassword_confirmation.max' => 'Confirm new password cannot exceed 150 characters',
        ]);

        if ($validator->fails())
            return Redirect('/auth/myaccount')
                ->withInput($request->all())
                ->withErrors($validator);

        $userToChangePass = UserBuyer::where('id', session('userid'))->first();
        
        if ($userToChangePass == null) {
            return Redirect('/auth/myaccount')->with('errorMessage', 'This account is not found!');
        } else {
            if (Hash::check($currentPassword, $userToChangePass->password)) {
                $hasNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                $userToChangePass->password = $hasNewPassword;
                $userToChangePass->resetpasswordtoken = null;
                $userToChangePass->tokenexpiredat = null;
                $userToChangePass->lastmodifiedat = $this->now;
                $userToChangePass->save();
            }
            Redirect('/auth/myaccount')->with('successMessage', 'Password changed!');
        }
    }

    public function forgotpassword()
    {
        return view('/guest/forgotpassword');
    }

    public function sendresetpasswordtoken(Request $request)
    {
        $emailToReset = $request->input('resetemail');

        // Check: Return error when user does not input an email
        if ($emailToReset == null || $emailToReset == '') return Redirect('/auth/forgotpassword')->with('errorMessage', 'Please enter email');;

        // Check: Return an error if the provided email does not exist in the database
        $checkUserExists = UserBuyer::where('deleted', 0)->where('email', $emailToReset)->first();
        if (!$checkUserExists) return Redirect('/auth/forgotpassword')->with('errorMessage', 'Email is not correct');

        // Generate a token and add it to the database
        $checkUserExists->resetpasswordtoken = Str::random(45);
        $checkUserExists->tokenexpiredat = $this->now->addMinutes(10);
        $checkUserExists->save();

        // Send email with token with provided email
        Mail::send('/mailingtemplate/forgotpassword_guest', array('name' => $checkUserExists->firstname, 'resettoken' => $checkUserExists->resetpasswordtoken), function ($message) use ($emailToReset) {
            $message->to($emailToReset, 'Guest')->subject('Cera Tiles - Reset password!');
        });

        return Redirect('/auth/login')->with('successMessage', 'Account created, please use it to login!');
    }

    public function resetpassword()
    {
        return view('/guest/resetpassword');
    }

    public function resetpasswordwithtoken($token)
    {
            // Check if token exists
            $checkTokenExist = UserBuyer::where('deleted',0)->where('resetpasswordtoken',$token)->first();
            if($checkTokenExist == null) return Redirect('/auth/login')->with('errorMessage', 'This reset password request has expired. Please generate a new one');
            if($checkTokenExist->tokenexpiredat != null && $this->now->gt($checkTokenExist->tokenexpiredat)) return Redirect('/auth/login')->with('errorMessage', 'This token is expired!');
    
            // Send token to the view for use by the resetpasswordwithtoken function, which identifies the user.
            $data = [
                'token' => $token,
            ];
    
        return view('/guest/resetpasswordwithtoken')->with($data);
    }

    public function resetpasswordwithtoken_post(Request $request)
    {
        $token = $request->input('token'); 
        $newPassword = $request->input('password'); 
        $confirmPassword = $request->input('confirmpassword'); 

        if($token == null || $newPassword == null || $confirmPassword == null) return Redirect('/auth/setnewpassword/'.$token)->with('errorMessage', 'Please enter require information');
        if($newPassword != $confirmPassword) return Redirect('/auth/setnewpassword/'.$token)->with('errorMessage', 'Password and confirm password are not matched');
        if(strlen($newPassword) < 8) return Redirect('/auth/setnewpassword/'.$token)->with('errorMessage', 'Password must contain at least 8 characters');

        // Check if token one more time
        $checkTokenExist = UserBuyer::where('deleted',0)->where('resetpasswordtoken',$token)->first();

        if($checkTokenExist == null) return Redirect('/admin/login')->with('errorMessage', 'Token is not correct');

        $userToResetPassword = UserBuyer::where('deleted',0)->where('resetpasswordtoken',$token)->first();
        if($userToResetPassword->tokenexpiredat != null && $this->now->gt($userToResetPassword->tokenexpiredat)) return Redirect('/auth/login')->with('errorMessage', 'This token is expired!');

        // Update password in the database and clear the token
        $password_brcrypt = password_hash($newPassword, PASSWORD_BCRYPT);
        $userToResetPassword->resetpasswordtoken = null;
        $userToResetPassword->tokenexpiredat = null;
        $userToResetPassword->password = $password_brcrypt;
        $userToResetPassword->save();
        
        return Redirect('/auth/login')->with('successMessage', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::guard('buyer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect('/');
    }
}
