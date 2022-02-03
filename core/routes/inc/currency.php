<?php
Route::middleware('auth')
    ->prefix('admin/currency/')
    ->group(function () {
       Route::get("list",[App\Http\Controllers\CurrencyController::class,'list'])->name('admin.currency.list');
        Route::post("create",[App\Http\Controllers\CurrencyController::class,'create'])->name('admin.currency.create');
        Route::post("update/{id}",[App\Http\Controllers\CurrencyController::class,'update'])->name('admin.currency.update');
        Route::get("delete/{id}",[App\Http\Controllers\CurrencyController::class,'delete'])->name('admin.currency.delete');
    });
