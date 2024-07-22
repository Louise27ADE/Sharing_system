<?php

namespace App\Http\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamPaperController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route pour obtenir la liste des sujets d'examen
Route::get('exam-papers', [ExamPaperController::class, 'index']);

// Route pour obtenir un sujet d'examen spécifique
Route::get('exam-papers/{id}', [ExamPaperController::class, 'show']);

// Route pour créer un nouveau sujet d'examen (authentifié)
Route::post('exam-papers', [ExamPaperController::class, 'store'])->middleware('auth:sanctum');

// Route pour mettre à jour un sujet d'examen (authentifié)
Route::put('exam-papers/{id}', [ExamPaperController::class, 'update'])->middleware('auth:sanctum');

// Route pour supprimer un sujet d'examen (authentifié)
Route::delete('exam-papers/{id}', [ExamPaperController::class, 'destroy'])->middleware('auth:sanctum');

// Routes pour l'authentification
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
