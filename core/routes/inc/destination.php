<?php
Route::middleware('auth')
    ->prefix('admin/destination/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\DestinationController::class,'list'])->name('admin.destination.list');
        Route::post("create",[App\Http\Controllers\DestinationController::class,'create'])->name('admin.destination.create');
        Route::post("update/{id}",[App\Http\Controllers\DestinationController::class,'update'])->name('admin.destination.update');
        Route::get("delete/{id}",[App\Http\Controllers\DestinationController::class,'delete'])->name('admin.destination.delete');
        Route::post("deleteBulk",[App\Http\Controllers\DestinationController::class,'deleteBulk'])->name('admin.destination.deleteBulk');
        Route::get("add",[App\Http\Controllers\DestinationController::class,'addView'])->name('admin.destination.addView');
        Route::get("edit/{id}",[App\Http\Controllers\DestinationController::class,'updateView'])->name('admin.destination.updateView');

    });
