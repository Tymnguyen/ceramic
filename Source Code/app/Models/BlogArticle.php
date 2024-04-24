<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model{

    protected $table = 'blog_article';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'coverimage',
        'originalcoverimage',
        'name',
        'description',
        'blogcategoryid',
        'content',
        'viewcount',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blogcategoryid');
    }

    public function author()
    {
        return $this->belongsTo(User_Employee::class, 'createdby');
    }
}

?>
