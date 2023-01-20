<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSlideController;
use App\Http\Controllers\Home\MultiImgeController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Models\MultiImge;
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

//homeslde
Route::controller((HomeSlideController::class))->group(function(){
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');
    Route::post('/update/slide','updateSlide')->name('update.slider');
});
//end

//aboutpage
Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page', 'aboutPage')->name('about.page');
    Route::post('/update/about', 'updateAbout')->name('update.about');
    Route::get('/about', 'homeAbout')->name('home.about');

});
//end

//multi-image
Route::controller(MultiImgeController::class)->group(function (){
    Route::get('about/multi/image','aboutMultiImage')->name('about.multi.image');
    Route::post('store/multi/image','storeMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');
    Route::get('edit/multi/image/{multiimage}','editMultiImage')->name('edit.multi.image');
    Route::post('update/multi/image/{multiimage}','updateMultiImage')->name('update.multi.image');
    Route::get('delete/multi/image/{multiimage}','deleteMultiImage')->name('delete.multi.image');

});
//end

//portfolio
Route::resource('portfolios',PortfolioController::class);
Route::get('add/portfolios',[PortfolioController::class,'addPortfolio'])->name('add.portfolio');
//end
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
