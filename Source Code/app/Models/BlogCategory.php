<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model{

    protected $table = 'blog_category';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'remark',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 
}

?>
