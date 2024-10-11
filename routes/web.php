<?php

use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop/index', [ShopController::class, 'shop_index'])->name('shop.index');
Route::get('/shop/{product_slug}', [ShopController::class, 'product_detail'])->name('shop.product.deteail');

Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add',[CartController::class,'add_to_cart'])->name('cart.add');
Route::put('/increase/cart/qty/{rowId}',[CartController::class,'increase_cart_qty'])->name('increase.cart.qty');
Route::put('/decrease/cart/qty/{rowId}',[CartController::class,'decrease_cart_qty'])->name('decrease.cart.qty');

Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard',[UserController::class,'index'])->name('user.index');
});


Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/brands',[AdminController::class,'brands'])->name('admin.brands');
    Route::get('/admin/brand/add',[AdminController::class,'add_brands'])->name('admin.brand.add');
    Route::post('/admin/brand/store',[AdminController::class,'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}',[AdminController::class,'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update',[AdminController::class,'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/delete/{id}',[AdminController::class,'brand_delete'])->name('admin.brand.delete');

    //Categories
    Route::get('/admin/categori',[AdminController::class,'categories'])->name('admin.categori');
    Route::get('/admin/category/add',[AdminController::class,'category_add'])->name('admin.category.add');
    Route::post('/admin/category/store',[AdminController::class,'category_store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}',[AdminController::class,'category_edit'])->name('admin.category.edit');
    Route::put('/admin/category/update',[AdminController::class,'category_update'])->name('admin.category.update');
    Route::delete('/admin/category/delete/{id}',[AdminController::class,'category_delete'])->name('admin.category.delete');

    //Products
    Route::get('/admin/products',[AdminController::class,'products'])->name('admin.products');
    Route::get('/admin/products/add',[AdminController::class,'product_add'])->name('admin.product.add');
    Route::post('/admin/products/store',[AdminController::class,'product_store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}',[AdminController::class,'product_edit'])->name('admin.product.edit');
    Route::put('/admin/product/update',[AdminController::class,'product_update'])->name('admin.product.update');
    Route::delete('/admin/product/delete/{id}',[AdminController::class,'product_delete'])->name('admin.product.delete');
});
