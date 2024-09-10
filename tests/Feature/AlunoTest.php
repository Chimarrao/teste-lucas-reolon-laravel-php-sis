<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Aluno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlunoTest extends TestCase
{
    use RefreshDatabase;

    // Teste de autenticação - bloqueio sem login
    public function test_redirection_without_authentication()
    {
        $response = $this->get('/alunos');
        $response->assertRedirect('/dashboard');
    }

    // Teste de listagem de alunos com usuário autenticado (Secretaria)
    public function test_list_alunos_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);
        
        $response = $this->get('/alunos');
        $response->assertStatus(200);
        $response->assertSee('Alunos');
    }

    // Teste de criação de aluno (Secretaria)
    public function test_create_aluno_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);
        
        $response = $this->post('/alunos', [
            'nome_completo' => 'Teste Aluno',
            'data_nascimento' => '2010-01-01',
            'tipo_endereco' => 'Residencial',
            'endereco' => 'Rua X, 123',
            'cep' => '12345000',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'serie' => '6º',
            'segmento' => 'Anos Finais',
            'nome_pai' => 'Pai Teste',
            'nome_mae' => 'Mãe Teste',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('alunos', ['nome_completo' => 'Teste Aluno']);
    }

    // Teste de edição de aluno (Secretaria)
    public function test_edit_aluno_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $aluno = Aluno::factory()->create();
        $response = $this->put("/alunos/{$aluno->id}", [
            'nome_completo' => 'Aluno Editado',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('alunos', ['nome_completo' => $aluno['nome_completo']]);
    }

    // Teste de exclusão de aluno (Secretaria)
    public function test_delete_aluno_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $aluno = Aluno::factory()->create();
        $response = $this->delete("/alunos/{$aluno->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('alunos', ['id' => $aluno->id]);
    }

    // Teste de criação de aluno como assistente (permitido)
    public function test_create_aluno_as_assistente()
    {
        $user = User::factory()->create(['role' => 'assistente']);
        $this->actingAs($user);

        $response = $this->post('/alunos', [
            'nome_completo' => 'Teste Aluno Assistente',
            'data_nascimento' => '2012-05-05',
            'tipo_endereco' => 'Residencial',
            'endereco' => 'Rua X, 123',
            'cep' => '12345000',
            'numero' => '123',
            'complemento' => 'Apto 1',
            'serie' => '6º',
            'segmento' => 'Anos Finais',
            'nome_pai' => 'Pai Teste',
            'nome_mae' => 'Mãe Teste',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('alunos', ['nome_completo' => 'Teste Aluno Assistente']);
    }
}
