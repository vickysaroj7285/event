<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(
    ['prefix' => 'v1'],
    function () {
        Route::post('register', [AuthenticationController::class, 'register'])->name('register');
        Route::post('login', [AuthenticationController::class, 'login'])->name('login');
       

        // image to get text 

        Route::post('gettext', [AuthenticationController::class, 'ImageUpload'])->name('ImageUpload');

    }
);
