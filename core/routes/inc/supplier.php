<?php
Route::middleware('auth')
    ->prefix('admin/supplier/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\SupplierController::class,'list'])->name('admin.supplier.list');
        Route::post("create",[App\Http\Controllers\SupplierController::class,'create'])->name('admin.supplier.create');
        Route::post("update/{id}",[App\Http\Controllers\SupplierController::class,'update'])->name('admin.supplier.update');
        Route::get("delete/{id}",[App\Http\Controllers\SupplierController::class,'delete'])->name('admin.supplier.delete');
    });
