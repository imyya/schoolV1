<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\Salle;
use App\Models\Module;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\SessionCoursController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/cours', 'CoursController@store');
Route::get('/cours', [CoursController::class,'index']);
Route::post('/cours', [CoursController::class,'store']);
Route::get('/module', [ModuleController::class,'index']);
Route::get('/module', [ModuleController::class,'index']);
Route::get('/module/profs/{id}', [ModuleController::class,'getProfsByModule']);
Route::get('/classe', [ClasseController::class,'index']);
Route::get('/semestre', [SemestreController::class,'index']);
Route::get('/salle', [SalleController::class,'index']);
Route::get('/cours/{id}/classes', [CoursController::class,'getClassesByCours']);
Route::get('/session', [SessionCoursController::class,'index']);
Route::post('/session', [SessionCoursController::class,'create']);
Route::post('/inscription', [UserController::class,'import']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);












