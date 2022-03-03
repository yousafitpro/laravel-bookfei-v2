<?php
Route::middleware('auth')
    ->prefix('admin/hotel/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\HotelController::class,'list'])->name('admin.hotel.list');
        Route::get("editOrCreate/{id}",[App\Http\Controllers\HotelController::class,'editOrCreate'])->name('admin.hotel.editOrCreate');

        Route::post("create",[App\Http\Controllers\HotelController::class,'create'])->name('admin.hotel.create');
        Route::post("update/{id}",[App\Http\Controllers\HotelController::class,'update'])->name('admin.hotel.update');
        Route::get("delete/{id}",[App\Http\Controllers\HotelController::class,'delete'])->name('admin.hotel.delete');
    });
