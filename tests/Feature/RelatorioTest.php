<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelatorioTest extends TestCase
{
    use RefreshDatabase;

    // 1. Teste de bloqueio sem autenticação
    public function test_redirect_without_authentication()
    {
        $response = $this->get('/relatorios/alunos-por-serie-segmento');
        $response->assertRedirect('/dashboard');
    }

    // 2. Teste de acesso ao relatório de alunos por série (Secretaria)
    public function test_access_relatorio_alunos_por_serie_segmento_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $response = $this->get('/relatorios/alunos-por-serie-segmento');
        $response->assertStatus(200);
        $response->assertSee('Relatório Alunos por Série/Segmento');
    }

    // 4. Teste de acesso ao relatório de alunos por turma (Secretaria)
    public function test_access_relatorio_alunos_por_turma_as_secretaria()
    {
        $user = User::factory()->create(['role' => 'secretaria']);
        $this->actingAs($user);

        $response = $this->get('/relatorios/alunos-por-turma');
        $response->assertStatus(200);
        $response->assertSee('Relatório Alunos por Turma');
    }

    // 5. Teste de acesso ao relatório de alunos por série como assistente
    public function test_access_relatorio_alunos_por_serie_segmento_as_assistente()
    {
        $user = User::factory()->create(['role' => 'assistente']);
        $this->actingAs($user);

        $response = $this->get('/relatorios/alunos-por-serie-segmento');
        $response->assertStatus(200);
        $response->assertSee('Relatório Alunos por Série/Segmento');
    }

    // 7. Teste de acesso negado para cadastro em relatório de alunos por turma
    public function test_cadastro_cannot_access_relatorio_alunos_por_turma()
    {
        $user = User::factory()->create(['role' => 'cadastro']);
        $this->actingAs($user);

        $response = $this->get('/relatorios/alunos-por-turma');
        $response->assertRedirect('/dashboard');
    }

    // 8. Teste de bloqueio sem permissão
    public function test_redirect_without_permission()
    {
        $user = User::factory()->create(['role' => 'cadastro']);
        $this->actingAs($user);

        $response = $this->get('/relatorios/irmaos');
        $response->assertRedirect('/dashboard');
    }
}
