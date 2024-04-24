<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model{

    protected $table = 'contactrequest';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'email',
        'message',
        'contactback',
        'deleted',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 
}

?>
