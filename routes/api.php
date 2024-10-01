<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\SubprojectController;
use App\Http\Controllers\API\LoginController;
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





  
Route::post('login', [LoginController::class, 'login']);
Route::group(['middleware'=>'auth:sanctum'],function () {


  Route::apiResource('options', OptionController::class);
    
  Route::apiResource('projects', ProjectController::class);
  Route::apiResource('teams', TeamController::class);
  Route::apiResource('tasks', TaskController::class);
  Route::apiResource('subprojects', SubprojectController::class);
});

