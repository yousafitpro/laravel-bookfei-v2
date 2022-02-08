<?php
Route::middleware('auth')
    ->prefix('admin/airline/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\AirlineController::class,'list'])->name('admin.airline.list');
        Route::post("create",[App\Http\Controllers\AirlineController::class,'create'])->name('admin.airline.create');
        Route::post("update/{id}",[App\Http\Controllers\AirlineController::class,'update'])->name('admin.airline.update');
        Route::get("delete/{id}",[App\Http\Controllers\AirlineController::class,'delete'])->name('admin.airline.delete');
    });
