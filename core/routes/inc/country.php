<?php
Route::middleware('auth')
    ->prefix('admin/country/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\CountryController::class,'list'])->name('admin.country.list');
        Route::post("create",[App\Http\Controllers\CountryController::class,'create'])->name('admin.country.create');
        Route::post("update/{id}",[App\Http\Controllers\CountryController::class,'update'])->name('admin.country.update');
        Route::get("delete/{id}",[App\Http\Controllers\CountryController::class,'delete'])->name('admin.country.delete');
        Route::post("deleteBulk",[App\Http\Controllers\CountryController::class,'deleteBulk'])->name('admin.country.deleteBulk');
        Route::get("add",[App\Http\Controllers\CountryController::class,'addView'])->name('admin.country.addView');
        Route::get("edit/{id}",[App\Http\Controllers\CountryController::class,'updateView'])->name('admin.country.updateView');

    });
