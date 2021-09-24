<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaturityController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', function(){
        return 'API online';
    });

    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('create', [UserController::class, 'store']);
    });
    
    Route::middleware(['authenticated'])->group(function () {
        Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
            Route::get('me', [AuthController::class, 'me']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('logout', [AuthController::class, 'logout']);
        });
        
        Route::resource('user', UserController::class);
        
        Route::resource('services', ServiceController::class);
        Route::get('search_service', [ServiceController::class, 'search']);
        
        Route::resource('maturity', MaturityController::class);
        Route::get('search_maturity', [MaturityController::class, 'search']);        
    });



