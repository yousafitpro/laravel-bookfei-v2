<?php
Route::middleware('auth')
    ->prefix('admin/cruise-ship/')
    ->group(function () {
       Route::get("list/{id}",[App\Http\Controllers\CruiseShipController::class,'list'])->name('admin.cruiseShip.list');
        Route::post("create",[App\Http\Controllers\CruiseShipController::class,'create'])->name('admin.cruiseShip.create');
        Route::post("update/{id}",[App\Http\Controllers\CruiseShipController::class,'update'])->name('admin.cruiseShip.update');
        Route::get("delete/{id}",[App\Http\Controllers\CruiseShipController::class,'delete'])->name('admin.cruiseShip.delete');
    });
