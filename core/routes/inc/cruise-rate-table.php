<?php

Route::middleware('auth')
    ->prefix('admin/ship-rate-table/')
    ->group(function () {
        Route::get("list/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'list'])->name('admin.shipRateTable.list');
        Route::post("create",[App\Http\Controllers\CruiseShipRateTableController::class,'create'])->name('admin.shipRateTable.create');
        Route::get("editOrCreate/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'editOrCreate'])->name('admin.shipRateTable.editOrCreate');

        Route::post("update/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'update'])->name('admin.shipRateTable.update');
        Route::get("delete/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'delete'])->name('admin.shipRateTable.delete');
        Route::post("toggle/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'toggle'])->name('admin.tourRate.toggle');
        Route::post("updateColumn/{id}",[App\Http\Controllers\CruiseShipRateTableController::class,'updateColumn'])->name('admin.tourRate.toggle');
        Route::post("deleteBulk",[App\Http\Controllers\CruiseShipRateTableController::class,'deleteBulk'])->name('admin.shipRateTable.deleteBulk');
        Route::post("cloneBulk",[App\Http\Controllers\CruiseShipRateTableController::class,'cloneBulk'])->name('admin.shipRateTable.cloneBulk');

    });
