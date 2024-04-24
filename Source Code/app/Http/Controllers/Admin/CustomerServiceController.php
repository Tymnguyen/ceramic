<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\Functions;
use App\Models\Role;
use App\Models\RoleFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerServiceController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function contactrequest()
    {
        $request = ContactRequest::where('deleted', 0)->get();
        $data = [
            'requests' => $request
        ];
        return view('/admin/contactrequest')->with($data);
    }


    public function contactrequest_markdone($id)
    {
        $request = ContactRequest::find($id);
        $request->contactback = 1;
        $request->save();
        return Redirect('/admin/contactrequest');
    }

    public function contactrequest_delete($id)
    {
        $request = ContactRequest::find($id);
        $request->deleted = 1;
        $request->save();
        return Redirect('/admin/contactrequest');
    }





    
    public function getroledata($id)
    {
        return response()->json(Role::find($id), 200);
    }

    public function upsertrole(Request $request)
    {
        //Get data from HTTP request
        $id = $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $remark = $request->input('remark');
        $sessionUser = Auth::guard('admin')->user();

        if ($id == '') {
            $role = [
                'name' => $name,
                'description' => $description,
                'remark' => $remark,
                'deleted' => 0,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];
            $returnedId = Role::create($role)->id;
            return Redirect('/admin/role')->with('successMessage', 'Role has been created');
        } else {
            $role = [
                'name' => $name,
                'description' => $description,
                'remark' => $remark,
                'lastmodifiedby' => $sessionUser->id,
                'lastmodifiedat' => $this->now
            ];
            Role::find($id)->update($role);
            return Redirect('/admin/role')->with('successMessage', 'Role has been revised');
        }
    }

    public function deleterole($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $role = [
            'deleted' => 1,
            'lastmodifiedby' => $sessionUser->id,
            'lastmodifiedat' => $this->now
        ];
        $roleToDelete = Role::find($id);
        $roleToDelete->update($role);

        return Redirect('/admin/role')->with('successMessage', 'Role has been deleted');
    }

    public function assignfunction($id){
        $role = Role::find($id);
        $functions = Functions::get();
        //Return as an array
        $roleFunctions = RoleFunction::where('roleid', '=', $id)->where('deleted', '=', 0)->pluck('functionid')->all();
        $data = [
            'role' => $role,
            'functions' => $functions,
            'rolefunctions' => $roleFunctions,
        ];


        return view('/admin/assignfunction')->with($data);
    }


    public function upsertrolefunction(Request $request){
        //Get user session to update create or modify userid
        $sessionUser = Auth::guard('admin')->user();
        
        //Get data from user input
        $roleId = $request->input('roleid');
        $functionsSelected = $request->input('checkedfunctions');

        $currentFunctions = RoleFunction::where('roleid', '=', $roleId)->where('deleted', '=', 0)->pluck('functionid')->all();

        //If dont select function and have no record on db, remind user to select function to add
        if( $functionsSelected == null && count($currentFunctions) == 0)
            return Redirect('/admin/assignfunction/'.$roleId)->with('warningMessage', 'Please kindly select function you want to assign!');

        //Process when user remove all function from role
        if($functionsSelected == null && count($currentFunctions) > 0){
            foreach($currentFunctions as $func){
                $recordsToUpdate = RoleFunction::whereIn('functionid', $currentFunctions)->get();
    
                foreach ($recordsToUpdate as $record) {
                    $record->deleted = 1;
                    $record->save();
                }
            }
            return Redirect('/admin/assignfunction/'.$roleId)->with('successMessage', 'Fucntions has been updated');
        }

        //Add new function 
        $functionsToAdd = array_diff($functionsSelected, $currentFunctions);
        if(count($functionsToAdd)){
            foreach($functionsToAdd as $func){
                $role_function = [
                    'roleid' => $roleId,
                    'functionid' => $func,
                    'deleted' => 0,
                    'createdby' => $sessionUser->id,
                    'createdat' => $this->now,
                    'lastmodifiedby' => $sessionUser->id,
                    'lastmodifiedat' => $this->now,
                ];
    
                RoleFunction::create($role_function);
            }
        }

        //Function exist on db but wasn't selected->delete
        $functionsToDelete = array_diff($currentFunctions, $functionsSelected);
        if(count($functionsToAdd)){
            foreach($functionsToDelete as $func){
                $recordsToUpdate = RoleFunction::whereIn('functionid', $functionsToDelete)->get();
    
                foreach ($recordsToUpdate as $record) {
                    $record->deleted = 1;
                    $record->save();
                }
            }
        }

        return Redirect('/admin/assignfunction/'.$roleId)->with('successMessage', 'Fucntions has been updated');
    }


}
