<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TypeProjectController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Api routes
Route::apiResource('projects', ProjectController::class)->only('index', 'show');

// Api show route
Route::get('projects/{slug}', [ProjectController::class, 'show']);

// Api type projects route
Route::get('types/{slug}/projects', TypeProjectController::class);
