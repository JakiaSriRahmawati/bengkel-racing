<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DetailTransaksi;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/about', [UserController::class, 'about'])->name('about');


// Routes for 'pengguna' role
Route::middleware(['auth', 'role:pengguna'])->group(function () 
{
    Route::get('homepengguna', [UserController::class, 'homepengguna'])->name('homepengguna');
    Route::get('booking', [UserController::class, 'booking'])->name('booking');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::delete('/order/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
    Route::get('/invoice', [ProfileController::class, 'showInvoice'])->name('profil.invoice');
    Route::post('/upload-payment-proof/{id}', [PaymentController::class, 'uploadPaymentProof'])->name('uploadPaymentProof');

    
});
Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('editbayar');
Route::put('/booking/{id}/update', [BookingController::class, 'updateUangMasuk'])->name('booking.update');

// Routes for 'mekanik' role
Route::middleware(['auth', 'role:mekanik'])->group(function () 
{
    Route::get('mekanik', [MekanikController::class, 'mekanik'])->name('mekanik');
    Route::get('tambah_barang', [MekanikController::class, 'tambah_barang'])->name('tambah_barang');
    Route::post('/payment/{orderId}', [UserController::class, 'processPayment'])->name('payment');
    Route::post('/update-status/{bookingId}', [UserController::class, 'updateStatus'])->name('updateStatus');
    Route::delete('/deleteBooking/{id}', [BookingController::class, 'destroy'])->name('deleteBooking');
    Route::post('/mekanik/add-part', [MekanikController::class, 'addPart'])->name('addPart');
    Route::post('/detail_transaksi/{id}', [MekanikController::class, 'store'])->name('detail_transaksi.store');

});




// Routes for 'kasir' role
Route::middleware(['auth', 'role:kasir'])->group(function () 
{
    Route::get('/kasir', [KasirController::class, 'kasir'])->name('kasir');
    Route::post('/payment/{order}', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/update-status/{id}', [KasirController::class, 'updateStatus'])->name('updateStatus.post');
    Route::post('/verify-payment/{id}', [PaymentController::class, 'verifyPayment'])->name('verifyPayment');
    Route::get('/kasir/invoice', [KasirController::class, 'showInvoice'])->name('kasir.invoice');
});


// Routes for 'owner' role
Route::middleware(['auth', 'role:owner'])->group(function () 
{
    Route::get('owner', [UserController::class, 'owner'])->name('owner');
});


// Routes for 'admin' role
Route::middleware(['auth', 'role:admin'])->group(function () 
{
    Route::get('homeadmin', [AdminDashboardController::class, 'homeadmin'])->name('homeadmin');
});

Route::middleware('auth')->group(function () {
    Route::get('/ratings/create/{booking_id}', [UserController::class, 'create'])->name('ratings.create');
    Route::post('/ratings', [UserController::class, 'store'])->name('ratings.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
});
Route::get('/booking/{bookingId}/rate', [UserController::class, 'showForm'])->name('rating.form');
Route::get('/booking/{bookingId}', [UserController::class, 'show'])->name('booking.show');
Route::get('/booking/{bookingId}/rate', [UserController::class, 'showRatingForm'])->name('rating.form');

// Kirim rating
Route::post('/booking/{bookingId}/rate', [UserController::class, 'submit'])->name('rating.submit');
Route::post('/rating/{bookingId}', [UserController::class, 'storeRating'])->name('rating.store');
Route::get('/ratings', [UserController::class, 'index'])->name('ratings.index');
