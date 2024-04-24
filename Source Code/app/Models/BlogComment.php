<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model{

    protected $table = 'blog_comment';

    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable =[
        'userid',
        'commentcontent',
        'blogarticleid',
        'status',
        'deleted',
        'createdby',
        'createdat',
        'lastmodifiedby',
        'lastmodifiedat'
    ]; 

    public function article()
    {
        return $this->belongsTo(BlogArticle::class, 'blogarticleid');
    }

    public function createby()
    {
        return $this->belongsTo(UserBuyer::class, 'userid');
    }
}

?>
