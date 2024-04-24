<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\CompanyInfo;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class GuestBlogController extends Controller {

    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }


    
    public function blog($id = null){
        $blogcatagories = BlogCategory::where('deleted',0)->get();
        if($id == null || $id == ''){
            $articles = BlogArticle::where('deleted',0)
                                    ->whereHas('category', function ($query) {
                                        $query->where('deleted', 0);
                                    })
                                    ->with('author')
                                    ->get();
    
            $data=[
                'blogcatagories'=>$blogcatagories,
                'articles' => $articles,
            ];
    
            return view('/guest/blog')->with($data);
        }
        else{
            $articles = BlogArticle::where('deleted',0)
                                    ->where('blogcategoryid',$id)
                                    ->whereHas('category', function ($query) {
                                        $query->where('deleted', 0);
                                    })
                                    ->with('author')
                                    ->get();
    
            $data=[
                'blogcatagories'=>$blogcatagories,
                'articles' => $articles,
            ];
    
            return view('/guest/blog')->with($data);
        }
    }

    public function findblog(Request $request){
        $userInput = $request->all();
        $blogcatagories = BlogCategory::where('deleted',0)->get();
        $articles = BlogArticle::where('deleted',0)
                                ->where('name', 'like', '%' . $userInput['searchblog'] . '%')
                                ->whereHas('category', function ($query) {
                                    $query->where('deleted', 0);
                                })
                                ->with('author')
                                ->get();
    
        $data=[
            'blogcatagories'=>$blogcatagories,
            'articles' => $articles,
        ];

        return view('/guest/blog')->with($data);
    }

    public function blogdetails($id){
        $blog = BlogArticle::with('author')
                            ->whereHas('category', function ($query) {
                                $query->where('deleted', 0);
                            })
                            ->find($id);
        if($blog == null) return Redirect('blog')->with('errorMessage', 'Blog ID not found');

        $blog->viewcount = $blog->viewcount + 1;
        $blog->save();

        $comments = BlogComment::where('deleted',0)->where('status',1)->where('blogarticleid',$id)->with('createby')->get();

        $data = [
            'blog' => $blog,
            'comments' => $comments,
        ];
        return view('/guest/blogdetails')->with($data);
    }

    public function leavecomment(Request $request){
        $inputData = $request->all();
        if($inputData['id'] == null || $inputData['id'] == 0) return back()->with('errorMessage', 'Blog ID not found');

        if($inputData['commenttext'] == null || $inputData['commenttext'] == '') return back()->with('errorMessage', 'Please enter your comment');
        if(strlen($inputData['commenttext']) >1000) return back()->with('errorMessage', 'Your comment must under 1000 characters');

        $blog = BlogArticle::where('deleted',0)->find($inputData['id']);
        if($blog == null) return back()->with('errorMessage', 'Blog not found');

        $comment =[
            'userid'=>session('userid'),
            'commentcontent' => $inputData['commenttext'],
            'blogarticleid' => $inputData['id'],
            'status' => 0,
            'deleted' => 0,
            'createdby' => session('userid'),
            'createdat' => $this->now,
        ]; 

        $commentCreated = BlogComment::create($comment);

        return back()->with('successMessage', 'Your comment has been submitted');
    }

    public function deletemycomment($id)
    {
        $commentTobeDeleted = BlogComment::where('deleted',0)->find($id);
        if($commentTobeDeleted == null) return redirect()->back()->with('errorMessage', 'Comment not found');

        if(session('userid') != $commentTobeDeleted->createdby) return redirect()->back()->with('errorMessage', 'You cannot delete this comment');

        $commentTobeDeleted->deleted = 1;
        $commentTobeDeleted->save();

        return redirect()->back()->with('successMessage', 'Your comment has been deleted');
    }

}

?>