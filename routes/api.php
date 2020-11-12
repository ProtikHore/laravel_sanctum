<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['auth:sanctum']], function(){
	Route::get('/userall', [HomeController::class, 'getUserAll']);
	Route::get('user/{id}', [HomeController::class, 'getUser']);
	Route::get('/logout', [HomeController::class, 'logout']);
});



Route::post('/home', [HomeController::class, 'index']);

Route::get('/hash', function () {
    return Hash::Make(123);
});
