<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/store', [RegisterController::class, 'store'])->name('auth.store');

Route::get('/', [RegisterController::class, 'login'])->name('auth.login');
Route::post('/loginaction', [RegisterController::class, 'loginaction'])->name('auth.loginaction');
Route::get('/logout', [RegisterController::class, 'logout'])->name('auth.logout');
Route::get('/logout', [RegisterController::class, 'logout'])->name('auth.logout');
Route::get('/task-index', [TaskController::class, 'index'])->name('task.index');
Route::get('/task-create', [TaskController::class, 'create'])->name('task.create');
Route::post('/task-store', [TaskController::class, 'store'])->name('task.store');
// Route::get('/task-show', [TaskController::class, 'show'])->name('task.show');

Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('task.show');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('task.update');

Route::get('/comment/{comment}/create', [CommentController::class, 'create'])->name('comment.create');
Route::get('/comment-index', [CommentController::class, 'index'])->name('comment.index');
Route::post('/comment-store', [CommentController::class, 'store'])->name('comment.store');
Route::get('/comment/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
Route::get('/commentshow/{id}', [CommentController::class, 'show'])->name('comment.show');
Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');

Route::get('/profile', [RegisterController::class, 'profile'])->name('profile');








// Route::get('/login', [RegisterController::class, 'login'])->name('auth.login');



