<?php
Route::middleware('auth')
    ->prefix('admin/config/')
    ->group(function () {
       Route::get("index",[App\Http\Controllers\ConfigController::class,'index'])->name('admin.config.index');
        Route::post("update",[App\Http\Controllers\ConfigController::class,'update'])->name('admin.config.update');
    });
