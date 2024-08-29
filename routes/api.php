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
});
