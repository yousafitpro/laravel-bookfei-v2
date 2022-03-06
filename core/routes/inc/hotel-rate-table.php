<?php
Route::middleware('auth')
    ->prefix('admin/hotel-rate-table/')
    ->group(function () {
       Route::get("list/{id}",[App\Http\Controllers\HotelRateTableController::class,'list'])->name('admin.hotelRateTable.list');
        Route::post("create",[App\Http\Controllers\HotelRateTableController::class,'create'])->name('admin.hotelRateTable.create');
        Route::get("editOrCreate/{id}",[App\Http\Controllers\HotelRateTableController::class,'editOrCreate'])->name('admin.hotelRateTable.editOrCreate');

        Route::post("update/{id}",[App\Http\Controllers\HotelRateTableController::class,'update'])->name('admin.hotelRateTable.update');
        Route::get("delete/{id}",[App\Http\Controllers\HotelRateTableController::class,'delete'])->name('admin.hotelRateTable.delete');
        Route::post("toggle/{id}",[App\Http\Controllers\HotelRateTableController::class,'toggle'])->name('admin.tourRate.toggle');
        Route::post("updateColumn/{id}",[App\Http\Controllers\HotelRateTableController::class,'updateColumn'])->name('admin.tourRate.toggle');
        Route::post("deleteBulk",[App\Http\Controllers\HotelRateTableController::class,'deleteBulk'])->name('admin.hotelRateTable.deleteBulk');
        Route::post("cloneBulk",[App\Http\Controllers\HotelRateTableController::class,'cloneBulk'])->name('admin.hotelRateTable.cloneBulk');

    });
