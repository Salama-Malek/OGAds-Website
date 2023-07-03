<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminCodeController  ;
use App\Http\Controllers\admin\LogoController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminDashboardController;


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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/offer', [OfferController::class, 'index'])->name('offer.index');

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');



Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Code routes
    Route::get('/admin/dashboard/codes', [AdminCodeController::class, 'index'])->name('codes.index');
    Route::get('/admin/dashboard/codes/create', [AdminCodeController::class, 'create'])->name('codes.create');
    Route::post('/admin/dashboard/codes', [AdminCodeController::class, 'store'])->name('codes.store');
    Route::get('/admin/dashboard/codes/{code}/edit', [AdminCodeController::class, 'edit'])->name('codes.edit');
    Route::put('/admin/dashboard/codes/{code}', [AdminCodeController::class, 'update'])->name('codes.update');
    Route::delete('/admin/dashboard/codes/{code}', [AdminCodeController::class, 'destroy'])->name('codes.destroy');

    // Video routes
    Route::get('/admin/dashboard/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/admin/dashboard/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/admin/dashboard/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/admin/dashboard/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
    Route::put('/admin/dashboard/videos/{video}', [VideoController::class, 'update'])->name('videos.update');
    Route::delete('/admin/dashboard/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');

    // User routes
    Route::get('/admin/dashboard/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/dashboard/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/admin/dashboard/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/dashboard/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/dashboard/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/dashboard/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Logo routes
    Route::get('/admin/dashboard/logos', [LogoController::class, 'index'])->name('logos.index');
    Route::get('/admin/dashboard/logos/create', [LogoController::class, 'create'])->name('logos.create');
    Route::post('/admin/dashboard/logos', [LogoController::class, 'store'])->name('logos.store');
    Route::get('/admin/dashboard/logos/{logo}/edit', [LogoController::class, 'edit'])->name('logos.edit');
    Route::put('/admin/dashboard/logos/{logo}', [LogoController::class, 'update'])->name('logos.update');
    Route::delete('/admin/dashboard/logos/{logo}', [LogoController::class, 'destroy'])->name('logos.destroy');
});



Route::get('/postack', [App\Http\Controllers\PostBackController::class, 'index']);
