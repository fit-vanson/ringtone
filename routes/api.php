<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\RingtoneController;
use App\Http\Controllers\Api\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
if (App::environment('production', 'staging')) {
    URL::forceScheme('https');
}

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test-api',function (){
   return ['a'=>'ssss'];
});

Route::group([
//    'middleware' => 'auth.apikey'
    ], function() {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/popular', [CategoryController::class, 'getPopulared']);

    Route::get('categories/{category_id}/ringtones/{deviceId}', [RingtoneController::class, 'getRingtonesByCate']);
    Route::get('ringtone-detail/{id}/{device_id}', [RingtoneController::class, 'show']);
    Route::get('ringtones/featured', [RingtoneController::class, 'getFeatured']);
    Route::get('ringtones/popular/{deviceId}', [RingtoneController::class, 'getPopulared']);
    Route::get('ringtones/newest/{deviceId}', [RingtoneController::class, 'getNewest']);
    Route::get('ringtones/premium', [RingtoneController::class, 'getPremium']);
    Route::get('ringtones/most-download/{deviceId}', [RingtoneController::class, 'getMostDownload']);


    Route::post('ringtone-favorite/', [FavoriteController::class, 'likeRingtone']);
    Route::post('ringtone-favorite-unsaved/', [FavoriteController::class, 'disLikeRingtone']);
    Route::get('favorite/{device_id}', [FavoriteController::class, 'getSaved']);

    Route::post('search', [SearchController::class, 'search']);
});

