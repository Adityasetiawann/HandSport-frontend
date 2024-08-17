<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\JerseyController;
use App\Http\Controllers\CelanaController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PembayaranController;

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/jersey', [JerseyController::class, 'getJersey'])->name('jersey');
Route::get('/celana', [CelanaController::class, 'getCelanaOlahraga'])->name('celana');
Route::get('/sepatu', [SepatuController::class, 'getSepatu'])->name('sepatu');
Route::get('/product/{id}', [BarangController::class, 'show'])->name('detail');
Route::get('/search-product', [BarangController::class, 'searchProduct'])->name('search.product');
// Route::get('/shop', [ShopController::class, 'getJersey'])->name('shop.jersey');



// AUTH

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/pesan/{id}', [PesanController::class, 'index'])->name('pesan');
Route::get('/pesan/{id}', [PesanController::class, 'show'])->name('pesan');
// Route::post('/pesan/{id}', [PesanController::class, 'update'])->name('update.pesan');
// Route::post('/pesan', [PesanController::class, 'store'])->name('pesan');

// JANGAN DI HAPUSs
Route::post('/add-to-cart', [PesanController::class, 'addToCart'])->name('addToCart');
Route::get('/Keranjang', [KeranjangController::class, 'index'])->name('keranjang');
Route::post('/store-pesanan', [PesanController::class, 'storePesanan'])->name('storePesanan');


Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');



// Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
// Route::get('/pesananDetail', [PesananDetailController::class, 'index'])->name('pesananDetail');



// KERANJANG
// Route::get('/cart/add/{id}', [KeranjangController::class, 'addItemToCart'])->name('cart.add');
// // Route::middleware('auth')->get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang');
// // Route::post('/cart/add', [KeranjangController::class, 'add'])->name('cart.add')->name('cart.add')->middleware('auth');
// Route::get('/keranjang', [KeranjangController::class, 'index'])->name('cart.index');



