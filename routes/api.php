<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ScoreController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ClassroomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('classrooms', [ClassroomController::class, 'index']);
Route::post('classrooms', [ClassroomController::class, 'store']);
Route::get('classrooms/{id}', [ClassroomController::class, 'show']);
Route::post('classrooms/{id}', [ClassroomController::class, 'update']);

Route::get('students', [StudentController::class, 'index']);
Route::get('students/{id}', [StudentController::class, 'show']);

Route::post('scores', [ScoreController::class, 'store']);
Route::get('scores/{id}', [ScoreController::class, 'show']);

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
