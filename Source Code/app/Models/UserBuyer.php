<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserBuyer extends Model{

    protected $table = 'user_buyer';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'accounttype',
        'socialiteid',
        'fullname',
        'avatar',
        'email',
        'password',
        'dob',
        'emailconfirmed',
        'resetpasswordtoken',
        'tokenexpiredat',
        'deleted',
        'createdat',
        'lastmodifiedat'
    ]; 
    
}

?>
