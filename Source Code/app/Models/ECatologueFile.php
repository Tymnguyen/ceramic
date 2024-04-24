<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ECatologueFile extends Model{

    protected $table = 'ecatalogue_file';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'catalogueid',
        'originalfilename',
        'ext',
        'serverfilename',
        'remark',
        'deleted',
        'downloaded',
        'createdat',
        'createdby',
        'lastmodifiedat',
        'lastmodifiedby',
    ]; 

    public function ecatalogueCategory()
    {
        return $this->belongsTo(ECatologueCategory::class, 'catalogueid');
    }
}

?>
