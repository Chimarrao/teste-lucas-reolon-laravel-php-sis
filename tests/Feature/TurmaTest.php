<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Turma;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TurmaTest extends TestCase
{
    use RefreshDatabase;

    // 1. Teste de autenticação - bloqueio sem login
    public function test_redirect_without_authentication()
    {
        $response = $this->get('/turmas');
        $response->assertRedirect('/dashboard');
    }

    // 2. Teste de listagem de turmas como secretaria
    public function test_list_turmas_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $response = $this->get('/turmas');
        $response->assertStatus(200);
        $response->assertSee('Turmas');
    }

    // 3. Teste de criação de turma como secretaria
    public function test_create_turma_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $response = $this->post('/turmas', [
            'nome_turma' => 'Turma X',
            'turno' => 'Manhã',
            'quantidade_vagas' => 30,
            'ano_letivo' => 2024,
            'serie' => '5º',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('turmas', ['nome_turma' => 'Turma X']);
    }

    // 4. Teste de edição de turma como secretaria
    public function test_edit_turma_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $turma = Turma::factory()->create(['nome_turma' => 'Turma Y']);
        $response = $this->put("/turmas/{$turma->id}", [
            'nome_turma' => 'Turma Z',
            'turno' => 'Tarde',
            'quantidade_vagas' => 12,
            'ano_letivo' => 2024,
            'serie' => 'G1'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('turmas', ['nome_turma' => 'Turma Z']);
    }

    // 5. Teste de exclusão de turma como secretaria
    public function test_delete_turma_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $turma = Turma::factory()->create();
        $response = $this->delete("/turmas/{$turma->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('turmas', ['id' => $turma->id]);
    }

    // 6. Teste de bloqueio de exclusão para assistente
    public function test_assistente_cannot_delete_turma()
    {
        $user = User::factory()->create(['role' => 'assistente']);
        $this->actingAs($user);

        $turma = Turma::factory()->create();
        $response = $this->delete("/turmas/{$turma->id}");
        $response->assertRedirect('/dashboard');
    }

    // 7. Teste de criação de turma como assistente
    public function test_create_turma_as_assistente()
    {
        $user = User::factory()->create(['role' => 'assistente']);
        $this->actingAs($user);

        $response = $this->post('/turmas', [
            'nome_turma' => 'Turma Assistente',
            'turno' => 'Tarde',
            'quantidade_vagas' => 25,
            'ano_letivo' => 2024,
            'serie' => '6º',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('turmas', ['nome_turma' => 'Turma Assistente']);
    }

    // 8. Teste de bloqueio de acesso para cadastro
    public function test_cadastro_cannot_access_turmas()
    {
        $user = User::factory()->create(['role' => 'cadastro']);
        $this->actingAs($user);

        $response = $this->get('/turmas');
        $response->assertRedirect('/dashboard');
    }
}
