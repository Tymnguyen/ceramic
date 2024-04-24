<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Functions;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\Role;
use App\Models\RoleFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    protected  $now; //UTC

    public function __construct()
    {
        $this->now = Carbon::now()->utc();
    }

    public function productlist()
    {
        $products = Product::where('deleted', 0)->whereHas('subcategory', function ($query) {
            $query->whereHas('category', function ($query) {
                $query->where('deleted', 0);
            })->where('deleted', 0);
        })->get();
        return view('/admin/productlist')->with(['products' => $products]);
    }

    public function productupsert($id = null)
    {
        $categories = Category::where('deleted', 0)->with('subcategories')->get();
        if ($id != null && $id != '') {
            //Get product data and related images that has deleted column = 0
            $product = Product::with(['productimages' => function ($query) {
                $query->where('deleted', 0);
            }])->find($id);

            $data = [
                'categories' => $categories,
                'product' => $product,
            ];
            return view('/admin/productupsert')->with($data);
        } else {
            $data = [
                'categories' => $categories,
                'product' => null,
            ];
            return view('/admin/productupsert')->with($data);
        }
    }

    public function productupsertpost(Request $request)
    {
        $userInput = $request->all();
        $sessionUser = Auth::guard('admin')->user();

        if ($userInput['id'] != null || $userInput['id'] != '') {
            $validator = validator($request->all(), [
                'name' => 'required|string|max:250',
                'subcategoryid' => 'required',
                'description' => 'required|string|max:800',
                'sellingprice' => 'required|numeric',
                'origin' => 'required|string|max:150',
            ], [

                'name.required' => 'Please enter product name',
                'name.string' => 'Product name must be a string',
                'name.max' => 'Product name cannot exceed 250 characters',

                'subcategoryid.required' => 'Please select category',

                'description.required' => 'Please enter description',
                'description.string' => 'Description must be a string',
                'description.max' => 'Description cannot exceed 150 characters',

                'sellingprice.required' => 'Please enter selling price',
                'sellingprice.numeric' => 'Selling price must be a string',
                'sellingprice.max' => 'Selling price cannot exceed 11 characters',

                'origin.required' => 'Please enter origin country',
                'origin.string' => 'Origin country must be a string',
                'origin.max' => 'Origin country cannot exceed 150 characters',
            ]);

            if ($validator->fails())
                return Redirect('/admin/product/productupsert')
                    ->withInput($request->all())
                    ->withErrors($validator)
                    ->with('errorMessage', 'Please kindly check your input data!');


            $productToUpdate = Product::find($userInput['id']);
            if ($productToUpdate == null) return redirect()->back()->withInput($request->all())->with('errorMessage', 'Product ID not found!');

            //Replace main image when use upload new file
            if ($request->hasFile('uploadmainpicture')) {
                $file = $request->file('uploadmainpicture');
                $name = $file->getClientOriginalName();
                $serverFileName = self::GenerateFileName($name);
                $file->move(public_path('guestasset') . '/img/product', $serverFileName);
                $productToUpdate->mainimage = $serverFileName;
            }

            //Add more related picture if user upload
            if ($request->hasFile('relatedpictures')) {
                foreach ($request->file('relatedpictures') as $file) {

                    $name = $file->getClientOriginalName();
                    $serverFileName = self::GenerateFileName($name);
                    $file->move(public_path('guestasset') . '/img/product', $serverFileName);

                    $product_image = [
                        'filename' => $serverFileName,
                        'productid' => $productToUpdate->id,
                        'deleted' => 0,
                        'createdby' => $sessionUser->id,
                        'createdat' => $this->now
                    ];
                    //dd($product_image);
                    ProductImage::create($product_image);
                }
            }

            //Revise other information
            $productToUpdate->name = $userInput['name'];
            $productToUpdate->subcategoryid = $userInput['subcategoryid'];
            //nl2br() convert newline characters to HTML line breaks
            $productToUpdate->description = nl2br($userInput['description']);
            $productToUpdate->sellingprice = $userInput['sellingprice'];
            $productToUpdate->remark = $userInput['remark'];
            $productToUpdate->origin = $userInput['origin'];
            $productToUpdate->color = $userInput['color'];
            $productToUpdate->material = $userInput['material'];
            $productToUpdate->size = $userInput['size'];
            $productToUpdate->application = $userInput['application'];
            $productToUpdate->packingdetails = $userInput['packingdetails'];
            $productToUpdate->lastmodifiedby = $sessionUser->id;
            $productToUpdate->lastmodifiedat = $this->now;

            $productToUpdate->save();

            return Redirect('/admin/product/productlist')->with('successMessage', 'Product: ' . $productToUpdate->name . ' revised');
        } else {
            $validator = validator($request->all(), [
                'uploadmainpicture' => 'mimes:jpeg,png,jpg|max:5048',
                'name' => 'required|string|max:250',
                'subcategoryid' => 'required',
                'description' => 'required|string|max:800',
                'sellingprice' => 'required|numeric',
                'origin' => 'required|string|max:150',
            ], [
                'uploadmainpicture.mimes' => 'Please upload JPG, JPEG, PNG file only',
                'uploadmainpicture.max' => 'Please upload file under 5MB',

                'name.required' => 'Please enter product name',
                'name.string' => 'Product name must be a string',
                'name.max' => 'Product name cannot exceed 250 characters',

                'subcategoryid.required' => 'Please select category',

                'description.required' => 'Please enter description',
                'description.string' => 'Description must be a string',
                'description.max' => 'Description cannot exceed 150 characters',

                'sellingprice.required' => 'Please enter selling price',
                'sellingprice.numeric' => 'Selling price must be a string',
                'sellingprice.max' => 'Selling price cannot exceed 11 characters',

                'origin.required' => 'Please enter origin country',
                'origin.string' => 'Origin country must be a string',
                'origin.max' => 'Origin country cannot exceed 150 characters',
            ]);

            if ($validator->fails())
                return Redirect('/admin/product/productupsert')
                    ->withInput($request->all())
                    ->withErrors($validator)
                    ->with('errorMessage', 'Please kindly check your input data!');




            //Process when have avatar uploaded
            $serverFileName = 'ProductNoImage.png';
            if ($request->hasFile('uploadmainpicture')) {
                $file = $request->file('uploadmainpicture');
                $name = $file->getClientOriginalName();
                $serverFileName = self::GenerateFileName($name);
                $file->move(public_path('guestasset') . '/img/product', $serverFileName);
            }

            $product = [
                'name' => $userInput['name'],
                'subcategoryid' => $userInput['subcategoryid'],
                'mainimage' => $serverFileName,
                'description' => nl2br($userInput['description']),
                'sellingprice' => $userInput['sellingprice'],
                'remark' => $userInput['remark'],
                'origin' => $userInput['origin'],
                'color' => $userInput['color'],
                'material' => $userInput['material'],
                'size' => $userInput['size'],
                'application' => $userInput['application'],
                'packingdetails' => $userInput['packingdetails'],
                'deleted' => 0,
                'createdby' => $sessionUser->id,
                'createdat' => $this->now
            ];

            $createdProduct = Product::create($product);

            //Process have related images
            if ($request->hasFile('relatedpictures')) {
                foreach ($request->file('relatedpictures') as $file) {
                    $name = $file->getClientOriginalName();
                    $serverFileName = self::GenerateFileName($name);
                    $file->move(public_path('guestasset') . '/img/product', $serverFileName);

                    $product_image = [
                        'filename' => $serverFileName,
                        'productid' => $createdProduct->id,
                        'deleted' => 0,
                        'createdby' => $sessionUser->id,
                        'createdat' => $this->now
                    ];
                    ProductImage::create($product_image);
                }
            }

            return Redirect('/admin/product/productlist')->with('successMessage', 'Product: ' . $createdProduct->name . ' created');
        }
    }

    public function deleteproduct($id)
    {
        $sessionUser = Auth::guard('admin')->user();

        $productToDelete = Product::where('deleted', 0)->find($id);
        if ($productToDelete == null) return redirect()->back()->with('errorMessage', 'Product ID not found!');
        $productToDelete->deleted = 1;
        $productToDelete->lastmodifiedby = $sessionUser->id;
        $productToDelete->lastmodifiedat = $this->now;
        $productToDelete->save();

        return redirect()->back()->with('infoMessage', 'Product: ' . $productToDelete->filename . ' deleted');
    }


    public function removerelatedimage($id)
    {
        $sessionUser = Auth::guard('admin')->user();

        $relatedImageToRemove = ProductImage::where('deleted', 0)->find($id);
        if ($relatedImageToRemove == null) return redirect()->back()->with('errorMessage', 'Product Image ID not found!');
        $relatedImageToRemove->deleted = 1;
        $relatedImageToRemove->lastmodifiedby = $sessionUser->id;
        $relatedImageToRemove->lastmodifiedat = $this->now;
        $relatedImageToRemove->save();
        return  redirect()->back()->with('infoMessage', 'Image: ' . $relatedImageToRemove->name . ' deleted');
    }

    public function reviews($id)
    {
        $reviews = ProductReview::where('deleted',0)->where('productid',$id)->with('product')->with('createby')->get();

        return view('/admin/productreview')->with(['reviews'=>$reviews]);
    }


    public function changereviewstatus($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $review = ProductReview::find($id);
        if($review == null) return back()->with('errorMessage', 'Review ID not found');

        if($review->status == 0){
            $review->status = 1;
            $review->lastmodifiedby = $sessionUser->id;
            $review->lastmodifiedat = $this->now;
            $review->save();
    
            return back()->with('successMessage', 'Review approve and showing under product details');
        }
        else{
            $review->status = 0;
            $review->lastmodifiedby = $sessionUser->id;
            $review->lastmodifiedat = $this->now;
            $review->save();
    
            return back()->with('infoMessage', 'Review disapproved and hidden from product details');
        }
    }


    public function deletereview($id)
    {
        $sessionUser = Auth::guard('admin')->user();
        $review = ProductReview::find($id);
        if($review == null) return back()->with('errorMessage', 'Review ID not found');

        $review->deleted = 1;
        $review->lastmodifiedby = $sessionUser->id;
        $review->lastmodifiedat = $this->now;
        $review->save();

        return back()->with('infoMessage', 'Review deleted');
    }
    

    private function GenerateFileName($filename)
    {
        $newname = uniqid() . (substr($filename, strrpos($filename, '.')));
        return $newname;
    }
}
