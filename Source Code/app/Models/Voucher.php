<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model{

    protected $table = 'voucher';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'type',
        'vouchercode',
        'description',
        'quantity',
        'value',
        'validfrom',
        'validto',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

}

?>
