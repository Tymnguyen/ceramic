<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class AuthenticationModel_Employee extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'user_employee';

}

?>
