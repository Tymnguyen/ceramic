<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model{

    protected $table = 'companyinfo';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'address',
        'phone',
        'fax',
        'email',
        'longitude',
        'latitude',
        'embedmapurl',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 
    
}

?>
