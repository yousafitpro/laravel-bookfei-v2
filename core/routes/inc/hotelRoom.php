<?php
Route::middleware('auth')
    ->prefix('admin/hotel-room/')
    ->group(function () {
       Route::get("list/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'list'])->name('admin.hotelRoom.list');
       Route::get("create/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'createView'])->name('admin.hotelRoom.createView');
       Route::get("update/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'updateView'])->name('admin.hotelRoom.updateView');
       Route::any("rateTable/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'rateTable'])->name('admin.hotelRoom.rateTable');
       Route::get("createLink/{id}/{table_id}",[App\Http\Controllers\HotelRoomTypeController::class,'createLink'])->name('admin.hotelRoom.createLink');
        Route::post("create",[App\Http\Controllers\HotelRoomTypeController::class,'create'])->name('admin.hotelRoom.create');
        Route::post("createRateTable",[App\Http\Controllers\HotelRoomTypeController::class,'createRateTable'])->name('admin.hotelRoom.createRateTable');
        Route::post("update/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'update'])->name('admin.hotelRoom.update');
        Route::get("delete/{id}",[App\Http\Controllers\HotelRoomTypeController::class,'delete'])->name('admin.hotelRoom.delete');
    });
