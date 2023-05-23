<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('hk/projects/{token}',[\App\Http\Controllers\ApiController::class,'projects']);
Route::get('hk/projects/{slug}/{token}',[\App\Http\Controllers\ApiController::class,'content']);
Route::get('hk/personalDetails/{token}',[\App\Http\Controllers\ApiController::class,'personalDetails']);
