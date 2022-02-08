<?php
Route::middleware('auth')
    ->prefix('admin/tourRateTable/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\TourRateController::class,'list'])->name('admin.tourRate.list');
        Route::post("create",[App\Http\Controllers\TourRateController::class,'create'])->name('admin.tourRate.create');
        Route::post("update/{id}",[App\Http\Controllers\TourRateController::class,'update'])->name('admin.tourRate.update');
        Route::get("delete/{id}",[App\Http\Controllers\TourRateController::class,'delete'])->name('admin.tourRate.delete');
    });
