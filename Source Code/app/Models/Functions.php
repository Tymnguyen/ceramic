<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Functions extends Model{

    protected $table = 'function';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'url',
        'description',
        'remark'
    ]; 

    public function roleFunctions()
    {
        return $this->hasMany(RoleFunction::class);
    }
}

?>
