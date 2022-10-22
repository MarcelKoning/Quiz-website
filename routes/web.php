<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/quiz/{name}/{quiz}', [QuizController::class, 'show'])->name('playQuiz');
Route::post('/quiz/{name}/{quiz}/store', [QuizController::class, 'store'])->name('playQuizStore');

// Admin panel

Route::middleware('role:admin')->group(function () {

    // Admin Quiz
    Route::get('/admin/quiz', [AdminQuizController::class, 'index'])->name('adminQuiz');
    Route::get('/admin/quiz/create', [AdminQuizController::class, 'create'])->name('quizCreate');
    Route::get('/admin/quiz/edit/{quiz}', [AdminQuizController::class, 'edit'])->name('quizEdit');
    Route::get('/admin/quiz/show/{quiz}', [AdminQuizController::class, 'show'])->name('quizShow');
    Route::post('/admin/quiz/store', [AdminQuizController::class, 'store'])->name('quizStore');
    Route::post('/admin/quiz/update/{quiz}', [AdminQuizController::class, 'update'])->name('quizUpdate');

    // Admin User
    Route::get('/admin/user', [UserController::class, 'index'])->name('adminUser');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('adminUserCreate');
    Route::get('/admin/user/edit/{user}', [UserController::class, 'edit'])->name('adminUserEdit');
    Route::get('/admin/user/show/{user}', [UserController::class, 'show'])->name('adminUserShow');
    Route::post('/admin/user/store', [UserController::class, 'store'])->name('adminUserStore');
    Route::post('/admin/user/update/{user}', [UserController::class, 'update'])->name('adminUserUpdate');
});


