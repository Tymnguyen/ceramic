<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Functions;
use App\Models\Role;
use App\Models\RoleFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function blogcategory()
    {
        $categories = BlogCategory::where('deleted', '=', 0)->get();
        $data = [
            'categories' => $categories
        ];
        return view('/admin/blogcategory')->with($data);
    }

    public function upsertblogcategory(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();
        $id = $request->input('id');
        $name = $request->input('name');
        $remark = $request->input('remark');

        if($name == null || $name == '') return Redirect('/admin/blogcategory')->with('errorMessage', 'Please input category name');

        //Create new category
        if ($id == '' || $id == null){
            $category = [
                'name' => $name,
                'remark' => $remark,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];
    
            $createdCategory = BlogCategory::create($category);
            return Redirect('/admin/blogcategory')->with('successMessage', 'Category: ' . $name . ' created');
        }
        else{
            $categoryToUpdate = BlogCategory::find($id);
            if($categoryToUpdate == null) return Redirect('/admin/blogcategory')->with('errorMessage', 'Category ID not found');

            $categoryToUpdate->name = $name;
            $categoryToUpdate->remark = $remark;
            $categoryToUpdate->lastmodifiedby = $sessionUser->id;
            $categoryToUpdate->lastmodifiedat = $this->now;

            $categoryToUpdate->save();

            return Redirect('/admin/blogcategory')->with('successMessage', 'Category data revised');
        }
    }

    public function getblogcategory($id)
    {
        return response()->json(BlogCategory::find($id), 200);
    }

    public function deleteblogcategory($id)
    {
        $blogCategoryToDelete = BlogCategory::find($id);
        if($blogCategoryToDelete == null) return Redirect('/admin/blogcategory')->with('errorMessage', 'Category ID not found');

        $blogCategoryToDelete->deleted = 1;
        $blogCategoryToDelete->save();

        return Redirect('/admin/blogcategory')->with('infoMessage', 'Category deleted');
    }


    public function blogarticle()
    {
        $sessionUser = Auth::guard('admin')->user();
        //Super users can see all article
        if($sessionUser->roleid == 1){
            $articles = BlogArticle::where('deleted', 0)->orderBy('createdat', 'desc')->with('category')
                                                        ->whereHas('category', function ($query) {
                                                            $query->where('deleted', 0);
                                                        })
                                                        ->with('author')
                                                        ->get();
            $data = [
                'articles' => $articles
            ];
            return view('/admin/blogarticle')->with($data);
        }
        //Authorize users only can see article that they created
        else{
            $articles = BlogArticle::where('deleted', 0)
                                    ->where('createdby',$sessionUser->id)
                                    ->orderBy('createdat', 'desc')
                                    ->with('category')
                                    ->whereHas('category', function ($query) {
                                        $query->where('deleted', 0);
                                    })
                                    ->with('author')
                                    ->get();
            $data = [
                'articles' => $articles
            ];
            return view('/admin/blogarticle')->with($data);
        }
    }

    public function upsertblogarticle($id = null)
    {
        $blogCategory = BlogCategory::where('deleted',0)->get();
        if($id != null && $id != '') {
            $blogArticle = BlogArticle::find($id);
            $data = [
                'blogcategories' => $blogCategory,
                'blogarticle' => $blogArticle,
            ];
            return view('/admin/blogarticleupsert')->with($data);
        }
        else{
            $data = [
                'blogcategories' => $blogCategory
            ];
            return view('/admin/blogarticleupsert')->with($data);
        }
    }

    public function upsertblogarticlepost(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();
        $input = $request->all();
        if ($input['id'] != '') {
            $validator = validator($request->all(), [
                'name' => 'required|string|max:250',
                'description' => 'required|string|max:500',
                'blogcategoryid' => 'required|numeric',
                'content' => 'required|string',
            ], [
                'name.required' => 'Please enter article name',
                'name.string' => 'Article name must be a string',
                'name.max' => 'Article name cannot exceed 250 characters',

                'description.required' => 'Please enter last description',
                'description.string' => 'Description must be a string',
                'description.max' => 'Description cannot exceed 500 characters',

                'blogcategoryid.required' => 'Please select blog category',
                'blogcategoryid.numeric' => 'Incorrect category',

                'content.required' => 'Please enter blog content',
                'content.string' => 'Blog content must be a string',
            ]);

            if ($validator->fails()) 
            return Redirect('/admin/upsertblogarticle')
                ->withInput($request->all())
                ->withErrors($validator)
                ->with('errorMessage', 'Please kindly check your input data!');


            $articleToRevise = BlogArticle::find($input['id']);
            if($articleToRevise == null )            
                return Redirect('/admin/upsertblogarticle')
                ->withInput($request->all())
                ->with('errorMessage', 'Blog ID not found!');

            //Check if email has been created user
            $checkDuplicateArticleName = BlogArticle::where('deleted', 0)->where('id','!=',$input['id'])->where('name',$input['name'])->count();
            if($checkDuplicateArticleName > 0){
                return Redirect('/admin/upsertblogarticle')
                ->withInput($request->all())
                ->withErrors($validator)
                ->with('errorMessage', 'This article name already in use, please use different name!');
            }


            $serverFileName = 'noAvatar.jpg';
            $originalFileName = '';
            if ($request->hasFile('uploadcoverpicture')) {
                $file = $request->file('uploadcoverpicture');
                $originalFileName = $file->getClientOriginalName();
                $serverFileName = self::GenerateFileName($originalFileName);
                $file->move(public_path('guestasset') . '/img/blog', $serverFileName);

                $articleToRevise->coverimage = $serverFileName;
                $articleToRevise->originalcoverimage = $originalFileName;
            }

            $articleToRevise->name = $input['name'];
            $articleToRevise->description = $input['description'];
            $articleToRevise->blogcategoryid  = $input['blogcategoryid'];
            $articleToRevise->content = $input['content'];
            $articleToRevise->lastmodifiedby =  $sessionUser->id;
            $articleToRevise->lastmodifiedat =  $this->now;

            $articleToRevise->save();

            return Redirect('/admin/blogarticle')->with('successMessage', 'Article revised');

        } else {
            $validator = validator($request->all(), [
                'uploadcoverpicture' => 'mimes:jpeg,png,jpg|max:2048',
                'name' => 'required|string|max:250',
                'description' => 'required|string|max:500',
                'blogcategoryid' => 'required|numeric',
                'content' => 'required|string',
            ], [
                'uploadprofilepicture.mimes' => 'Please upload JPG, JPEG, PNG file only',
                'uploadprofilepicture.max' => 'Please upload file under 2MB',

                'name.required' => 'Please enter article name',
                'name.string' => 'Article name must be a string',
                'name.max' => 'Article name cannot exceed 250 characters',

                'description.required' => 'Please enter last description',
                'description.string' => 'Description must be a string',
                'description.max' => 'Description cannot exceed 500 characters',

                'blogcategoryid.required' => 'Please select blog category',
                'blogcategoryid.numeric' => 'Incorrect category',

                'content.required' => 'Please enter blog content',
                'content.string' => 'Blog content must be a string',
            ]);

            if ($validator->fails()) 
                return Redirect('/admin/upsertblogarticle')
                    ->withInput($request->all())
                    ->withErrors($validator)
                    ->with('errorMessage', 'Please kindly check your input data!');

            //Check if email has been created user
            $checkDuplicateArticleName = BlogArticle::where('deleted', 0)->where('name',$input['name'])->count();
            if($checkDuplicateArticleName > 0){
                return Redirect('/admin/upsertblogarticle')
                ->withInput($request->all())
                ->withErrors($validator)
                ->with('errorMessage', 'This article name already in use, please use different name!');
            }

            //Process when have avatar uploaded
            $serverFileName = 'noAvatar.jpg';
            $originalFileName = '';
            if ($request->hasFile('uploadcoverpicture')) {
                $file = $request->file('uploadcoverpicture');
                $originalFileName = $file->getClientOriginalName();
                $serverFileName = self::GenerateFileName($originalFileName);
                $file->move(public_path('guestasset') . '/img/blog', $serverFileName);
            }

            $article = [
                'name' => $input['name'],
                'coverimage' => $serverFileName,
                'originalcoverimage' => $originalFileName,
                'description' => $input['description'],
                'blogcategoryid' => $input['blogcategoryid'],
                'content' => $input['content'],
                'deleted' => 0,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];

            $createdArticle = BlogArticle::create($article);
            return Redirect('/admin/blogarticle')->with('successMessage', 'Article: ' . $input['name'] . ' created');
        }
    }

    public function deleteblogarticle($id)
    {
        $blogArticleToDelete = BlogArticle::find($id);
        if($blogArticleToDelete == null) return Redirect('/admin/blogarticle')->with('errorMessage', 'Blog article ID not found');

        $blogArticleToDelete->deleted = 1;
        $blogArticleToDelete->save();

        return Redirect('/admin/blogarticle')->with('infoMessage', 'Blog: '.$blogArticleToDelete->name.' deleted');
    }


    public function blogcomment($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $article = BlogArticle::find($id);
        if($sessionUser->roleid != 1){
            if($article == null) return Redirect('/admin/blogarticle')->with('errorMessage', 'Blog article ID not found');
            if($article->createdby != $sessionUser->id) return Redirect('/admin/blogarticle')->with('errorMessage', 'Only author can modify comments');
        }

        $blogComment = BlogComment::where('blogarticleid',$id)->where('deleted',0)->with('createby')->get();
        $data = [
            'article'=>$article,
            'comments'=>$blogComment,
        ];

        return view('/admin/blogcomment')->with($data);
    }

    public function changecommentstatus($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $comment = BlogComment::find($id);
        if($comment == null) return back()->with('errorMessage', 'Comment ID not found');

        $article = BlogArticle::find($comment->blogarticleid);
        if($sessionUser->roleid != 1){
            if($article == null) return Redirect('/admin/blogarticle')->with('errorMessage', 'Blog article ID not found');
            if($article->createdby != $sessionUser->id) return Redirect('/admin/blogarticle')->with('errorMessage', 'Only author can modify comments');
        }

        if($comment->status == 0){
            $comment->status = 1;
            $comment->lastmodifiedby = $sessionUser->id;
            $comment->lastmodifiedat = $this->now;
            $comment->save();
    
            return back()->with('successMessage', 'Comment approve and showing under blog content');
        }
        else{
            $comment->status = 0;
            $comment->lastmodifiedby = $sessionUser->id;
            $comment->lastmodifiedat = $this->now;
            $comment->save();
    
            return back()->with('infoMessage', 'Comment disapproved and hidden from blog');
        }
    }


    public function deletecomment($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $comment = BlogComment::find($id);
        if($comment == null) return back()->with('errorMessage', 'Comment ID not found');

        $article = BlogArticle::find($comment->blogarticleid);
        if($sessionUser->roleid != 1){
            if($article == null) return Redirect('/admin/blogarticle')->with('errorMessage', 'Blog article ID not found');
            if($article->createdby != $sessionUser->id) return Redirect('/admin/blogarticle')->with('errorMessage', 'Only author can modify comments');
        }

        $comment->deleted = 1;
        $comment->lastmodifiedby = $sessionUser->id;
        $comment->lastmodifiedat = $this->now;
        $comment->save();

        return back()->with('infoMessage', 'Comment deleted');
    }












    private function GenerateFileName($filename)
    {
        $newname = uniqid() . (substr($filename, strrpos($filename, '.')));
        return $newname;
    }
}
