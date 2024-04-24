<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User_Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }


    public function employee()
    {
        $employees = User_Employee::where('deleted', '=', 0)->orderBy('joindate', 'desc')->with(['role' => function ($query) {
            $query->where('deleted', 0);
        }])->get();
        $data = [
            'employees' => $employees,
        ];

        return view('/admin/employee')->with($data);
    }

    public function employeeupsert($id = null)
    {
        $roles = Role::where('deleted', '=', 0)->get();
        if ($id == null) {
            $data = [
                'roles' => $roles
            ];
        } else {
            $employee = User_Employee::find($id);
            $data = [
                'employee' => $employee,
                'roles' => $roles
            ];
        }

        return view('/admin/employeeupsert')->with($data);
    }

    public function employeeupsertpost(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();
        $id = $request->input('id');
        $firstname = trim($request->input('firstname'));
        $lastname = trim($request->input('lastname'));
        $address = $request->input('address');
        $idnumber = $request->input('idnumber');
        $phonenumber = $request->input('phonenumber');
        $email = trim($request->input('email'));
        $password = trim($request->input('password'));
        $password_brcrypt = password_hash($password, PASSWORD_BCRYPT);
        $dob = $request->input('dob');
        $joindate = $request->input('joindate');
        $roleid = $request->input('roleid');

        //Only supper user can create or edit other supper user
        if ($roleid == 1 && $sessionUser->roleid != 1)
            return Redirect('/admin/employeeupsert')
                ->withInput($request->all())
                ->with('errorMessage', 'You are not have role to create/modify Super user');

        if ($id != '') {
            $validator = validator($request->all(), [
                'uploadprofilepicture' => 'mimes:jpeg,png,jpg|max:2048',
                'firstname' => 'required|string|max:150',
                'lastname' => 'required|string|max:150',
                'address' => 'required|string|max:500',
                'phonenumber' => 'required|string|max:100',
                'idnumber' => 'required|string|max:100',
                'email' => 'required|email|max:250',
                'dob' => 'required|date|date_format:Y-m-d',
                'joindate' => 'required|date|date_format:Y-m-d',
                'roleid' => 'required|numeric',
            ], [
                'uploadprofilepicture.mimes' => 'Please upload JPG, JPEG, PNG file only',
                'uploadprofilepicture.max' => 'Please upload file under 2MB',

                'firstname.required' => 'Please enter first name',
                'firstname.string' => 'First name must be a string',
                'firstname.max' => 'First name cannot exceed 150 characters',

                'lastname.required' => 'Please enter last name',
                'lastname.string' => 'Last name must be a string',
                'lastname.max' => 'Last name cannot exceed 150 characters',

                'address.required' => 'Please enter address',
                'address.string' => 'Address must be a string',
                'address.max' => 'Address cannot exceed 500 characters',

                'phonenumber.required' => 'Please enter phone number',
                'phonenumber.string' => 'Phone number must be a string',
                'phonenumber.max' => 'Phone number cannot exceed 100 characters',

                'idnumber.required' => 'Please enter ID number',
                'idnumber.string' => 'ID number must be a string',
                'idnumber.max' => 'ID number cannot exceed 100 characters',

                'email.required' => 'Please enter email',
                'email.email' => 'Please enter valid email address',
                'email.max' => 'Email cannot exceed 250 characters',

                'dob.required' => 'Please enter date of birth',
                'dob.date' => 'Date of birth must be a date',
                'dob.date_format' => 'Date of birth must be in format: MM/DD/YYYY',

                'joindate.required' => 'Please enter join date',
                'joindate.date' => 'Join date must be a date',
                'joindate.date_format' => 'Join date must be in format: MM/DD/YYYY',

                'roleid.required' => 'Please select role',
                'roleid.numeric' => 'Incorrect role',
            ]);

            if ($validator->fails()) {
                return Redirect('/admin/employeeupsert/' . $id)
                    ->withInput($request->all())
                    ->withErrors($validator)
                    ->with('errorMessage', 'Please kindly check your input data!');
            } else {
                //Process when have avatar uploaded
                $serverFileName = 'noAvatar.jpg';
                if ($request->hasFile('uploadprofilepicture')) {
                    $file = $request->file('uploadprofilepicture');
                    $name = $file->getClientOriginalName();
                    $serverFileName = self::GenerateFileName($name);
                    $file->move(public_path('adminasset') . '/img/avatars', $serverFileName);
                }

                $userToUpdate = User_Employee::find($id);
                $userToUpdate->firstname != $firstname ? $userToUpdate->firstname = $firstname : false;
                $userToUpdate->lastname != $lastname ? $userToUpdate->lastname = $lastname : false;
                $userToUpdate->address != $address ? $userToUpdate->address = $address : false;
                $userToUpdate->phonenumber != $phonenumber ? $userToUpdate->phonenumber = $phonenumber : false;
                $userToUpdate->idnumber != $idnumber ? $userToUpdate->idnumber = $idnumber : false;
                ($userToUpdate->profilepicture != $serverFileName && $serverFileName != 'noAvatar.jpg') ? $userToUpdate->profilepicture = $serverFileName : false;
                $userToUpdate->email != $email ? $userToUpdate->email = $email : false;
                $password != '' ? $userToUpdate->password = $password_brcrypt : false;
                $userToUpdate->dob != $dob ? $userToUpdate->dob = $dob : false;
                $userToUpdate->joindate != $joindate ? $userToUpdate->joindate = $joindate : false;
                $userToUpdate->roleid != $roleid ? $userToUpdate->roleid = $roleid : false;
                $userToUpdate->lastmodifiedby = $sessionUser->id;
                $userToUpdate->lastmodifiedat = $this->now;
                $userToUpdate->save();

                return Redirect('/admin/employee')->with('successMessage', 'User: ' . $userToUpdate->firstname . ' ' . $userToUpdate->lastname . ' updated');
            }
        } else {
            $validator = validator($request->all(), [
                'uploadprofilepicture' => 'mimes:jpeg,png,jpg|max:2048',
                'firstname' => 'required|string|max:150',
                'lastname' => 'required|string|max:150',
                'address' => 'required|string|max:500',
                'phonenumber' => 'required|string|max:100',
                'idnumber' => 'required|string|max:100',
                'email' => 'required|email|max:250',
                'password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|max:100',
                'dob' => 'required|date|date_format:Y-m-d',
                'joindate' => 'required|date|date_format:Y-m-d',
                'roleid' => 'required|numeric',
            ], [
                'uploadprofilepicture.mimes' => 'Please upload JPG, JPEG, PNG file only',
                'uploadprofilepicture.max' => 'Please upload file under 2MB',

                'firstname.required' => 'Please enter first name',
                'firstname.string' => 'First name must be a string',
                'firstname.max' => 'First name cannot exceed 150 characters',

                'lastname.required' => 'Please enter last name',
                'lastname.string' => 'Last name must be a string',
                'lastname.max' => 'Last name cannot exceed 150 characters',

                'address.required' => 'Please enter address',
                'address.string' => 'Address must be a string',
                'address.max' => 'Address cannot exceed 500 characters',

                'phonenumber.required' => 'Please enter phone number',
                'phonenumber.string' => 'Phone number must be a string',
                'phonenumber.max' => 'Phone number cannot exceed 100 characters',

                'idnumber.required' => 'Please enter ID number',
                'idnumber.string' => 'ID number must be a string',
                'idnumber.max' => 'ID number cannot exceed 100 characters',

                'email.required' => 'Please enter email',
                'email.email' => 'Please enter valid email address',
                'email.max' => 'Email cannot exceed 250 characters',

                'password.required' => 'Please enter password',
                'password.string' => 'Password must be a string',
                'password.min' => 'Passwrod must have at least 8 characters',
                'password.regex' => 'Password must have alphabet, number and special chracter(s)',
                'password.max' => 'Passwrod cannot exceed 100 characters',

                'dob.required' => 'Please enter date of birth',
                'dob.date' => 'Date of birth must be a date',
                'dob.date_format' => 'Date of birth must be in format: MM/DD/YYYY',

                'joindate.required' => 'Please enter join date',
                'joindate.date' => 'Join date must be a date',
                'joindate.date_format' => 'Join date must be in format: MM/DD/YYYY',

                'roleid.required' => 'Please select role',
                'roleid.numeric' => 'Incorrect role',
            ]);

            if ($validator->fails()) {

                return Redirect('/admin/employeeupsert')
                    ->withInput($request->all())
                    ->withErrors($validator)
                    ->with('errorMessage', 'Please kindly check your input data!');
            } else {
                //Check if email has been created user
                $checkDuplicateEmail = User_Employee::where('deleted', 0)->where('email', '=', $email)->count();
                if ($checkDuplicateEmail > 0) {
                    return Redirect('/admin/employeeupsert')
                        ->withInput($request->all())
                        ->withErrors($validator)
                        ->with('errorMessage', 'This email already in use, please use different email address!');
                }

                //Process when have avatar uploaded
                $serverFileName = 'noAvatar.jpg';
                if ($request->hasFile('uploadprofilepicture')) {
                    $file = $request->file('uploadprofilepicture');
                    $name = $file->getClientOriginalName();
                    $serverFileName = self::GenerateFileName($name);
                    $file->move(public_path('adminasset') . '/img/avatars', $serverFileName);
                }

                $employee = [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'address' => $address,
                    'phonenumber' => $phonenumber,
                    'idnumber' => $idnumber,
                    'profilepicture' => $serverFileName,
                    'email' => $email,
                    'password' => $password_brcrypt,
                    'dob' => $dob,
                    'joindate' => $joindate,
                    'loginfailcount' => 0,
                    'lockendat' => null,
                    'roleid' => $roleid,
                    'deleted' => 0,
                    'createdby' => $sessionUser->id,
                    'createdat' => $this->now
                ];

                $createdUser = User_Employee::create($employee);
                return Redirect('/admin/employee')->with('successMessage', 'User: ' . $createdUser->firstname . ' ' . $createdUser->lastname . ' created');
            }
        }
    }

    public function deleteemployee($id)
    {
        $employeeToDelete = User_Employee::find($id);
        if ($employeeToDelete == null) return Redirect('/admin/employee')->with('errorMessage', 'User id not found');
        //You supper user want to delete her/him self, at least, there has to be 1 other super user to backup for his/her 
        if ($employeeToDelete->roleid == 1) {
            $countSupperUser = User_Employee::where('deleted', 0)->where('roleid', 1)->count;
            if ($countSupperUser < 2) return Redirect('/admin/employee')->with('errorMessage', 'You are the last supper user, please create other supper user before delete your self');
        }
        $employeeToDelete->deleted = 1;
        $employeeToDelete->save();
    }

    private function GenerateFileName($filename)
    {
        $newname = uniqid() . (substr($filename, strrpos($filename, '.')));
        return $newname;
    }
}
