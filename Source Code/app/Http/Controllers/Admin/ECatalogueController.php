<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ECatologueCategory;
use App\Models\ECatologueFile;
use App\Models\Functions;
use App\Models\Role;
use App\Models\RoleFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ECatalogueController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function ecataloguecategorylist()
    {
        $allCatagory = ECatologueCategory::where('deleted', 0)->get();
        $data = [
            'catagories' => $allCatagory,
        ];
        return view('/admin/ecatologue_catagory')->with($data);
    }

    public function upsertecataloguecategory(Request $request)
    {
        //Get data from HTTP request
        $userInput = $request->all();
        $sessionUser = Auth::guard('admin')->user();

        if ($userInput['id'] == null || $userInput['id'] == '') {
            $category = [
                'name' => $userInput['name'],
                'remark' => $userInput['remark'],
                'deleted' => 0,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];

            ECatologueCategory::create($category);

            return Redirect('/admin/ecataloguecategorylist')->with('successMessage', 'Ecatalogue category has been created');
        } else {
            $categoryToEdit = ECatologueCategory::find($userInput['id']);
            $categoryToEdit->name = $userInput['name'];
            $categoryToEdit->remark = $userInput['remark'];
            $categoryToEdit->lastmodifiedat = $this->now;
            $categoryToEdit->lastmodifiedby = $sessionUser->id;

            $categoryToEdit->save();

            return Redirect('/admin/ecataloguecategorylist')->with('successMessage', 'Ecatalogue category has been revised');
        }
    }




    public function getcategorydata($id)
    {
        return response()->json(ECatologueCategory::find($id), 200);
    }

    public function deleteecataloguecategory($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $categoryToDelete = ECatologueCategory::find($id);
        if ($categoryToDelete == null) return Redirect('/admin/ecataloguecategorylist')->with('errorMessage', 'Category not found');
        $categoryToDelete->deleted = 1;
        $categoryToDelete->lastmodifiedby = $sessionUser->id;
        $categoryToDelete->lastmodifiedat = $this->now;

        $categoryToDelete->save();

        return Redirect('/admin/ecataloguecategorylist')->with('infoMessage', 'Category has been deleted');
    }


    public function ecataloguefilelist()
    {

        $allFiles = ECatologueFile::where('deleted', 0)                                                        
                                    ->whereHas('ecatalogueCategory', function ($query) {
                                        $query->where('deleted', 0);
                                    })
                                    ->with('ecatalogueCategory')
                                    ->get();
        //dd($allFiles);
        $data = [
            'files' => $allFiles,
        ];
        return view('/admin/ecatologue_file')->with($data);
    }


    public function ecataloguefileupsert($id = null)
    {
        $allCatagory = ECatologueCategory::where('deleted', 0)->get();
        if ($id == null || $id == '') {
            $data = [
                'catagories' => $allCatagory,
            ];
        } else {
            $fileToEdit = ECatologueFile::find($id);
            $data = [
                'catagories' => $allCatagory,
                'file' => $fileToEdit,
            ];
        }

        return view('/admin/ecatologue_upsertfile')->with($data);
    }

    public function ecataloguefileupsert_post(Request $request)
    {
        $sessionUser = Auth::guard('admin')->user();

        $userInput = $request->all();

        //Add new
        if ($userInput['id'] == null || $userInput['id'] == '') {
            $validator = validator($request->all(), [
                'uploadfile' => 'required|mimes:jpeg,png,jpg,pdf,docx|max:110000',
                'categoryid' => 'required|numeric',
                'remark' => 'max:500',
            ], [
                'uploadfile.required' => 'Please upload file',
                'uploadfile.mimes' => 'Please upload PDF, DOCX, JPG, JPEG, PNG file only',
                'uploadfile.max' => 'Please upload file under 100MB',

                'categoryid.required' => 'Please select category',
                'categoryid.numeric' => 'Incorrect category',

                'remark.max' => 'Remark cannot exceed 500 characters',
            ]);

            if ($validator->fails())
                return Redirect('/admin/ecataloguefileupsert')
                    ->withInput($request->all())
                    ->withErrors($validator)
                    ->with('errorMessage', 'Please kindly check your input data!');

            $file = $request->file('uploadfile');
            $name = $file->getClientOriginalName();
            $fileExt = (substr($name, strrpos($name, '.')));
            $serverFileName = self::GenerateFileName($name);
            $file->move(public_path('guestasset') . '/ecatalogue', $serverFileName);

            $file = [
                'catalogueid' => $userInput['categoryid'],
                'originalfilename' => $name,
                'ext' => $fileExt,
                'serverfilename' => $serverFileName,
                'remark' => $userInput['remark'],
                'deleted' => 0,
                'downloaded' => 0,
                'createdat' => $this->now,
                'createdby' => $sessionUser->id,
            ];

            ECatologueFile::create($file);

            return Redirect('/admin/ecataloguefilelist')->with('successMessage', 'File has been added');
        } else {

            $validator = validator($request->all(), [
                'uploadfile' => 'mimes:jpeg,png,jpg,pdf,docx|max:110000',
                'categoryid' => 'required|numeric',
                'remark' => 'max:500',
            ], [
                'uploadfile.mimes' => 'Please upload PDF, DOCX, JPG, JPEG, PNG file only',
                'uploadfile.max' => 'Please upload file under 100MB',

                'categoryid.required' => 'Please select category',
                'categoryid.numeric' => 'Incorrect category',

                'remark.max' => 'Remark cannot exceed 500 characters',
            ]);

            if ($validator->fails())
                return Redirect('/admin/ecataloguefileupsert')
                    ->withInput($request->all())
                    ->withErrors($validator)
                    ->with('errorMessage', 'Please kindly check your input data!');

            $fileToRevise = ECatologueFile::find($userInput['id']);

            if ($request->hasFile('uploadfile')) {
                $file = $request->file('uploadfile');
                $name = $file->getClientOriginalName();
                $fileExt = (substr($name, strrpos($name, '.')));
                $serverFileName = self::GenerateFileName($name);
                $file->move(public_path('guestasset') . '/ecatalogue', $serverFileName);

                $fileToRevise->originalfilename = $name;
                $fileToRevise->ext = $fileExt;
                $fileToRevise->serverfilename = $serverFileName;
            }

            $fileToRevise->catalogueid = $userInput['categoryid'];
            $fileToRevise->remark = $userInput['remark'];
            $fileToRevise->lastmodifiedat = $this->now;
            $fileToRevise->lastmodifiedby = $sessionUser->id;

            $fileToRevise->save();

            return Redirect('/admin/ecataloguefilelist')->with('successMessage', 'File has been revised');
        }
    }

    public function deleteecataloguefile($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $fileToDelete = ECatologueFile::find($id);
        if ($fileToDelete == null) return Redirect('/admin/ecataloguefilelist')->with('errorMessage', 'File not found');
        $fileToDelete->deleted = 1;
        $fileToDelete->lastmodifiedby = $sessionUser->id;
        $fileToDelete->lastmodifiedat = $this->now;

        $fileToDelete->save();

        return Redirect('/admin/ecataloguefilelist')->with('infoMessage', 'File has been deleted');
    }


    private function GenerateFileName($filename)
    {
        $newname = uniqid() . (substr($filename, strrpos($filename, '.')));
        return $newname;
    }
}
