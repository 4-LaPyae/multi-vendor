<?php

use App\Http\Controllers\Admin\AdminController;
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
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::controller(AdminController::class)->group(function (){
    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('edit/profile','editProfile')->name('edit.profile');
    Route::post('store/profile','storeProfile')->name('store.profile');
    Route::get('change/password','changePassword')->name('change.password');
    Route::post('update/password','updatePassword')->name('update.password');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
