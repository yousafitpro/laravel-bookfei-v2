<?php
Route::middleware('auth')
    ->prefix('admin/cruise-rate-table/')
    ->group(function () {
       Route::get("list/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'list'])->name('admin.cruiseRateTable.list');
        Route::post("create",[App\Http\Controllers\CruiseShipRateTableController::class,'create'])->name('admin.cruiseRateTable.create');
        Route::post("update/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'update'])->name('admin.cruiseRateTable.update');
        Route::get("delete/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'delete'])->name('admin.cruiseRateTable.delete');
    });
