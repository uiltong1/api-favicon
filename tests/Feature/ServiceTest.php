<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ServiceTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->usuario = User::factory()->create();
        $this->token = JWTAuth::fromUser($this->usuario);
        $this->servico = Service::factory()->create([
                            'name' => $this->faker->title(),
                            'ds_service' => $this->faker->text(),
                            'status' => $this->faker->numberBetween(0, 1),
                            'periodic' => $this->faker->numberBetween(0, 1),
                            'date_init' => $this->faker->date('Y-m-d'),
                            'value' => $this->faker->numberBetween(0, 100),
                            'user_id' => $this->usuario->id,
                            'reminder' => $this->faker->numberBetween(0, 1)
                        ]);

        $this->baseUrl = 'api/services';
    }

    /**
     * @test
     */
    public function listagemDeServicosDoUsuario()
    {
        $response = $this->get($this->baseUrl . '?token=' . $this->token);
        $response->assertStatus(200);
    }
    
    /**
     * @test
     */
    public function criacaoDeServicoPeloUsuario()
    {
        $response = $this->postJson($this->baseUrl . '?token=' . $this->token, [
            'name' => $this->faker->title(),
            'ds_service' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 1),
            'periodic' => $this->faker->numberBetween(0, 1),
            'date_init' => $this->faker->date('Y-m-d'),
            'value' => $this->faker->numberBetween(0, 100),
            'user_id' => $this->usuario->id,
            'reminder' => $this->faker->numberBetween(0, 1)
        ]);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'name', 'ds_service', 'status', 'periodic', 'date_init', 'value', 'user_id', 'reminder'
        ]);
    }

    /**
     * @test
     */
    public function consultarServicoDoUsuario()
    {
        $response = $this->get($this->baseUrl . '/' . $this->servico->id .'?token=' . $this->token);
        
        $response->assertStatus(200)
        ->assertJsonStructure([
            'name', 'ds_service', 'status', 'periodic', 'date_init', 'value', 'user_id', 'reminder'
        ]);
    }

    /**
     * @test
    */
    public function atualizacaoDoServicoDoUsuario()
    {
        $response = $this->put($this->baseUrl . '/' . $this->servico->id .'?token=' . $this->token, [
            'name' => $this->faker->title(),
            'ds_service' => $this->faker->text(),
            'status' => $this->faker->numberBetween(0, 1),
            'periodic' => $this->faker->numberBetween(0, 1),
            'date_init' => $this->faker->date('Y-m-d'),
            'value' => $this->faker->numberBetween(0, 100),
            'user_id' => $this->usuario->id,
            'reminder' => $this->faker->numberBetween(0, 1)
        ]);

        $response->assertStatus(200)->assertOk();
    }

    /**
     * @test
     */
    public function exclusaoDeServicoDoUsuario()
    {
        $response = $this->delete($this->baseUrl . '/' . $this->servico->id .'?token=' . $this->token);
        
        $this->assertEquals('Serviço excluído com sucesso!', $response->getData()->message);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'success', 'message'
        ]);
    }
}
