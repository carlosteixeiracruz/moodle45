<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\Api\Mensagem\APILoginMensagemController;

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

// Em routes/web.php
Route::post('/login.moodle', [MoodleController::class, 'login'])->withoutMiddleware(['auth:sanctum']);

Route::post('/loginMensagem', [APILoginMensagemController::class, 'loginMensagemApiRoute']);

/*Route::get('/test', function () {
    return response()->json(['message' => 'Teste de rota bem-sucedido!']);
});*/


