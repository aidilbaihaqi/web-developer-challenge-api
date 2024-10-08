<?php

use App\Http\Controllers\API\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [APIController::class, 'login']);

Route::middleware('auth.token')->group(function () {
  Route::post('teachingclass', [APIController::class, 'teachingclass']);

  Route::post('listCPL', [APIController::class, 'listCPL']);
  Route::post('addCPL', [APIController::class, 'addCPL']);
  Route::post('updateCPL', [APIController::class, 'updateCPL']);
  Route::post('removeCPL', [APIController::class, 'removeCPL']);

  Route::post('listCPMK', [APIController::class, 'listCPMK']);
  Route::post('addCPMK', [APIController::class, 'addCPMK']);
  Route::post('updateCPMK', [APIController::class, 'updateCPMK']);
  Route::post('removeCPMK', [APIController::class, 'removeCPMK']);
  
  Route::post('listCourse', [APIController::class, 'listCourse']);
  Route::post('addCourse', [APIController::class, 'addCourse']);
  Route::post('updateCourse', [APIController::class, 'updateCourse']);
  Route::post('removeCourse', [APIController::class, 'removeCourse']);

  Route::post('listRPS', [APIController::class, 'listRPS']);
  Route::post('addRPS', [APIController::class, 'addRPS']);
  Route::post('updateRPS', [APIController::class, 'updateRPS']);
  Route::post('removeRPS', [APIController::class, 'removeRPS']);

  Route::post('listBasisEvaluasi', [APIController::class, 'listBasisEvaluasi']);
  Route::post('addBasisEvaluasi', [APIController::class, 'addBasisEvaluasi']);
  Route::post('updateBasisEvaluasi', [APIController::class, 'updateBasisEvaluasi']);
  Route::post('removeBasisEvaluasi', [APIController::class, 'removeBasisEvaluasi']);
});
