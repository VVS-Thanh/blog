<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('login', function () {
//     return view('home.login');
// })->name('login');
// Route::get('register', function () {
//     return view('home.register');
// })->name('register');
// Route::get('/', function () {
//     return view('home.index');
// })->name('dashboard');
// Route::get('/detail', function () {
//     return view('home.detail');
// })->name('detail');
// Route::get('/list_user_blog', function () {
//     return view('home.list_blog');
// })->name('list_user_blog');

Route::get('/', [\App\Http\Controllers\WebController::class, 'getIndex'])->name('dashboard');
Route::get('/top_blog', [\App\Http\Controllers\WebController::class, 'getTopBlog'])->name('top_blog');
Route::get('/login', [\App\Http\Controllers\WebController::class, 'getLogin'])->name('login');
Route::get('/register', [\App\Http\Controllers\WebController::class, 'getRegister'])->name('register');
Route::get('/detail', [\App\Http\Controllers\WebController::class, 'getDeatil'])->name('detail');
Route::get('/user_detail', [\App\Http\Controllers\WebController::class, 'getUserDetail'])->name('user_detail');
Route::get('/user_security_detail', [\App\Http\Controllers\WebController::class, 'getSecutityUser'])->name('user_security_detail');
Route::get('/list_user_blog', [\App\Http\Controllers\WebController::class, 'getListUserBlog'])->name('list_user_blog');
Route::get('/edit_blog/{id?}', [\App\Http\Controllers\WebController::class, 'getTest'])->name('edit_blog');
Route::get('/blog_detail/{id?}', [\App\Http\Controllers\WebController::class, 'getPostIndex'])->name('blog_detail');
Route::get('/profile/{id?}', [\App\Http\Controllers\WebController::class, 'getProfile'])->name('profile');
Route::get('/profile_user/{id?}', [\App\Http\Controllers\WebController::class, 'getProfileUser'])->name('profile_user');
Route::get('/list_blog_search/{keyword?}', [\App\Http\Controllers\WebController::class, 'getBlogAfterSearch'])->name('list_blog_search');



Route::get('/admin/user', [\App\Http\Controllers\WebController::class, 'getAdminDashboard'])->name('admin_user');
Route::get('/admin/type', [\App\Http\Controllers\WebController::class, 'getAdminType'])->name('admin_type');
Route::get('/admin/blog', [\App\Http\Controllers\WebController::class, 'getAdminBlog'])->name('admin_blog');

// Route::get('/login', [\App\Http\Controllers\WebController::class, 'login'])->name('login');