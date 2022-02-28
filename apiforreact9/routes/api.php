<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//post
Route::get('/posts',[\App\Http\Controllers\PostController::class,'index']);
Route::post('/post/create',[\App\Http\Controllers\PostController::class,'store']);
Route::get('/post/{id}',[\App\Http\Controllers\PostController::class,'show']);
Route::put('/post/update/{id}',[\App\Http\Controllers\PostController::class,'update']);
Route::delete('/post/delete/{id}',[\App\Http\Controllers\PostController::class,'destroy']);
//comment
Route::get('/comments',[\App\Http\Controllers\CommentController::class,'index']);
Route::post('/comment/create',[\App\Http\Controllers\CommentController::class,'store']);
Route::get('/comment/{id}',[\App\Http\Controllers\CommentController::class,'show']);
Route::put('/comment/update/{id}',[\App\Http\Controllers\CommentController::class,'update']);
Route::delete('/comment/delete/{id}',[\App\Http\Controllers\CommentController::class,'destroy']);
