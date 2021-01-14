<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OAuthController;

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

Route::group(
    ['middleware' => 'guest'],
    function () {
        Route::get(
            '/login',
            [
                LoginController::class, 'signIn'
            ]
        )->name('login');
        Route::post(
            '/authenticate',
            [
                LoginController::class, 'authenticate'
            ]
        )->name('authenticate');

    }
);

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get(
            '/home',
            [
                HomeController::class, 'index'
            ]
        )->name('home');
        Route::post(
            '/logout',
            [
                LoginController::class, 'signOut'
            ]
        )->name('logout');
        Route::get(
            '/get_client',
            [
                HomeController::class, 'getPublicAuthDetails'
            ]
        );
        Route::get(
            '/oauth/authorize',
            [
                OAuthController::class, 'authorizeClientView'
            ]
        );
        Route::post(
            '/oauth/authorize',
            [
                OAuthController::class, 'authorizeClient'
            ]
        )->name('authorize');
    }
);
