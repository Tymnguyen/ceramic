<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DeliveryFee extends Model{

    protected $table = 'deliveryfee';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'cost',
        'remark',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

}

?>
