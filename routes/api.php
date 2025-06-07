<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LabOrderController;
use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', [HomeController::class, 'index'])
    ->name('api.home');

Route::prefix('patients')->group(function () {
    Route::get('/', [PatientController::class, 'getAllPatients'])
        ->name('api.patients.index');
    Route::get('/{id}', [PatientController::class, 'getPatient'])
        ->name('api.patients.show');
});

Route::prefix('lab-orders')->group(function () {
    Route::get('/', [LabOrderController::class, 'getAllLabOrders'])
        ->name('api.lab-orders.index');
    Route::get('/{id}', [LabOrderController::class, 'getLabOrder'])
        ->name('api.lab-orders.show');
    Route::post('/', [LabOrderController::class, 'createLabOrder'])
        ->name('api.lab-orders.store');
});
