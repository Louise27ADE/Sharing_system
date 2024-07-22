<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExamPaperController;
use App\Http\Controllers\AuthController;

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

// Route pour la page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route pour afficher un sujet d'examen
Route::get('exam-papers/{id}', [ExamPaperController::class, 'show'])->name('exam-papers.show');

// Route pour la page de connexion
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Route pour la page d'enregistrement
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Routes pour les utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});
