<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User_Employee extends Model{

    protected $table = 'user_employee';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'firstname',
        'lastname',
        'address',
        'phonenumber',
        'idnumber',
        'profilepicture',
        'email',
        'password',
        'dob',
        'joindate',
        'resetpasswordtoken',
        'tokenexpiredat',
        'remember_token',
        'loginfailcount',
        'lockendat',
        'roleid',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 
    
    public function role()
    {
        return $this->hasOne(Role::class, 'id');
    }
}

?>
