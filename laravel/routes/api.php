<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodleController;

#Route::post('/login', [MoodleController::class, 'login']);


// Rota protegida
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
