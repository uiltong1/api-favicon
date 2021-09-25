<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $this->usuario = User::factory()->create([
            'email' => $this->faker()->unique()->safeEmail(),
            'name' => $this->faker()->name(),
            'password' => bcrypt('1234')
        ]);

        $this->baseUrl = 'api/auth/login';
    }

    /**
     * @test
     */
    public function loginComCredenciaisValidas()
    {
        $response = $this->postJson($this->baseUrl, ['email' => $this->usuario->email, 'password' => '1234']);
        $this->assertObjectNotHasAttribute('id', $response);
        $this->assertObjectNotHasAttribute('name', $response);
        $this->assertObjectNotHasAttribute('emal', $response);
        $response->assertStatus(200);
    }

    /**
     *  @test
    */
    public function loginComCredenciaisInvalidas()
    {
        $response = $this->postJson($this->baseUrl, ['email' => $this->usuario->email, 'password' => '123456']);
        $this->assertEquals("Email ou senha incorreto.", $response->getData()->message);
        $response->assertStatus(401);
    }
}
