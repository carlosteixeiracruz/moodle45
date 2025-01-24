<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodleController; // Adicione esta linha para importar o controlador

// Rota para a página inicial (exemplo)
Route::get('/', function () {
    return view('welcome');
});

// Rota para a página de cadastro
Route::get('/cadastro', function () {
    return view('cadastro');
});

// Em routes/web.php
Route::post('/login', [MoodleController::class, 'login'])->name('login.moodle');

