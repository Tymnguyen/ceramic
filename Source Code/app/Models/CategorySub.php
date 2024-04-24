<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CategorySub extends Model{

    protected $table = 'category_sub';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'remark',
        'categoryid',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryid');
    }
}

?>
