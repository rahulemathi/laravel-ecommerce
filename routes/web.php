<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeCOntroller;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[homeCOntroller::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[homeCOntroller::class,'redirect'])->middleware('auth','verified');

Route::get('/view_catagory',[AdminController::class,'view_catagory']);

Route::post('/add_catagory',[AdminController::class,'add_catagory']);

Route::get('/delete_catagory/{id}',[AdminController::class,'delete_catagory']);

Route::get('/view_product',[AdminController::class,'view_product']);
Route::post('/add_product',[AdminController::class,'add_product']);

Route::get('/show_product',[AdminController::class,'show_product']);

Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
Route::post('/updated_product/{id}',[AdminController::class,'updated_product']);

Route::get('/update_product/{id}',[AdminController::class,'update_product']);

Route::get('/product_details/{id}',[homeCOntroller::class,'product_details']);

Route::post('/add_cart/{id}',[AdminController::class,'add_cart']);

Route::get('cart',[homeCOntroller::class,'cart']);

Route::get('remove_cart/{id}',[homeCOntroller::class,'remove_cart']);

Route::get('cash_order',[homeCOntroller::class,'cash_order']);

Route::get('stripe/{totalprice}',[homeCOntroller::class,'card_payment']);

Route::post('stripe/{totalprice}',[homeCOntroller::class, 'stripePost'])->name('stripe.post');

Route::get('order',[homeCOntroller::class,'order']);

Route::get('delivered/{id}',[homeCOntroller::class,'delivered']);

Route::get('print/{id}',[homeCOntroller::class,'print']);

Route::get('send_email/{id}',[homeCOntroller::class,'send_email']);

Route::post('send_user_email/{id}',[homeCOntroller::class,'send_user_email']);

Route::get('search_order',[homeCOntroller::class,'search_order']);

Route::get('show_order',[homeCOntroller::class,'show_order']);

Route::get('cancel_order/{id}',[homeCOntroller::class,'cancel_order']);

Route::post('add_comment',[homeCOntroller::class,'add_comment']);

Route::post('add_reply',[homeCOntroller::class,'add_reply']);

Route::get('product_search',[homeCOntroller::class,'product_search']);  

Route::get('product',[homeCOntroller::class,'products']);

Route::get('search_product',[homeCOntroller::class,'search_product']);