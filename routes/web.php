<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController as PostRatings;
use App\Http\Controllers\CommentController as CommentRatings;
use App\Http\Controllers\ContactController;

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
Route::get('/', [HomeController::class, 'home']);
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/login', [AuthenticationController::class, 'index'])->name('login.index');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.sendEmail');
Route::resource('posts', PostController::class);
Route::resource('categories',CategoryController::class);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::middleware(['ajax'])->group(function(){
    Route::resource('posts.comments', CommentController::class);
});
//Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
//Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::resource('users', UserController::class);
Route::middleware(['auth'])->group(function(){
    Route::post('posts/{id}/post-ratings', [PostRatings::class, 'vote']);
    Route::post('posts/{postId}/comments/{commentId}/comment-ratings', [CommentRatings::class, 'vote']);
});

