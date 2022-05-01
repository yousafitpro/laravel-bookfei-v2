<?php
Route::middleware('auth')
    ->prefix('admin/travel-product/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\TravelProductController::class,'list'])->name('admin.travel_product.list');
       Route::get("clear-filter",[App\Http\Controllers\TravelProductController::class,'clear_filter'])->name('admin.travel_product.clear_filter');
        Route::post("create",[App\Http\Controllers\TravelProductController::class,'create'])->name('admin.travel_product.create');
        Route::post("update/{id}",[App\Http\Controllers\TravelProductController::class,'update'])->name('admin.travel_product.update');
        Route::get("delete/{id}",[App\Http\Controllers\TravelProductController::class,'delete'])->name('admin.travel_product.delete');
        Route::post("deleteBulk",[App\Http\Controllers\TravelProductController::class,'deleteBulk'])->name('admin.travel_product.deleteBulk');
        Route::get("editOrCreate/{id}",[App\Http\Controllers\TravelProductController::class,'editOrCreate'])->name('admin.travel_product.editOrCreate');
        Route::get("addOffer",[App\Http\Controllers\TravelProductController::class,'addOffer'])->name('admin.travel_product.addOffer');
        Route::post("deleteOffers",[App\Http\Controllers\TravelProductController::class,'deleteOffers'])->name('admin.travel_product.deleteOffers');


    });
