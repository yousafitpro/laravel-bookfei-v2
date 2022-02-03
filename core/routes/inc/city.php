<?php
Route::middleware('auth')
    ->prefix('admin/city/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\CityController::class,'list'])->name('admin.city.list');
        Route::post("create",[App\Http\Controllers\CityController::class,'create'])->name('admin.city.create');
        Route::post("update/{id}",[App\Http\Controllers\CityController::class,'update'])->name('admin.city.update');
        Route::get("delete/{id}",[App\Http\Controllers\CityController::class,'delete'])->name('admin.city.delete');
    });
