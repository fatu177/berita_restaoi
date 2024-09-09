<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/posts', [PostController::class,'posts']);
    Route::get('/posts/{id}', [PostController::class,'post']);
    Route::post('/posts/store', [PostController::class,'store']);
    Route::get('/logout', [AuthController::class,'logout']);
    Route::patch('/posts/update/{id}', [PostController::class,'update'])->middleware('contentOwner');
    Route::delete('/posts/delete/{id}', [PostController::class,'delete'])->middleware('contentOwner');
    Route::get('/me', [AuthController::class,'me']);

});
Route::post('/login', [AuthController::class,'login']);
