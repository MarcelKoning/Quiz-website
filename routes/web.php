<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;


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
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Quiz
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
Route::get('/quiz/{name}/{quiz}', [QuizController::class, 'show'])->name('playQuiz');
Route::post('/quiz/{name}/{quiz}/store', [QuizController::class, 'store'])->name('playQuizStore');

// Login / Register

Route::get('/register', [UserController::class, 'create'])->name('userCreate');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/user/login', [LoginController::class, 'login'])->name('userLogin');

Route::middleware('role:user')->group(function () {
    // User

});



// Admin panel

Route::group(['middleware' => 'auth'], function () {

    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // User Panel
    Route::get('/user', [UserController::class, 'index'])->name('userPanel');

    // Role User
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('userEdit');
    Route::get('/user/show/{user}', [UserController::class, 'show'])->name('userShow');
    Route::post('/user/update/{user}', [UserController::class, 'update'])->name('userUpdate');

    // Role Admin
    Route::middleware('role:admin')->group(function () {

        // Admin Panel
        Route::get('/admin', [AdminController::class, 'index'])->name('adminPanel');

        // Admin Quiz
        Route::get('/admin/quiz', [AdminQuizController::class, 'index'])->name('adminQuiz');
        Route::get('/admin/quiz/create', [AdminQuizController::class, 'create'])->name('quizCreate');
        Route::get('/admin/quiz/edit/{quiz}', [AdminQuizController::class, 'edit'])->name('quizEdit');
        Route::get('/admin/quiz/show/{quiz}', [AdminQuizController::class, 'show'])->name('quizShow');
        Route::post('/admin/quiz/store', [AdminQuizController::class, 'store'])->name('quizStore');
        Route::post('/admin/quiz/update/{quiz}', [AdminQuizController::class, 'update'])->name('quizUpdate');

        // Admin User
        Route::get('/admin/user', [AdminUserController::class, 'index'])->name('adminUser');
        Route::get('/admin/user/create', [AdminUserController::class, 'create'])->name('adminUserCreate');
        Route::get('/admin/user/edit/{user}', [AdminUserController::class, 'edit'])->name('adminUserEdit');
        Route::get('/admin/user/show/{user}', [AdminUserController::class, 'show'])->name('adminUserShow');
        Route::post('/admin/user/store', [AdminUserController::class, 'store'])->name('adminUserStore');
        Route::post('/admin/user/update/{user}', [AdminUserController::class, 'update'])->name('adminUserUpdate');
    });
});


