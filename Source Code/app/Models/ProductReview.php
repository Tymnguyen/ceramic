<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model{

    protected $table = 'product_review';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'commentcontent',
        'productid',
        'status',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

    public function product()
    {
        return $this->belongsTo(Product::class, 'productid');
    }

    public function createby()
    {
        return $this->belongsTo(UserBuyer::class, 'createdby');
    }
}

?>
