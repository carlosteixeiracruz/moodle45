<?php

namespace App\Http\Controllers\Api\Mensagem;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Routing\Controller;


class APILoginMensagemController extends Controller
{
     /**
    * Função para realizar o login do usuário utilizando as credenciais fornecidas, 
    * autenticando através do banco de dados do MOODLE e criando/atualizando o usuário no banco de dados do Laravel.
    * O token gerado é associado ao usuário no Laravel, mantendo-o logado enquanto o IP de acesso não mudar.
    * Caso o login seja bem-sucedido, o token será retornado, e um log de "LOGIN" será registrado.
    *
    * Parâmetros:
    * - Request $request: Objeto contendo as credenciais do usuário (email e senha).
    *     - 'email': O e-mail fornecido pelo usuário para autenticação.
    *     - 'password': A senha fornecida pelo usuário para autenticação.
    *
    * Fluxo:
    * 1. Recupera as credenciais do request e o IP de acesso do usuário.
    * 2. Consulta o banco de dados Moodle para verificar se o usuário existe.
    * 3. Verifica se as credenciais fornecidas (email e senha) são válidas no banco do Moodle.
    * 4. Cria ou atualiza o usuário na tabela `users` do Laravel com as informações do Moodle.
    * 5. Gera um token de autenticação (API token) e o armazena no banco de dados do Laravel.
    * 6. Atualiza o campo `remember_token` do usuário no Laravel com o token gerado.
    * 7. Chama a função `insertLog` para registrar um log de "LOGIN" com o IP de acesso.
    *
    * Retorno:
    * - Se o login for bem-sucedido:
    *   - Retorna um JSON com a mensagem de sucesso, o token gerado e o resultado do log.
    * - Se algo der errado:
    *   - Retorna um erro 500 com a mensagem 'Algo deu errado (Ao efetuar o "LOGIN")'.
    */
    public function loginMensagemApiRoute(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $ip = $request->ip(); 

             /*Efetua a consulta na tabela user no banco do moodle*/
            $user = selectUser('email', $credentials['email']);

            if (!$user) {
                return response()->json(['error' => 'Usuário não encontrado no Moodle'], 404);
            }

            if (!password_verify($credentials['password'], $user->password)) {
                return response()->json(['error' => 'Credenciais inválidas no Moodle'], 401);
            }

            $laravelUser = User::updateOrCreate(
                ['email' => $user->email],
                [
                    'name' => $user->firstname . ' ' . $user->lastname,
                    'password' => bcrypt($credentials['password']),
                    'updated_at' => now(),
                ]
            );

            /*Gerar o token no banco do Laravel na tabela ACESS_TOKEN*/
            $token = $laravelUser->createToken('API login')->plainTextToken;

            /*Atualizar o campo remember_token na tabela USER do laravel com o mesmo token gerado*/
            $laravelUser->update([
                'remember_token' => $token,
            ]);

            /*Chamar a função e passar os parâmetros necessários Para criar o log de "LOGIN"*/
            $parametro = "login";
            $resultado = insertLog($laravelUser, $parametro, $ip);

            return response()->json([
                'message' => 'Login bem-sucedido',
                'token' => $token,
                'resultado' => $resultado
            ]);
        } catch (\Exception $e) {
            // Retorna um erro 500 se algo der errado
            return response()->json(['error' => 'Algo deu errado (Ao efetuar o "LOGIN")'], 500);
        }
    }
}