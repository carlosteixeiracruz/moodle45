<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MoodleUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class MoodleController extends Controller
{
    /*public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Buscar o usuário no banco de dados Moodle
        $user = DB::connection('moodle')->table('mdl_user')
            ->where('email', $credentials['email'])
            ->first();
    
        // Verificar se o usuário existe
        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }
    
        // Verificar a senha
        if (!password_verify($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
    
        // Acessa a chave secreta do .env
        $key = env('JWT_SECRET');
    
        // Cria o payload do token (informações que vão dentro do token)
        $payload = [
            'iss' => 'your-issuer',       // Emissor do token
            'sub' => $user->id,           // ID do usuário
            'email' => $user->email,      // E-mail do usuário
            'iat' => time(),              // Hora de emissão do token
            'exp' => time() + 3600        // Tempo de expiração (1 hora)
        ];
    
        // Gerar o token JWT com o algoritmo HS256
        $token = JWT::encode($payload, $key, 'HS256');  // Aqui passamos o algoritmo 'HS256'
    
        // Retornar o token gerado como resposta
        return response()->json(['token' => $token], 200);
    }*/

    public function login(Request $request)
{
    // Validação das credenciais
    $credentials = $request->only('email', 'password');

    // Buscar o usuário no banco de dados Moodle
    $user = DB::connection('moodle')->table('mdl_user')
        ->where('email', $credentials['email'])
        ->first();

    // Verificar se o usuário existe no Moodle
    if (!$user) {
        return response()->json(['error' => 'Usuário não encontrado no Moodle'], 404);
    }

    // Verificar a senha no Moodle
    if (!password_verify($credentials['password'], $user->password)) {
        return response()->json(['error' => 'Credenciais inválidas no Moodle'], 401);
    }

    // Verificar ou criar o usuário no banco do Laravel
    $laravelUser = \App\Models\User::updateOrCreate(
        ['email' => $user->email], // Condição de busca
        [
            'name' => $user->firstname . ' ' . $user->lastname,
            'password' => bcrypt($credentials['password']), // Atualiza a senha com hash Laravel
        ]
    );

    // Gerar o token no banco do Laravel
    $token = $laravelUser->createToken('Token de Acesso')->plainTextToken;

    // Retorna o token junto com uma mensagem de sucesso
    return response()->json([
        'message' => 'Login bem-sucedido',
        'token' => $token,
    ]);
}

}
