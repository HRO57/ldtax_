<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\LandServiceAndSoftwareController;
use App\Http\Controllers\LandRelatedMediaLinkController;
use App\Http\Controllers\FestiableImageController;
use App\Http\Controllers\LandRelatedVideoLinkController;
use App\Http\Controllers\RecentUpdateController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MenuListController;
use App\Http\Controllers\AyinbidhiController;
use App\Http\Controllers\PoripotroProggaponController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\NitimalaController;
use App\Http\Controllers\VhumiShebaFormController;
use App\Http\Controllers\ProkolpoSarsongkhepController;
use App\Http\Controllers\UddesshoLokkhoController;
use App\Http\Controllers\NagorikerSubidhaController;
use App\Http\Controllers\ProkolperOutputController;
use App\Http\Controllers\ProkolpoPoricalokController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);



    Route::resource('sliders', SliderController::class);
    Route::resource('notices', NoticeController::class);
    Route::resource('apps-and-softwares', LandServiceAndSoftwareController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('land-related-media-links', LandRelatedMediaLinkController::class);
    Route::resource('festivals-images', FestiableImageController::class);
    Route::resource('land-related-video-links', LandRelatedVideoLinkController::class);
    Route::resource('recent-updates', RecentUpdateController::class);

    // Route::post('recentupdates', function(){
    //     dd("dfgdfhgf");
    // })->name('recentupdates.store');

    // Route::post('testdata', function(){
    //     dd("df");
    // })->name('testdata.store');

    Route::resource('services', ServiceController::class);
    Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');

    Route::resource('menu-lists', MenuListController::class);

    Route::get('/upload', 'ImageController@uploadForm')->name('upload.form');
    Route::post('/upload-image', 'ImageController@upload')->name('upload.image');

    Route::resource('ayinbidhis', AyinbidhiController::class);
    Route::resource('poripotro_proggapons', PoripotroProggaponController::class);
    Route::resource('manuals', ManualController::class);
    Route::resource('nitimalas', NitimalaController::class);
    Route::resource('vhumi_sheba_forms', VhumiShebaFormController::class);
    Route::resource('prokolpo_sarsongkheps', ProkolpoSarsongkhepController::class);
    Route::resource('uddessho_lokkhos', UddesshoLokkhoController::class);
    Route::resource('nagoriker_subidhas', NagorikerSubidhaController::class);
    Route::resource('prokolper_outputs', ProkolperOutputController::class);
    Route::resource('prokolpo_poricaloks', ProkolpoPoricalokController::class);

    // Route::get('/load-menu-content', 'MenuController@loadMenuContent')->name('load.menu.content');


});

