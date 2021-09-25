<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use DatabaseTransactions;
    use WithFaker;

    private $user;
    private $baseUrl;

    public function setUp(): void
    {
        parent::setUp();
        $this->usuario = User::factory()->create();
        $this->token = JWTAuth::fromUser($this->usuario);
        $this->baseUrl = 'api/auth';
    }

    /**
     * @test
     */
    public function loginComCredenciaisValidas()
    {
        $response = $this->postJson($this->baseUrl .'/login', ['email' => $this->usuario->email, 'password' => '1234']);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'token', 'expires_in',
            'user' => [
                'original' => [
                    'name', 'email'
                ]
            ]
        ]);
    }

    /**
     *  @test
    */
    public function loginComCredenciaisInvalidas()
    {
        $response = $this->postJson($this->baseUrl .'/login', ['email' => $this->usuario->email, 'password' => '123456']);
        $this->assertEquals("Email ou senha incorreto.", $response->getData()->message);
        $response->assertStatus(401);
    }

    /**
     *  @test
    */
    public function tentativaDeLoginComUsuarioQueNaoExiste()
    {
        $response = $this->postJson($this->baseUrl .'/login', ['email' => $this->faker()->unique()->safeEmail(), 'password' => $this->faker()->title()]);
        $this->assertEquals("Email ou senha incorreto.", $response->getData()->message);
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function retornaDadosDoUsuario()
    {   
        $response = $this->get($this->baseUrl . '/me?token=' . $this->token, ['']);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'id', 'name', 'email', 'email_verified_at'
        ]);
    }

    /**
     *  @test
     */
    public function renovaTokenDoUsuarioAutenticado()
    {
        $response = $this->postJson($this->baseUrl . '/refresh?token='. $this->token, []);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'token', 'expires_in'
        ]);
    }
}
