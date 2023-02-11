<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    //admin login
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::group(['middleware'=>['admin']], function(){
        //admin dashboard
        Route::get('dashboard', 'AdminController@dashboard');
        //admin logout
        Route::get('logout', 'AdminController@logout');
        //update admin password
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');
        //update admin details
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');
        //update vendor details
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');
        //check admin password
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');
        //admins/subadmins/vendors
        Route::get('admins/{type?}', 'AdminController@admins');
        //view vendor details
        Route::get('view-vendor-details/{id}', 'AdminController@viewVendorDetails');
        //update admin status
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');


        //sections
        Route::get('sections', 'SectionController@sections');
        //update section status
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        //delete section
        Route::get('delete-section/{id}', 'SectionController@deleteSection');
        //add/edit section
        Route::match(['get', 'post'], 'add-edit-section/{id?}','SectionController@addEditSection');

        //categories
        Route::get('categories', 'CategoryController@categories');
        //update categories status
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        //add/edit category
        Route::match(['get', 'post'], 'add-edit-category/{id?}','CategoryController@addEditCategory');
        //categories level
        Route::get('append-categories-level', 'CategoryController@appendCategoriesLevel');
        //delete category
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');
        //delete category image
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');

        //brands
        Route::get('brands', 'BrandController@brands');
        //update section status
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        //delete section
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');
        //add/edit section
        Route::match(['get', 'post'], 'add-edit-brand/{id?}','BrandController@addEditBrand');

        //products
        Route::get('products', 'ProductController@products');
        //update section status
        Route::post('update-product-status', 'ProductController@updateProductStatus');
        //delete section
        Route::get('delete-product/{id}', 'ProductController@deleteProduct');
        //add/edit section
        Route::match(['get', 'post'], 'add-edit-product/{id?}','ProductController@addEditProduct');
        //delete product image
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        //add attributes
        Route::match(['get','post'], 'add-edit-attributes/{id}', 'ProductController@addAttributes');
    });




});
