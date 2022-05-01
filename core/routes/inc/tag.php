<?php
Route::middleware('auth')
    ->prefix('admin/tag/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\TagController::class,'list'])->name('admin.tag.list');
       Route::get("clear",[App\Http\Controllers\TagController::class,'clear'])->name('admin.tag.clear');
        Route::post("create",[App\Http\Controllers\TagController::class,'create'])->name('admin.tag.create');
        Route::post("update/{id}",[App\Http\Controllers\TagController::class,'update'])->name('admin.tag.update');
        Route::get("delete/{id}",[App\Http\Controllers\TagController::class,'delete'])->name('admin.tag.delete');
        Route::post("deleteBulk",[App\Http\Controllers\TagController::class,'deleteBulk'])->name('admin.tag.deleteBulk');
        Route::get("add",[App\Http\Controllers\TagController::class,'addView'])->name('admin.tag.addView');
        Route::get("edit/{id}",[App\Http\Controllers\TagController::class,'updateView'])->name('admin.tag.updateView');

    });
