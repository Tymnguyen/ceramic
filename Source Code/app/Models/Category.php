<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    protected $table = 'category';

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
    
    public function subcategories()
    {
        return $this->hasMany(CategorySub::class,'categoryid');
    }
}

?>
