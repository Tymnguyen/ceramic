<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ECatologueCategory extends Model{

    protected $table = 'ecatalogue_category';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'name',
        'remark',
        'remark',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

    public function catalogueFiles()
    {
        return $this->hasMany(ECatologueFile::class,'catalogueid');
    }
}

?>
