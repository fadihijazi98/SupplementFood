<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

// ingredient : i mean of it : amounts and ratios

Route::get('/', function () {
    if(auth()->user()) {
        return redirect('/home');
    }
    return view('auth.login');
});

Auth::routes();


Route::middleware('auth')->group(function () {

    Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/supplement', Controllers\SupplementsController::class);

    Route::resource('/ingredient', Controllers\IngredientsController::class);

    Route::resource('/warning', Controllers\WarningsController::class);

    Route::resource('/image', Controllers\ImagesController::class);

});

