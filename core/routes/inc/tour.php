<?php
Route::middleware('auth')
    ->prefix('admin/tour/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\TourController::class,'list'])->name('admin.tour.list');
        Route::post("create",[App\Http\Controllers\TourController::class,'create'])->name('admin.tour.create');
        Route::post("update/{id}",[App\Http\Controllers\TourController::class,'update'])->name('admin.tour.update');
        Route::get("delete/{id}",[App\Http\Controllers\TourController::class,'delete'])->name('admin.tour.delete');
        Route::post("deleteBulk",[App\Http\Controllers\TourController::class,'deleteBulk'])->name('admin.tour.deleteBulk');
        Route::get("editOrCreate/{id}",[App\Http\Controllers\TourController::class,'editOrCreate'])->name('admin.tour.editOrCreate');


    });
