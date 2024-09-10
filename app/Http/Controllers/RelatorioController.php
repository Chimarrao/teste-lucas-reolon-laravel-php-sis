<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function alunosPorSerieSegmento()
    {
        $relatorio = Aluno::select('serie', 'segmento', DB::raw('count(*) as total'))
            ->groupBy('serie', 'segmento')
            ->get();

        return view('relatorios.alunos_por_serie_segmento', compact('relatorio'));
    }

    public function alunosPorTurma()
    {
        $relatorio = Turma::withCount('matriculas')->get();

        return view('relatorios.alunos_por_turma', compact('relatorio'));
    }

    public function relatorioIrmaos()
    {
        $relatorio = Aluno::select('nome_pai', 'nome_mae', 'nome_completo', 'serie', 'turma_id')
            ->with('turma') 
            ->get()
            ->groupBy(['nome_pai', 'nome_mae']);

        return view('relatorios.irmaos', compact('relatorio'));
    }
}
