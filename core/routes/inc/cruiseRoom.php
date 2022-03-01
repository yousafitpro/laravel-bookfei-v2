<?php
Route::middleware('auth')
    ->prefix('admin/cruise-room/')
    ->group(function () {
       Route::get("list/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'list'])->name('admin.shipRoom.list');
        Route::post("create",[App\Http\Controllers\CruiseShipRoomTypeController::class,'create'])->name('admin.shipRoom.create');
        Route::post("update/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'update'])->name('admin.shipRoom.update');
        Route::get("delete/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'delete'])->name('admin.shipRoom.delete');
    });
