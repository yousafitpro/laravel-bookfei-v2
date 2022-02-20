<?php
Route::middleware('auth')
    ->prefix('admin/hotel-room/')
    ->group(function () {
       Route::get("list/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'list'])->name('admin.hotelRoom.list');
        Route::post("create",[App\Http\Controllers\HotelRoomTypeController::class,'create'])->name('admin.hotelRoom.create');
        Route::post("update/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'update'])->name('admin.hotelRoom.update');
        Route::get("delete/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'delete'])->name('admin.hotelRoom.delete');
    });
