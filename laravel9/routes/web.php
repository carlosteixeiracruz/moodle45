<?php

use Illuminate\Support\Facades\Route;
use App\Models\User; // Importa o modelo User

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Rota para a página de cadastro
Route::get('/cadastro', function () {
    return view('cadastro');
});

/*Rotas de Teste*/
Route::get('/generate-token', function () {
    $user = User::first(); // Carrega o primeiro usuário
    $token = $user->createToken('Token de Teste'); // Cria um token
    return response()->json(['token' => $token->plainTextToken]);
});

Route::get('/moodle-users', function () {
    $dados = DB::connection('moodle')->table('mdl_user')->get();
    return response()->json($dados);
});

