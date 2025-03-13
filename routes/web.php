<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload-form', fn() => view('upload-form'));
Route::post('/upload', UploadController::class)->name('upload');
