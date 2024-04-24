<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model{

    protected $table = 'product_image';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'filename',
        'productid',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat',
    ]; 

}

?>
