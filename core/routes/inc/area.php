<?php
Route::middleware('auth')
    ->prefix('admin/area/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\AreaController::class,'list'])->name('admin.area.list');
        Route::post("create",[App\Http\Controllers\AreaController::class,'create'])->name('admin.area.create');
        Route::post("update/{id}",[App\Http\Controllers\AreaController::class,'update'])->name('admin.area.update');
        Route::get("delete/{id}",[App\Http\Controllers\AreaController::class,'delete'])->name('admin.area.delete');
        Route::post("deleteBulk",[App\Http\Controllers\AreaController::class,'deleteBulk'])->name('admin.area.deleteBulk');
        Route::get("add",[App\Http\Controllers\AreaController::class,'addView'])->name('admin.area.addView');
        Route::get("edit/{id}",[App\Http\Controllers\AreaController::class,'updateView'])->name('admin.area.updateView');

    });
