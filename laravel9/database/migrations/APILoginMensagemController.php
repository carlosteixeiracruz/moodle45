<?php

namespace App\Http\Controllers\Api\Mensagem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class APILoginMensagemController extends Controller
{
    public function loginMensagemApiRoute(Request $request)
    {
        // Validação das credenciais
        $credentials = $request->only('email', 'password');

        // Buscar o usuário no banco de dados Moodle
        $user = DB::connection('moodle')->table('ujki_user')
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
        $laravelUser = User::updateOrCreate(
            ['email' => $user->email], // Condição de busca
            [
                'name' => $user->firstname . ' ' . $user->lastname,
                'password' => bcrypt($credentials['password']),
                'updated_at' => now(),
            ]
        );

        // Gerar o token no banco do Laravel
        $token = $laravelUser->createToken('API login')->plainTextToken;

        // Atualizar o campo remember_token com o mesmo token gerado
        $laravelUser->update([
            'remember_token' => $token,
        ]);

        $parametro = "Laravel";
        $resultado = minhaFuncao($parametro);

        // Retorna o token junto com uma mensagem de sucesso
        return response()->json([
            'message'       => 'Login bem-sucedido AA',
            'token'         => $token,
            'resultado'    => $resultado
        ]);

        
    }
}
