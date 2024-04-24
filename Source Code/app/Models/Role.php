<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model{

    protected $table = 'role';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'description',
        'remark',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

    public function roleFunctions()
    {
        return $this->hasMany(RoleFunction::class);
    }
}

?>
