<?php

namespace Tests\Feature;

use Tests\TestCase;

class APILoginMensagemTest extends TestCase
{
    /** @test */
    public function loginMensagemApiRoute()
    {
        $response = $this->postJson('/api/loginMensagem', [
            'email' => 'teste@gmail.com',
            'password'  => 'Teste#1234',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token',
            ]);
    }
}
