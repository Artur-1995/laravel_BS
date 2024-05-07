<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhotoController;


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

Route::get('photos', [PhotoController::class, 'show'])->name('photos');
Route::get('photo/{photoId}', [PhotoController::class, 'show'])->name('photo');