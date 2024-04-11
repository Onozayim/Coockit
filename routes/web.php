<?php

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
})->name('home');


Route::prefix('recetas')->group(function () {
    Route::get('detail/{id}', 'RecetasController@detail')->name('recetas_detail');
});

//AQUI SE DEBE PONER LAS RUTAS QUE SOLO SE PUEDEN VER SI NO TIENE SESION
Route::middleware(['guest'])->group(function () {
    Route::prefix('register')->group(function () {
        Route::view('', 'auth.register')->name('register');
        Route::any('store', 'UserController@store')->name('store');
    });

    Route::prefix('login')->group(function () {
        Route::view('', 'auth.login')->name('login');
        Route::any('authenticate', 'UserController@authenticate')->name('authenticate');
    });
});


//AQUI SE DEBE PONER LAS RUTAS QUE SOLO SE PUEDEN VER SI NO TIENE SESION
Route::middleware(['auth'])->group(function () {
    Route::get('logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');

    Route::post('save_profile_picture', 'UserController@save_profile_picture')->name('save_profile_picture');

    Route::prefix('recetas')->group(function () {
        Route::get('', 'RecetasController@index')->name('recetas_index');
        Route::view('create', 'recetas.create')->name('recetas_create');
    });

    Route::prefix('plan')->group(function() {
        Route::get('/', 'PlanController@getPlan')->name('getPlan');
        Route::get('ingredientes', 'PlanController@getIngredientes')->name('getIngredientes');
    });

    Route::prefix('ajax')->group(function () {
        Route::post('saveReceta', "RecetasController@saveReceta")->name('saveReceta');
        Route::post('saveFavorite', "RecetasController@saveFavorite")->name('saveFavorite');
        Route::post('saveRecetaInMeal', "RecetasController@saveRecetaInMeal")->name('saveRecetaInMeal');

        Route::post('saveComentario', "ComentariosController@saveComentario")->name('saveComentario');
        Route::get('loadComments', "ComentariosController@loadComments")->name('loadComments');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index')->name('user');
    });
});

//AQUI SE DEBEN PONER LAS RUTAS A LAS QUE SOLO PUEDE ACCEDER ADMIN
Route::middleware(['admin'])->group(function () {
    Route::prefix('ajax')->group(function () {
        Route::post('verifyReceta', 'RecetasController@verifyReceta')->name('verifyReceta');
        Route::post('dennyReceta', 'RecetasController@dennyReceta')->name('dennyReceta');
    });

    Route::prefix('register')->group(function() {
        Route::view('register_admin','auth.register_admin')->name('register_admin'); 
        Route::any('store_admin', 'UserController@store_admin')->name('store_admin');
    });
});
