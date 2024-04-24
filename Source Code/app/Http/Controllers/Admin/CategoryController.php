<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySub;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function categorymain()
    {
        $categories = Category::where('deleted', '=', 0)->get();
        return view('/admin/categorymain')->with(['categories' => $categories]);
    }

    public function createmaincategory(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();
        $userInput = $request->all();

        if ($userInput['name'] == null || $userInput['name'] == '') return redirect()->back()->with('errorMessage', 'Main Category name must have value');

        if (isset($userInput['id']) && $userInput['id'] != null && $userInput['id'] != '') {
            
            $categoryToEdit = Category::find($userInput['id']);
            $categoryToEdit->name = $userInput['name'];
            $categoryToEdit->remark = $userInput['remark'];
            $categoryToEdit->lastmodifiedat = $this->now;
            $categoryToEdit->lastmodifiedby = $sessionUser->id;
            $categoryToEdit->save();

            return Redirect('/admin/category/categorymain')->with('successMessage', 'Main category revised');
        } else {
            $mainCategory = [
                'name' => $userInput['name'],
                'remark' => $userInput['remark'],
                'deleted' => 0,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];
            Category::create($mainCategory);

            return Redirect('/admin/category/categorymain')->with('successMessage', 'New Main category created');
        }
    }

    public function getmaincategory($id)
    {
        return response()->json(Category::find($id), 200);
    }

    public function deletemaincategory($id)
    {
        $categoryToDelete = Category::find($id);
        if ($categoryToDelete == null) return Redirect('/admin/category/categorymain')->with('errorMessage', 'Category not found');

        $sessionUser = Auth::guard('admin')->user();

        $categoryToDelete->deleted = 1;
        $categoryToDelete->lastmodifiedat = $this->now;
        $categoryToDelete->lastmodifiedby = $sessionUser->id;
        $categoryToDelete->save();

        return Redirect('/admin/category/categorymain')->with('infoMessage', 'Main category deleted');
    }






    public function categorysub($id = null)
    {
        $categories = Category::where('deleted', '=', 0)->get();
        //Get sub category with base on main category
        if($id != null && $id != ''){
            $subCategories = CategorySub::where('deleted', '=', 0)->where('categoryid',$id)->with('category')->get();
            return view('/admin/categorysub')->with(['subcategories' => $subCategories, 'categories' => $categories]);
        }
        //Get all sub category
        else{
            $subCategories = CategorySub::where('deleted', '=', 0)->with('category')->get();
            return view('/admin/categorysub')->with(['subcategories' => $subCategories, 'categories' => $categories]);
        }
    }

    public function deletesubcategory($id)
    {
        $subcategoryToDelete = CategorySub::find($id);
        if ($subcategoryToDelete == null) return Redirect('/admin/category/categorysub')->with('errorMessage', 'Sub Category not found');

        $sessionUser = Auth::guard('admin')->user();

        $subcategoryToDelete->deleted = 1;
        $subcategoryToDelete->lastmodifiedat = $this->now;
        $subcategoryToDelete->lastmodifiedby = $sessionUser->id;
        $subcategoryToDelete->save();

        return Redirect('/admin/category/categorysub')->with('infoMessage', 'Sub category deleted');
    }


    public function createsubcategory(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();
        $userInput = $request->all();

        if ($userInput['name'] == null || $userInput['name'] == '') return redirect()->back()->with('errorMessage', 'Main Category name must have value');
        if ($userInput['categoryid'] == null || $userInput['categoryid'] == '') return redirect()->back()->with('errorMessage', 'Please select main category');

        if (isset($userInput['id']) && $userInput['id'] != null && $userInput['id'] != '') {
            $categoryToEdit = CategorySub::find($userInput['id']);
            $categoryToEdit->categoryid = $userInput['categoryid'];
            $categoryToEdit->name = $userInput['name'];
            $categoryToEdit->remark = $userInput['remark'];
            $categoryToEdit->lastmodifiedat = $this->now;
            $categoryToEdit->lastmodifiedby = $sessionUser->id;
            $categoryToEdit->save();

            return redirect()->back()->with('successMessage', 'Sub category revised');
        } else {
            $subCategory = [
                'categoryid' => $userInput['categoryid'],
                'name' => $userInput['name'],
                'remark' => $userInput['remark'],
                'deleted' => 0,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];
            CategorySub::create($subCategory);

            return redirect()->back()->with('successMessage', 'New sub category created');
        }
    }

    public function getsubcategory($id)
    {
        return response()->json(CategorySub::find($id), 200);
    }


}
