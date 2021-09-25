<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use DatabaseTransactions;
    use WithFaker;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->usuario = User::factory()->create();
        $this->baseUrl = 'api/auth/create';
    }

    /**
     * @test
     */
    public function criacaoDeNovoUsuario()
    {
        $response = $this->postJson($this->baseUrl, [
            'name' => $this->faker()->name(),
            'email' => $this->faker()->email(),
            'password' => $this->faker()->regexify('[A-Z]{5}[a-z]{5}[0-4]{5}[@-%]{2}')
        ]);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'name', 'email', 'updated_at', 'created_at'
        ]);
    }

    /**
     * @test
     */
    public function tentativaDeCriacaoDeNovoUsuarioComSenhaForaDoPadrao()
    {
        $response = $this->postJson($this->baseUrl, [
            'name' => $this->faker()->name(),
            'email' => $this->faker()->email(),
            'password' => $this->faker()->title()
        ]);
        $response->assertStatus(422);
        $this->assertEquals('A senha deve conter no mínimo oito caracteres, pelo menos, uma letra maiúscula, uma letra minúscula, um número e um caractere especial', $response->getData()->errors->password[0]);
    }

    /**
     * @test
     */
    public function tentativaDeCriacaoDeUsuarioComEmailExistente()
    {
        $response = $this->postJson($this->baseUrl, $this->usuario->toArray());
        $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => [
                'email'
            ]
        ]);
    } 
}
