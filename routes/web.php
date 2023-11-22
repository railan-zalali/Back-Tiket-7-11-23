<?php

use App\Http\Controllers\AdminTempatController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FotoTempatController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\TicketsController;
use App\Models\Bookings;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use function Termwind\render;

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


// oute::get('/data', ');
// Route::get('/', [TempatController::class, 'index'])->middleware('auth', 'verified');
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::resource('/pay', PaymentController::class);
Route::resource('/pay', PayController::class);


Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/tempats', [AdminTempatController::class, 'index'])->name('tempats.index');
    Route::get('/tempats/create', [AdminTempatController::class, 'create'])->name('tempats.create');
    Route::post('/tempats', [AdminTempatController::class, 'store'])->name('tempats.store');
    Route::get('/tempats/{id}/edit', [AdminTempatController::class, 'edit'])->name('tempats.edit');
    Route::put('/tempats/{id}', [AdminTempatController::class, 'update'])->name('tempats.update');
    Route::delete('/tempats/{id}', [AdminTempatController::class, 'destroy'])->name('tempats.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [TempatController::class, "home"])->name('tiket.home');
    Route::get('/tiket', [TempatController::class, 'index'])->name('tiket.index');
    Route::post('/tiket/result', [TempatController::class, 'searchTickets'])->name('tiket.searchTickets');


    Route::post('/checkout', [BookingController::class, 'checkout'])->name('checkout');
    Route::get('/confirm', [BookingController::class, 'confirmPage'])->name('confirm.page');
    Route::put('/confirm-checkout/{id}', [BookingController::class, 'confirmCheckout'])->name('confirm.checkout');
    Route::delete('/confirm/{id}', [BookingController::class, 'destroy'])->name('confirm.destroy');
});

Route::post('/keep-tickets', [TicketsController::class, 'store'])->name('keepTickets');
Route::get('/booking-data', [BookingController::class, 'count'])->middleware(['auth', 'verified']);
Route::get('/cart', [BookingController::class, 'show'])->name('cart');
Route::delete('/cart/{id}', [BookingController::class, 'destroy'])->name('cart.destroy');

// Route::get('/selectTickets', function () {
//     return Inertia::render('ResultSearch');
// })->middleware(['auth', 'verified']);

// Route::post('/searchTickets', function () {
//     return Inertia::render('ResultSearch');
// })->middleware(['auth', 'verified'])->name('searchTikets');
// Route::get('/register', function () {
//     return Inertia::render('Auth/Register');
// })->middleware('guest')->name('register');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cek1', function () {
    return "<h1>hai</h1>";
})->middleware('auth', 'verified');



Route::get('/storage/foto_tempats/{filename}', [FotoTempatController::class, 'show'])->name('foto_tempats.show');




require __DIR__ . '/auth.php';
