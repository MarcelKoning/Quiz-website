<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;


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
    Route::get('/admin/quiz', [AdminQuizController::class, 'index'])->name('adminQuiz');
    Route::get('/admin/quiz/create', [AdminQuizController::class, 'create'])->name('quizCreate');
    Route::get('/admin/quiz/edit/{quiz}', [AdminQuizController::class, 'edit'])->name('quizEdit');
    Route::get('/admin/quiz/show/{quiz}', [AdminQuizController::class, 'show'])->name('quizShow');
    Route::post('/admin/quiz/store', [AdminQuizController::class, 'store'])->name('quizStore');
    Route::post('/admin/quiz/update/{quiz}', [AdminQuizController::class, 'update'])->name('quizUpdate');
});


