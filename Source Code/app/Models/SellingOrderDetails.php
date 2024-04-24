<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SellingOrderDetails extends Model{

    protected $table = 'sellingorders_details';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'sellingorderid',
        'type',
        'productid',
        'deliveryid',
        'voucherid',
        'quantity',
        'amount',
        'addedat',
    ]; 

    public function product()
    {
        return $this->belongsTo(Product::class, 'productid');
    }
    
    public function delivery()
    {
        return $this->belongsTo(DeliveryFee::class, 'deliveryid');
    }
    
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucherid');
    }
}

?>
