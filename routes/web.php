<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Toko;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\CouriersController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

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
// Route::get('/')
Auth::routes(['verify'=>true]);


Route::get('/beranda' , function() {
    return view('client.layout');
});

Route::get('/tes',function() {
    return view('client.transaction.tes');
});

Route::get('/details', [ClientController::class,'show'])->name('detailsProduct');

Route::get('/product/list', [ClientController::class,'productList'])->name('productList');
Route::get('/product/detail/{id}' , [ClientController::class,'show'])->name('productDetail');
Route::post('/product/add-to-cart/{id}', [CartController::class,'add_to_cart'])->name('cart.add-to-cart');

Route::get('/{id}/transaction',[TransactionController::class,'create'])->name('transaction.create');
Route::post('/{id}/transaction/ongkir', [TransactionController::class,'check_ongkir'])->name('ongkir.ongkirCheck');
Route::get('/{id}/transaction/cities/{province_id}', [TransactionController::class,'getCities'])->name('ongkir.getCities');
Route::post('/{id}/transaction/store',[TransactionController::class,'store'])->name('transaction.store');


Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web'])->group(function(){
        Route::get('login',[Login::class,'login'])->name('login');
        Route::get('register',[Login::class,'register'])->name('register');
        Route::post('registers_proses',[Login::class,'proses_register'])->name('register_proses');
        Route::post('logins_proses',[Login::class,'proses_login'])->name('login_proses');
    });
    Route::middleware(['auth:web'])->group(function(){
        Route::view('home','user.home')->middleware('verified')->name('home');
        Route::view('profile',[Login::class,'profile'])->name('profile');
        Route::post('/logout',[Login::class,'logout'])->name('logout');
        // route::get('toko',[Toko::class,'toko'])->name('home');
        Route::get('/cart', [ClientController::class,'cart'])->name('cart.index');
        Route::get('/cart/delete/{id}', [ClientController::class,'delete'])->name('cart.delete');
        Route::get('/transaction-list',[ClientController::class,'transaction'])->name('transaction.list');
        Route::get('/{id}/upload-proof-payment',[ClientController::class,'createProofOfPayment'])->name('transaction.proofOfPayment');
        Route::post('/{id}/upload-proof-payment',[ClientController::class,'uploadProofOfPayment'])->name('transaction.proofOfPayment');

    });

});


Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware(['guest:admin'])->group(function(){
            Route::get('login',[Admin::class,'login'])->name('login');
            Route::post('logins_proses',[Admin::class,'proses_login'])->name('login_proses');
        });
        // Route::middleware(['auth:admin'])->group(function(){
            Route::view('home','admin.home')->name('home');
            //product
            Route::get('/list-product', [ProductController::class, 'index'])->name('product-list');
            Route::get('/add-product', [ProductController::class, 'create']);
            Route::post('/list-product', [ProductController::class, 'store']);
            Route::get('/product/{id}/detail', [ProductController::class, 'show'])->name('product-detail');
            Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product-edit');
            Route::post('/product/{id}', [ProductController::class, 'update'])->name('product-update');
            Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product-delete');
            Route::get('/product/trash', [ProductController::class, 'trash']);
            Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product-restore');
            Route::get('/product/restore', [ProductController::class, 'restore_all'])->name('product-restoreall');
            Route::get('/product/delete_permanently/{id}', [ProductController::class, 'delete'])->name('product-deletepmt');
            Route::get('/product/delete_permanently', [ProductController::class, 'delete_all'])->name('product-deletepmtall');
            //productImages
            Route::post('/productimage/add', [ProductImageController::class, 'store'])->name('productImages-store');
            Route::post('/productimage/delete/{id}', [ProductImageController::class, 'destroy'])->name('productImages-destroy');
            //discount
            Route::get('/list-discount', [DiscountController::class, 'index'])->name('discount-list');
            Route::get('/add-discount', [DiscountController::class, 'create']);
            Route::post('/list-discount', [DiscountController::class, 'store']);
            Route::get('/discount/{id}/edit', [DiscountController::class, 'edit'])->name('discount-edit');
            Route::post('/discount/{id}', [DiscountController::class, 'update'])->name('discount-update');
            Route::delete('/discount/{id}', [DiscountController::class, 'destroy']);
            Route::post('/logout',[Admin::class,'logout'])->name('logout');
            // route::get('toko',[Toko::class,'toko'])->name('home');

            //productCategory
            Route::get('product-category',[ProductCategoryController::class,'index'])->name('product-category.index');
            Route::get('product-category/create',[ProductCategoryController::class,'create'])->name('product-category.create');
            Route::post('product-category-store', [ProductCategoryController::class,'store']);
            Route::get('product-category/{id}/edit', [ProductCategoryController::class, 'edit'])->name('product-category.edit');
            Route::post('product-category/{id}/update',[ ProductCategoryController::class,'update']);
            Route::delete('product-category/{id}/delete', [ProductCategoryController::class, 'delete'])->name('product-category.delete');

            //couriers
            Route::get('couriers', [CouriersController::class, 'index'])->name('couriers.index');
            Route::get('couriers/create',[CouriersController::class,'create'])->name('couriers.create');
            Route::post('couriers-store', [CouriersController::class,'store']);
            Route::get('couriers/{id}/edit', [CouriersController::class, 'edit'])->name('couriers.edit');
            Route::post('couriers/{id}/update',[ CouriersController::class,'update']);
            Route::delete('couriers/{id}/delete', [CouriersController::class, 'delete'])->name('couriers.delete');

            // Transaction
            Route::get('transactions', [TransactionController::class, 'indexOnAdmin'])->name('transaction-index');
        
        // });

});














Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
