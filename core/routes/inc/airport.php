<?php
Route::middleware('auth')
    ->prefix('admin/airport/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\AirportController::class,'list'])->name('admin.airport.list');
        Route::post("create",[App\Http\Controllers\AirportController::class,'create'])->name('admin.airport.create');
        Route::post("update/{id}",[App\Http\Controllers\AirportController::class,'update'])->name('admin.airport.update');
        Route::get("delete/{id}",[App\Http\Controllers\AirportController::class,'delete'])->name('admin.airport.delete');
    });
