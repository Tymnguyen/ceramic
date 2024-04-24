<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{

    protected $table = 'product';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'subcategoryid',
        'mainimage',
        'description',
        'sellingprice',
        'remark',
        'origin',
        'color',
        'material',
        'size',
        'application',
        'packingdetails',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat',
    ]; 

    public function productimages()
    {
        return $this->hasMany(ProductImage::class,'productid');
    }

    public function subcategory()
    {
        return $this->belongsTo(CategorySub::class, 'subcategoryid');
    }

}

?>
