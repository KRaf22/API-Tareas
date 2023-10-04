<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tareas', [TareaController::class,'InsertarTarea']);
Route::get('/tareas', [TareaController::class,'ListarTareas']);
Route::get('/tareas/{idTarea}', [TareaController::class,'ListarUnaTarea']);
Route::put('/tareas/{idTarea}',[TareaController::class,'ModificarTarea']);
