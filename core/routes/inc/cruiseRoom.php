<?php

Route::middleware('auth')
    ->prefix('admin/ship-room/')
    ->group(function () {
        Route::get("list/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'list'])->name('admin.shipRoom.list');
        Route::get("create/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'createView'])->name('admin.shipRoom.createView');
        Route::get("update/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'updateView'])->name('admin.shipRoom.updateView');
        Route::any("rateTable/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'rateTable'])->name('admin.shipRoom.rateTable');
        Route::get("createLink/{id}/{table_id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'createLink'])->name('admin.shipRoom.createLink');
        Route::post("create",[App\Http\Controllers\CruiseShipRoomTypeController::class,'create'])->name('admin.shipRoom.create');
        Route::post("createRateTable",[App\Http\Controllers\CruiseShipRoomTypeController::class,'createRateTable'])->name('admin.shipRoom.createRateTable');
        Route::post("update/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'update'])->name('admin.shipRoom.update');
        Route::get("delete/{id}",[App\Http\Controllers\CruiseShipRoomTypeController::class,'delete'])->name('admin.shipRoom.delete');
        Route::post("deleteBulk",[App\Http\Controllers\CruiseShipRoomTypeController::class,'deleteBulk'])->name('admin.shipRoom.deleteBulk');

    });
