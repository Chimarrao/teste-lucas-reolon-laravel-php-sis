<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', compact('alunos'));
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'tipo_endereco' => 'required',
            'endereco' => 'required|string|max:255',
            'cep' => 'required|string|max:8',
            'numero' => 'required|string|max:10',
            'serie' => 'required|string',
            'nome_pai' => 'required|string|max:255',
            'nome_mae' => 'required|string|max:255',
        ]);

        Aluno::create($request->all());

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_completo' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'tipo_endereco' => 'required',
            'endereco' => 'required|string|max:255',
            'cep' => 'required|string|max:8',
            'numero' => 'required|string|max:10',
            'serie' => 'required|string',
            'nome_pai' => 'required|string|max:255',
            'nome_mae' => 'required|string|max:255',
        ]);

        $aluno = Aluno::findOrFail($id);
        $aluno->update($request->all());

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id); 
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
    }
}
