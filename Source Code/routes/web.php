<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyInfoController;
use App\Http\Controllers\Admin\CustomerServiceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ECatalogueController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Guest\GuestAuthController;
use App\Http\Controllers\Guest\GuestBlogController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Guest\GuestECatalogueController;
use App\Http\Controllers\Guest\GuestPaymentController;
use App\Http\Controllers\Guest\GuestProductController;
use App\Http\Controllers\Payment\CheckoutController;
use Illuminate\Support\Facades\Route;


//For guest side
Route::group([], function () {
    Route::get('/', [GuestController::class, 'index']);
    Route::get('index', [GuestController::class, 'index']);

    //Social authentication
    Route::group(['prefix' => 'auth'], function () {
        //Facebook
        Route::get('facebook', [GuestAuthController::class, 'facebook']);
        Route::get('facebookcallback', [GuestAuthController::class, 'facebookcallback']);

        //Google
        Route::get('google', [GuestAuthController::class, 'google']);
        Route::get('googlecallback', [GuestAuthController::class, 'googlecallback']);

        Route::get('login', [GuestAuthController::class, 'login'])->name('buyer.login');
        Route::post('verifylogin', [GuestAuthController::class, 'verifylogin']);
        Route::post('signup', [GuestAuthController::class, 'signup']);
        Route::get('forgotpassword', [GuestAuthController::class, 'forgotpassword']);
        Route::get('resetpassword', [GuestAuthController::class, 'resetpassword']);
        Route::post('sendresetpasswordtoken', [GuestAuthController::class, 'sendresetpasswordtoken']);

        Route::get('myaccount', [GuestAuthController::class, 'myaccount'])->middleware('buyerauth');
        Route::post('changepassword', [GuestAuthController::class, 'changepassword'])->middleware('buyerauth');
        Route::get('logout', [GuestAuthController::class, 'logout']);

        Route::get('resetpasswordwithtoken/{token}', [GuestAuthController::class, 'resetpasswordwithtoken']);
        Route::post('resetpasswordwithtoken_post', [GuestAuthController::class, 'resetpasswordwithtoken_post']);
    });

    //Contact page
    Route::get('contact', [GuestController::class, 'contact']);
    Route::post('requestcontactme', [GuestController::class, 'requestcontactme']);

    //Blog Pages    
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', [GuestBlogController::class, 'blog']);
        Route::get('/{id}', [GuestBlogController::class, 'blog']);
        Route::get('blogdetails/{id}', [GuestBlogController::class, 'blogdetails']);
        Route::post('leavecomment', [GuestBlogController::class, 'leavecomment'])->middleware('buyerauth');
        Route::post('findblog', [GuestBlogController::class, 'findblog']);
        Route::get('deletemycomment/{id}', [GuestBlogController::class, 'deletemycomment']);
    });

    //Product  
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [GuestProductController::class, 'listproduct']);
        Route::get('listproduct', [GuestProductController::class, 'listproduct']);
        Route::get('listproduct/{searchtext}/{subid}/{page}', [GuestProductController::class, 'listproduct']);
        Route::get('productdetails/{id}', [GuestProductController::class, 'productdetails']);
        Route::post('productaddreview', [GuestProductController::class, 'productaddreview']);
        Route::get('deletemyreview/{id}', [GuestProductController::class, 'deletemyreview']);

        Route::get('addtocart/{id}', [GuestProductController::class, 'addtocart']);
        Route::get('addtocart/{id}/{quantity}', [GuestProductController::class, 'addtocart']);
        Route::get('shoppingcart', [GuestProductController::class, 'shoppingcart']);
        Route::get('removefromcart/{id}', [GuestProductController::class, 'removefromcart']);
        Route::get('revisecartquantity/{id}/{quantity}', [GuestProductController::class, 'revisecartquantity']);
        Route::get('confirmorder', [GuestProductController::class, 'confirmorder']);
        Route::get('getdeliverycost/{id}', [GuestProductController::class, 'getdeliverycost']);
        Route::post('applyvoucher', [GuestProductController::class, 'applyvoucher']);
        Route::get('removevoucher', [GuestProductController::class, 'removevoucher']);

        Route::get('addtocompare/{id}', [GuestProductController::class, 'addtocompare']);
        Route::get('compareproducts', [GuestProductController::class, 'compareproducts']);
        Route::get('removefromcompare/{id}', [GuestProductController::class, 'removefromcompare']);
    });

    //Payment  
    Route::group(['prefix' => 'payment'], function () {
        Route::get('transactioncomplete', [GuestPaymentController::class, 'transactioncomplete']);
        Route::post('checkout', [GuestPaymentController::class, 'checkout']);
        Route::get('checkoutresult', [GuestPaymentController::class, 'checkoutresult'])->name('paymentresult');
        Route::get('myorders', [GuestPaymentController::class, 'myorders']);
        Route::get('myorderdetails/{id}', [GuestPaymentController::class, 'myorderdetails']);
    });

    //E-Catalogue Pages    
    Route::group(['prefix' => 'ecatalogue'], function () {
        Route::get('/', [GuestECatalogueController::class, 'ecatalogue']);
        Route::get('downloadfile/{id}', [GuestECatalogueController::class, 'downloadfile']);

    });
});
//End for guest side



// For admin side
Route::group(['prefix' => 'admin'], function () {
    //Authentication and authorization
    Route::get('/', [AuthController::class, 'login']);
    Route::get('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('verifylogin', [AuthController::class, 'verifylogin']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('forgotpassword', [AuthController::class, 'forgotpassword']);
    Route::post('sendresetpasswordtoken', [AuthController::class, 'sendresetpasswordtoken']);
    Route::get('setnewpassword/{token}', [AuthController::class, 'setnewpassword']);
    Route::post('resetpasswordwithtoken', [AuthController::class, 'resetpasswordwithtoken']);
    Route::get('changepassword', [AuthController::class, 'changepassword'])->middleware('adminauth:0');
    Route::post('changepasswordpost', [AuthController::class, 'changepassword_post'])->middleware('adminauth:0');

    Route::get('notauthorized', [AuthController::class, 'notauthorized'])->name('admin.notauthorized');

    //Admin Index
    Route::get('index', [AdminController::class, 'index'])->middleware('adminauth:0');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware('adminauth:11');

    //Role
    Route::get('role', [RoleController::class, 'role'])->middleware('adminauth:1');
    Route::get('getroledata/{id}', [RoleController::class, 'getroledata'])->middleware('adminauth:1');
    Route::post('upsertrole', [RoleController::class, 'upsertrole'])->middleware('adminauth:1');
    Route::get('deleterole/{id}', [RoleController::class, 'deleterole'])->middleware('adminauth:1');
    Route::get('assignfunction/{id}', [RoleController::class, 'assignfunction'])->middleware('adminauth:1');
    Route::post('upsertrolefunction', [RoleController::class, 'upsertrolefunction'])->middleware('adminauth:1');

    //Employee
    Route::get('employee', [EmployeeController::class, 'employee'])->middleware('adminauth:2');
    Route::get('employeeupsert', [EmployeeController::class, 'employeeupsert'])->middleware('adminauth:2');
    Route::get('employeeupsert/{id}', [EmployeeController::class, 'employeeupsert'])->middleware('adminauth:2');
    Route::post('employeeupsertpost', [EmployeeController::class, 'employeeupsertpost'])->middleware('adminauth:2');
    Route::get('deleteemployee/{id}', [EmployeeController::class, 'deleteemployee'])->middleware('adminauth:2');

    //Company info
    Route::get('companyinfo', [CompanyInfoController::class, 'companyinfo'])->middleware('adminauth:3');
    Route::post('upsertcompanyinfo', [CompanyInfoController::class, 'upsertcompanyinfo'])->middleware('adminauth:3');

    //Customer service
    Route::get('contactrequest', [CustomerServiceController::class, 'contactrequest'])->middleware('adminauth:4');
    Route::get('contactrequest_markdone/{id}', [CustomerServiceController::class, 'contactrequest_markdone'])->middleware('adminauth:4');
    Route::get('contactrequest_delete/{id}', [CustomerServiceController::class, 'contactrequest_delete'])->middleware('adminauth:4');

    //Blog section
    Route::get('blogcategory', [BlogController::class, 'blogcategory'])->middleware('adminauth:5');
    Route::get('getblogcategory/{id}', [BlogController::class, 'getblogcategory'])->middleware('adminauth:5');
    Route::post('upsertblogcategory', [BlogController::class, 'upsertblogcategory'])->middleware('adminauth:5');
    Route::get('deleteblogcategory/{id}', [BlogController::class, 'deleteblogcategory'])->middleware('adminauth:5');
    Route::get('blogarticle', [BlogController::class, 'blogarticle'])->middleware('adminauth:6');
    Route::get('upsertblogarticle', [BlogController::class, 'upsertblogarticle'])->middleware('adminauth:6');
    Route::get('upsertblogarticle/{id}', [BlogController::class, 'upsertblogarticle'])->middleware('adminauth:6');
    Route::post('upsertblogarticlepost', [BlogController::class, 'upsertblogarticlepost'])->middleware('adminauth:6');
    Route::get('deleteblogarticle/{id}', [BlogController::class, 'deleteblogarticle'])->middleware('adminauth:6');
    Route::get('blogcomment/{id}', [BlogController::class, 'blogcomment'])->middleware('adminauth:6');
    Route::get('changecommentstatus/{id}', [BlogController::class, 'changecommentstatus'])->middleware('adminauth:6');
    Route::get('deletecomment/{id}', [BlogController::class, 'deletecomment'])->middleware('adminauth:6');

    //Fee and cost
    Route::get('deliveryfee', [FeeController::class, 'deliveryfee'])->middleware('adminauth:7');
    Route::get('editdeliveryfee/{id}', [FeeController::class, 'editdeliveryfee'])->middleware('adminauth:7');
    Route::post('upsertdeliveryfee', [FeeController::class, 'upsertdeliveryfee'])->middleware('adminauth:7');
    Route::get('deletedeliveryfee/{id}', [FeeController::class, 'deletedeliveryfee'])->middleware('adminauth:7');

    //Voucher
    Route::get('voucherlist', [VoucherController::class, 'voucherlist'])->middleware('adminauth:8');
    Route::get('upsertvoucher', [VoucherController::class, 'upsertvoucher'])->middleware('adminauth:8');
    Route::get('upsertvoucher/{id}', [VoucherController::class, 'upsertvoucher'])->middleware('adminauth:8');
    Route::post('upsertvoucherpost', [VoucherController::class, 'upsertvoucherpost'])->middleware('adminauth:8');

    //Ecatalogue
    Route::get('ecataloguecategorylist', [ECatalogueController::class, 'ecataloguecategorylist'])->middleware('adminauth:9');
    Route::post('upsertecataloguecategory', [ECatalogueController::class, 'upsertecataloguecategory'])->middleware('adminauth:9');
    Route::get('getcategorydata/{id}', [ECatalogueController::class, 'getcategorydata'])->middleware('adminauth:9');
    Route::get('deleteecataloguecategory/{id}', [ECatalogueController::class, 'deleteecataloguecategory'])->middleware('adminauth:9');
    Route::get('ecataloguefilelist', [ECatalogueController::class, 'ecataloguefilelist'])->middleware('adminauth:10');
    Route::get('ecataloguefileupsert', [ECatalogueController::class, 'ecataloguefileupsert'])->middleware('adminauth:10');
    Route::get('ecataloguefileupsert/{id}', [ECatalogueController::class, 'ecataloguefileupsert'])->middleware('adminauth:10');
    Route::post('ecataloguefileupsert_post', [ECatalogueController::class, 'ecataloguefileupsert_post'])->middleware('adminauth:10');
    Route::get('deleteecataloguefile/{id}', [ECatalogueController::class, 'deleteecataloguefile'])->middleware('adminauth:10');

    Route::group(['prefix' => 'category'], function () {
        //Main Category
        Route::get('categorymain', [CategoryController::class, 'categorymain'])->middleware('adminauth:12');
        Route::post('createmaincategory', [CategoryController::class, 'createmaincategory'])->middleware('adminauth:12');
        Route::get('getmaincategory/{id}', [CategoryController::class, 'getmaincategory'])->middleware('adminauth:12');
        Route::get('deletemaincategory/{id}', [CategoryController::class, 'deletemaincategory'])->middleware('adminauth:12');
        
        //Sub category
        Route::get('categorysub', [CategoryController::class, 'categorysub'])->middleware('adminauth:13');
        Route::get('categorysub/{id}', [CategoryController::class, 'categorysub'])->middleware('adminauth:13');
        Route::post('createsubcategory', [CategoryController::class, 'createsubcategory'])->middleware('adminauth:13');
        Route::get('getsubcategory/{id}', [CategoryController::class, 'getsubcategory'])->middleware('adminauth:13');
        Route::get('deletesubcategory/{id}', [CategoryController::class, 'deletesubcategory'])->middleware('adminauth:13');
    });

    Route::group(['prefix' => 'product'], function () {
        //Main Category
        Route::get('productlist', [ProductController::class, 'productlist'])->middleware('adminauth:14');
        Route::get('productupsert', [ProductController::class, 'productupsert'])->middleware('adminauth:14');
        Route::get('productupsert/{id}', [ProductController::class, 'productupsert'])->middleware('adminauth:14');
        Route::get('deleteproduct/{id}', [ProductController::class, 'deleteproduct'])->middleware('adminauth:14');
        Route::post('productupsertpost', [ProductController::class, 'productupsertpost'])->middleware('adminauth:14');
        Route::get('removerelatedimage/{id}', [ProductController::class, 'removerelatedimage'])->middleware('adminauth:14');
        Route::get('reviews/{id}', [ProductController::class, 'reviews'])->middleware('adminauth:14');
        Route::get('changereviewstatus/{id}', [ProductController::class, 'changereviewstatus'])->middleware('adminauth:14');
        Route::get('deletereview/{id}', [ProductController::class, 'deletereview'])->middleware('adminauth:14');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('orderlist', [PaymentController::class, 'orderlist'])->middleware('adminauth:15');
        Route::get('orderdetails/{id}', [PaymentController::class, 'orderdetails'])->middleware('adminauth:15');
    });

});
//End for admin side
