<?php

namespace Tests\Feature;

use App\Models\Maturity;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class MaturityTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->usuario = User::factory()->create();
        $this->servico = Service::factory()->create();
        $this->token = JWTAuth::fromUser($this->usuario);
        $this->despesa = Maturity::factory()->create([
            'service_id' => $this->servico->id,
            'user_id' => $this->usuario->id,
            'status' => $this->faker->numberBetween(0, 1)
        ]);
        
        
        $this->baseUrl = 'api/maturity';
    }
    

  /**
   *  @test
   */
  public function listagemDeDespesasDoUsuario()
  {
    $response = $this->get($this->baseUrl . '?token=' . $this->token);
    $response->assertStatus(200);
  }
  
  /**
   * @test
   */
  public function criacaoDeDespesaPeloUsuario()
  {
      $response = $this->postJson($this->baseUrl . '?token=' . $this->token, [
          'service_id' => $this->servico->id,
          'user_id' => $this->usuario->id,
          'date_maturity' => $this->faker->date('Y-m-d'),
          'status' => $this->faker->numberBetween(0,1)
      ]);

      $response->assertStatus(200)
      ->assertJsonStructure([
          'service_id', 'user_id', 'date_maturity', 'status'
      ]);
  }

  /**
   *  @test
   */
  public function consultaDespesaDoUsuario()
  {
      $response = $this->get($this->baseUrl . '/'. $this->despesa->id  .'?token=' . $this->token);
    
      $response->assertStatus(200)
      ->assertJsonStructure([
          'id', 'service_id', 'user_id', 'date_maturity'
      ]);
  }

  /**
   * @test
   */
  public function atualizaDespesaDoUsuario()
  {
    $response = $this->put($this->baseUrl . '/'. $this->despesa->id  .'?token=' . $this->token, [
        'service_id' => $this->servico->id,
        'date_maturity' => $this->faker->date('Y-m-d'),
        'status' => $this->faker->numberBetween(0,1)   
    ]);

    $response->assertStatus(200);
    $this->assertEquals('Registro atualizado com sucesso.', $response->getData()->message);
  }

  /**
   * @test
   */
  public function exclusaoDeDespesaDoUsuario()
  {
      $response = $this->delete($this->baseUrl . '/' . $this->despesa->id . '?token=' . $this->token);

      $response->assertStatus(200);
      $this->assertEquals('Registro excluído com sucesso!', $response->getData()->message);
  }

  /**
   * @test
   */
  public function pesquisaDespesaDoUsuario()
  {
    $response = $this->get('api/search_maturity?status=' . $this->despesa->status . '&token=' . $this->token);
    
    $response->assertStatus(200);

  }
}
