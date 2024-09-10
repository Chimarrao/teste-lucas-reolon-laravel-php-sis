<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Middleware\SecretariaMiddleware;
use App\Http\Middleware\AssistenteMiddleware;
use App\Http\Middleware\CadastroMiddleware;

require __DIR__ . '/auth.php';

// Redireciona a rota raiz para a listagem de alunos
Route::redirect('/', '/dashboard');

// Rotas acessíveis apenas pela Secretaria
Route::middleware([SecretariaMiddleware::class])->group(function () {
    Route::resource('alunos', AlunoController::class);
    Route::resource('turmas', TurmaController::class);
    Route::get('/relatorios/alunos-por-serie-segmento', [RelatorioController::class, 'alunosPorSerieSegmento'])->name('relatorios.alunosPorSerieSegmento');
    Route::get('/relatorios/alunos-por-turma', [RelatorioController::class, 'alunosPorTurma'])->name('relatorios.alunosPorTurma');
    Route::get('/relatorios/irmaos', [RelatorioController::class, 'relatorioIrmaos'])->name('relatorios.irmaos');
    
    // Rotas para matrícula (disponíveis para qualquer perfil com acesso)
    Route::get('/matriculas', [MatriculaController::class, 'index'])->name('matriculas.index');
    Route::get('/matriculas/alunos/{serie}', [MatriculaController::class, 'getAlunosPorSerie']);
    Route::post('/matricular-aluno', [MatriculaController::class, 'matricularAluno']);
});

// Rotas acessíveis pelo Assistente
Route::middleware([AssistenteMiddleware::class])->group(function () {
    Route::resource('alunos', AlunoController::class)->only(['index', 'create', 'store']);
    Route::resource('turmas', TurmaController::class)->only(['index', 'create', 'store']);
    Route::get('/relatorios/alunos-por-serie-segmento', [RelatorioController::class, 'alunosPorSerieSegmento'])->name('relatorios.alunosPorSerieSegmento');
    Route::get('/relatorios/alunos-por-turma', [RelatorioController::class, 'alunosPorTurma'])->name('relatorios.alunosPorTurma');
    Route::get('/relatorios/irmaos', [RelatorioController::class, 'relatorioIrmaos'])->name('relatorios.irmaos');
});

// Rotas acessíveis pelo Cadastro
Route::middleware([CadastroMiddleware::class])->group(function () {
    Route::resource('alunos', AlunoController::class)->only(['index', 'create', 'store']);
});

Route::get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');
