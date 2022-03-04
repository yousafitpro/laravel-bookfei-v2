<?php
Route::middleware('auth')
    ->prefix('file-uploader/')
    ->group(function () {
       Route::post("upload",[App\Http\Controllers\MyFileController::class,'upload'])->name('myfileUploader.upload');
       Route::get("list",[App\Http\Controllers\MyFileController::class,'list'])->name('myfileUploader.list');
       Route::get("getCardImages",[App\Http\Controllers\MyFileController::class,'getCardImages'])->name('myfileUploader.getCardImages');
       Route::get("removeFile",[App\Http\Controllers\MyFileController::class,'removeFile'])->name('myfileUploader.removeFile');

    });
