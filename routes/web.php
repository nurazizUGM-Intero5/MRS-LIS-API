<?php

use App\Http\Controllers\Orders;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('lab-orders')->controller(Orders::class)
    ->group(function () {
        Route::get('/', 'index')->name('lab-orders.index');
        Route::get('/{id}', 'show')->name('lab-orders.show');
        Route::put('/{id}', 'update')->name('lab-orders.update');
        Route::delete('/{id}', 'destroy')->name('lab-orders.destroy');
    });
