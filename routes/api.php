<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\TypeController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
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
Route::resource('type', TypeController::class);

Route::resource('post', PostController::class);
Route::post('post/{post_id}/comment', [PostController::class, 'comment']);
Route::post('post/{post_id}/like', [PostController::class, 'like']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me/post', [AuthController::class, 'getAllPostByUser']);
    Route::get('me', 'me');
    Route::put('me', [AuthController::class, 'updateUser']);
});

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/all', 'index');
    Route::get('/{id}', 'show');
    Route::put('/update', 'updateUserById');
});





