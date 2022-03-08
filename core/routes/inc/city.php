<?php
Route::middleware('auth')
    ->prefix('admin/city/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\CityController::class,'list'])->name('admin.city.list');
        Route::post("create",[App\Http\Controllers\CityController::class,'create'])->name('admin.city.create');
        Route::post("update/{id}",[App\Http\Controllers\CityController::class,'update'])->name('admin.city.update');
        Route::get("delete/{id}",[App\Http\Controllers\CityController::class,'delete'])->name('admin.city.delete');
        Route::post("deleteBulk",[App\Http\Controllers\CityController::class,'deleteBulk'])->name('admin.city.deleteBulk');
        Route::get("add",[App\Http\Controllers\CityController::class,'addView'])->name('admin.city.addView');
        Route::get("edit/{id}",[App\Http\Controllers\CityController::class,'updateView'])->name('admin.city.updateView');

    });
