<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get( '/upload-excel', [ CategoryController::class, 'showUploadForm' ] )->name( 'categories.upload.form' );
Route::post( '/upload-excel', [ CategoryController::class, 'handleUpload' ] )->name( 'categories.upload' );
