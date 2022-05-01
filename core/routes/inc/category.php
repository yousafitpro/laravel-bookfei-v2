<?php
Route::middleware('auth')
    ->prefix('admin/category/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\CategoryController::class,'list'])->name('admin.category.list');
       Route::get("clear",[App\Http\Controllers\CategoryController::class,'clear'])->name('admin.category.clear');
        Route::post("create",[App\Http\Controllers\CategoryController::class,'create'])->name('admin.category.create');
        Route::post("update/{id}",[App\Http\Controllers\CategoryController::class,'update'])->name('admin.category.update');
        Route::get("delete/{id}",[App\Http\Controllers\CategoryController::class,'delete'])->name('admin.category.delete');
        Route::post("deleteBulk",[App\Http\Controllers\CategoryController::class,'deleteBulk'])->name('admin.category.deleteBulk');
        Route::get("add",[App\Http\Controllers\CategoryController::class,'addView'])->name('admin.category.addView');
        Route::get("edit/{id}",[App\Http\Controllers\CategoryController::class,'updateView'])->name('admin.category.updateView');

    });
