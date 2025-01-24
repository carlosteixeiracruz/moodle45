<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testLogin()
    {
        // Criação de um usuário de teste
        $user = User::factory()->create([
            'email' => 'usuario@exemplo.com',
            'password' => Hash::make('minhasenha'),
        ]);

        // Gere a URL usando a função route() para garantir que a URL está correta
        $url = route('login.moodle'); // Isso vai gerar a URL da rota com nome 'login.moodle'

        // Realiza a requisição para a URL gerada
        $response = $this->postJson($url, [
            'email' => 'usuario@exemplo.com',
            'password' => 'minhasenha',
        ]);

        // Verifica se o status da resposta foi 200
        $response->assertStatus(200);
    }
}
