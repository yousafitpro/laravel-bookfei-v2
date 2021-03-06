<?php
Route::middleware('auth')
    ->prefix('admin/airport/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\AirportController::class,'list'])->name('admin.airport.list');
       Route::get("clear",[App\Http\Controllers\AirportController::class,'clear'])->name('admin.airport.clear');
        Route::post("create",[App\Http\Controllers\AirportController::class,'create'])->name('admin.airport.create');
        Route::post("update/{id}",[App\Http\Controllers\AirportController::class,'update'])->name('admin.airport.update');
        Route::get("delete/{id}",[App\Http\Controllers\AirportController::class,'delete'])->name('admin.airport.delete');
        Route::post("deleteBulk",[App\Http\Controllers\AirportController::class,'deleteBulk'])->name('admin.airport.deleteBulk');
        Route::get("add",[App\Http\Controllers\AirportController::class,'addView'])->name('admin.airport.addView');
        Route::get("edit/{id}",[App\Http\Controllers\AirportController::class,'updateView'])->name('admin.airport.updateView');

    });
