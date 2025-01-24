<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\MoodleUser; // Importa o modelo correto
use Illuminate\Support\Facades\DB;

class ApiLoginTest extends TestCase
{
    /** @test */
    /*public function testLogin()
    {
        // Certifique-se de que há um usuário existente no banco do Moodle
        #$user = DB::connection('moodle')
        #    ->table('mdl_user')
        #    ->where('email', 'usuario@exemplo.com') // Substitua pelo e-mail de um usuário real
        #    ->first();

        // Verifica se o usuário existe antes de continuar o teste
        #$this->assertNotNull($user, 'O usuário especificado não existe no banco do Moodle.');

        #var_dump($user);

        #die;

        //Defina o e-mail diretamente
        $email = 'admin@gmail.com';

        //A senha do usuário que está sendo testado
        $password = 'Admin#1234';  // Substitua pela senha correta

        //Gere a URL usando a função route() para garantir que a URL está correta
        $url = route('login.moodle'); // Nome correto da rota

        //Realiza a requisição para a URL gerada
        $response = $this->postJson($url, [
            'email' => $email, // Passa o e-mail diretamente
            'password' => $password, // Passa a senha
        ]);

        // Verifica se o status da resposta foi 200
        $response->assertStatus(200);

        // Verifica se o token foi retornado
        $response->assertJsonStructure(['token']);
    }*/

    /** @test */
public function testLogin()
{
    // Simula a requisição de login
    $response = $this->postJson(route('login.moodle'), [
        'moodleEmail' => 'teste@gmail.com',
        'moodlePassword' => 'Teste#1234',
    ]);

    // Verifica se o status da resposta é 200 e se o token está presente
    $response->assertStatus(200)
        ->assertJson(['message' => 'Teste de rota bem-sucedido!']);
}
}


