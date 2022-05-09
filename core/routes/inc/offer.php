<?php
Route::middleware('auth')
    ->prefix('admin/offer/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\OfferController::class,'list'])->name('admin.offer.list');
        Route::post("create",[App\Http\Controllers\OfferController::class,'create'])->name('admin.offer.create');
        Route::post("update/{id}",[App\Http\Controllers\OfferController::class,'update'])->name('admin.offer.update');
        Route::get("delete/{id}",[App\Http\Controllers\OfferController::class,'delete'])->name('admin.offer.delete');
        Route::post("deleteBulk",[App\Http\Controllers\OfferController::class,'deleteBulk'])->name('admin.offer.deleteBulk');
        Route::get("editOrCreate/{id}",[App\Http\Controllers\OfferController::class,'editOrCreate'])->name('admin.offer.editOrCreate');
        Route::get("UpdateHotelRateTableList",[App\Http\Controllers\OfferController::class,'UpdateHotelRateTableList'])->name('admin.offer.UpdateHotelRateTableList');
        Route::post("addHotel",[App\Http\Controllers\OfferController::class,'addHotel'])->name('admin.offer.addHotel');
        Route::get("removeHotel/{id}",[App\Http\Controllers\OfferController::class,'removeHotel'])->name('admin.offer.removeHotel');

        Route::post("addFlight",[App\Http\Controllers\OfferController::class,'addFlight'])->name('admin.offer.addFlight');
        Route::get("removeFlight/{id}",[App\Http\Controllers\OfferController::class,'removeFlight'])->name('admin.offer.removeFlight');
        Route::post("addTour",[App\Http\Controllers\OfferController::class,'addTour'])->name('admin.offer.addTour');
        Route::post("removeTour",[App\Http\Controllers\OfferController::class,'removeTour'])->name('admin.offer.removeTour');
        Route::post("updateTotalHotel",[App\Http\Controllers\OfferController::class,'updateTotalHotel'])->name('admin.offer.updateTotalHotel');
        Route::post("updateOfferHotelColumn",[App\Http\Controllers\OfferController::class,'updateOfferHotelColumn'])->name('admin.offer.updateOfferHotelColumn');

    });
