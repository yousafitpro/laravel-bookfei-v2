<?php
Route::middleware('auth')
    ->prefix('admin/cruiseLine/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\CruiseLineController::class,'list'])->name('admin.cruiseLine.list');
        Route::post("create",[App\Http\Controllers\CruiseLineController::class,'create'])->name('admin.cruiseLine.create');
        Route::post("update/{id}",[App\Http\Controllers\CruiseLineController::class,'update'])->name('admin.cruiseLine.update');
        Route::get("delete/{id}",[App\Http\Controllers\CruiseLineController::class,'delete'])->name('admin.cruiseLine.delete');
    });
