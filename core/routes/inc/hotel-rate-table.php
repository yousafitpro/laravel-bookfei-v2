<?php
Route::middleware('auth')
    ->prefix('admin/hotel-rate-table/')
    ->group(function () {
       Route::get("list/{id}",[App\Http\Controllers\HotelRateTableController::class,'list'])->name('admin.hotelRateTable.list');
        Route::post("create",[App\Http\Controllers\HotelRateTableController::class,'create'])->name('admin.hotelRateTable.create');
        Route::post("update/{id}",[App\Http\Controllers\HotelRateTableController::class,'update'])->name('admin.hotelRateTable.update');
        Route::get("delete/{id}",[App\Http\Controllers\HotelRateTableController::class,'delete'])->name('admin.hotelRateTable.delete');
    });
