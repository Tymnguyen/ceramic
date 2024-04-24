<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoleFunction extends Model{

    protected $table = 'role_function';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'roleid',
        'functionid',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleid');
    }

    public function function()
    {
        return $this->belongsTo(Functions::class, 'functionid');
    }
}

?>
