<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FileUploaded;


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





Route::redirect('/', 'login');

// Маршрут для создания пользователя
Route::get('register', [RegisterController::class, 'create'])->name('register.create'); // Метод просмотра страницы регистрации пользователя
Route::post('register/store', [RegisterController::class, 'store'])->name('register.store'); // Метод регистрации пользователя

// Маршрут для авторизации пользователя
Route::get('login', [LoginController::class, 'index'])->name('login'); // Метод просмотра страницы авторизации
Route::post('login/auth', [LoginController::class, 'store'])->name('login.store'); // Метод авторизации пользователя
Route::get('login/login.logout', [LoginController::class, 'logout'])->name('login.logout'); // Метод разавторизации пользователя


// методы для Авторизованных пользователей
Route::middleware('auth')->prefix('user')->group(function () {

    // Методы для получения токена
    Route::get('account', [UserController::class, 'index'])->name('user.account'); // Метод просмотра личного кабинета
    Route::get('getToken/{userId}', [UserController::class, 'store'])->name('user.getToken'); // Метод создания токена
    Route::get('setToken/{userId}', [UserController::class, 'destroy'])->name('user.setToken'); // Метод создания токена

    // Маршруты для работы с изображениями
    Route::get('upload.create', [FileUploaded::class, 'create'])->name('upload.create');
    Route::post('upload', [FileUploaded::class, 'upload'])->name('upload');
    Route::get('zip', [FileUploaded::class, 'zip'])->name('zip');

    // Маршруты для отображения изображений
    Route::get('photos', [PhotoController::class, 'index'])->name('photo.index'); // Метод просмотра страницы списка постов
    Route::get('photos/{photoId}', [PhotoController::class, 'show'])->name('photo.show'); // Метод просмотра страницы поста
    Route::get('orderby/name', [PhotoController::class, 'name'])->name('photo.name');
    Route::get('orderby/created', [PhotoController::class, 'created'])->name('photo.created');

});