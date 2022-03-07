<?php
Route::middleware('auth')
    ->prefix('admin/airline/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\AirlineController::class,'list'])->name('admin.airline.list');
        Route::post("create",[App\Http\Controllers\AirlineController::class,'create'])->name('admin.airline.create');
        Route::post("update/{id}",[App\Http\Controllers\AirlineController::class,'update'])->name('admin.airline.update');
        Route::get("delete/{id}",[App\Http\Controllers\AirlineController::class,'delete'])->name('admin.airline.delete');
        Route::post("deleteBulk",[App\Http\Controllers\AirlineController::class,'deleteBulk'])->name('admin.airLine.deleteBulk');
        Route::get("add",[App\Http\Controllers\AirlineController::class,'addView'])->name('admin.airLine.addView');
        Route::get("edit/{id}",[App\Http\Controllers\AirlineController::class,'updateView'])->name('admin.airLine.updateView');


    });
