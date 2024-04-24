<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SellingOrder extends Model{

    protected $table = 'sellingorders';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'buyerid',
        'fullname',
        'address',
        'phone',
        'email',
        'transactionid',
        'status',
        'completepaymentat',
        'subtotalamount',
        'voucheramount',
        'deliverycostamount',
        'grandtotalamount',
        'createdat',
    ]; 

    public function sellingDetails()
    {
        return $this->hasMany(SellingOrderDetails::class,'sellingorderid');
    }

    public function buyer()
    {
        return $this->belongsTo(UserBuyer::class, 'buyerid');
    }
}

?>
