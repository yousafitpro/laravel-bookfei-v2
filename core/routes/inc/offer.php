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


    });
