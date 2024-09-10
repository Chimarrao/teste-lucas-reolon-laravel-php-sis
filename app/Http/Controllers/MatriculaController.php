<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $series = ['G1', 'G2', 'G3', '1º', '2º', '3º', '4º', '5º', '6º', '7º', '8º', '9º', '1ºEM', '2ºEM', '3ºEM'];
        $turmas = Turma::all();
        return view('matriculas.index', compact('series', 'turmas'));
    }

    public function getAlunosPorSerie($serie)
    {
        // Carregar alunos que ainda não estão matriculados
        $alunosSemTurma = Aluno::where('serie', $serie)->whereNull('turma_id')->get();

        // Carregar alunos já matriculados na série com suas turmas
        $alunosComTurma = Aluno::where('serie', $serie)->whereNotNull('turma_id')->with('turma')->get();

        // Carregar todas as turmas associadas à série
        $turmas = Turma::where('serie', $serie)->get();

        if ($turmas->isEmpty()) {
            return response()->json(['error' => 'Nenhuma turma encontrada para esta série'], 404);
        }

        return response()->json([
            'alunosSemTurma' => $alunosSemTurma,
            'alunosComTurma' => $alunosComTurma,
            'turmas' => $turmas
        ]);
    }

    public function matricularAluno(Request $request)
    {
        $turma = Turma::find($request->turma_id);
        $aluno = Aluno::find($request->aluno_id);

        if (!$turma || !$aluno) {
            return response()->json(['error' => 'Turma ou aluno não encontrados.'], 404);
        }

        // Verifica se há vagas disponíveis na turma
        if ($turma->alunos()->count() >= $turma->quantidade_vagas) {
            return response()->json(['error' => 'Não há vagas disponíveis nesta turma.'], 400);
        }

        // Matricula o aluno na turma
        $aluno->turma_id = $turma->id;
        $aluno->save();

        return response()->json(['success' => 'Aluno matriculado com sucesso']);
    }
}
