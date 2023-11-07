<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MenuListController;
use App\Http\Controllers\NitimalaController;
use App\Http\Controllers\AyinbidhiController;
use App\Http\Controllers\RecentUpdateController;
use App\Http\Controllers\FestiableImageController;
use App\Http\Controllers\UddesshoLokkhoController;
use App\Http\Controllers\VhumiShebaFormController;
use App\Http\Controllers\ProkolperOutputController;
use App\Http\Controllers\NagorikerSubidhaController;
use App\Http\Controllers\PoripotroProggaponController;
use App\Http\Controllers\ProkolpoSarsongkhepController;
use App\Http\Controllers\LandRelatedMediaLinkController;
use App\Http\Controllers\LandRelatedVideoLinkController;
use App\Http\Controllers\LandServiceAndSoftwareController;
use App\Http\Controllers\VerificationOfLandInformationController;
use App\Http\Controllers\UserAskQuestionController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ProkolpoPoricalokController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('sliders', SliderController::class);
Route::resource('notices', NoticeController::class);
Route::resource('verification-infoes', VerificationOfLandInformationController::class);
Route::resource('apps-and-softwares', LandServiceAndSoftwareController::class);
Route::resource('faqs', FaqController::class);
Route::resource('land-related-media-links', LandRelatedMediaLinkController::class);
Route::resource('festivals-images', FestiableImageController::class);
Route::resource('land-related-video-links', LandRelatedVideoLinkController::class);
Route::resource('recent-updates', RecentUpdateController::class);
Route::resource('services', ServiceController::class);
Route::resource('menu-lists', MenuListController::class);


Route::resource('ayinbidhis', AyinbidhiController::class);
Route::resource('poripotro_proggapons', PoripotroProggaponController::class);
Route::resource('manuals', ManualController::class);
Route::resource('nitimalas', NitimalaController::class);
Route::resource('vhumi_sheba_forms', VhumiShebaFormController::class);
Route::resource('prokolpo_sarsongkheps', ProkolpoSarsongkhepController::class);
Route::resource('uddessho_lokkhos', UddesshoLokkhoController::class);
Route::resource('nagoriker_subidhas', NagorikerSubidhaController::class);
Route::resource('prokolper_outputs', ProkolperOutputController::class);
Route::resource('user_ask_questions', UserAskQuestionController::class);
Route::resource('visitors', VisitorController::class);
Route::resource('prokolpo_poricaloks', ProkolpoPoricalokController::class);