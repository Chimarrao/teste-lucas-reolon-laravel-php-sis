<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::all();
        return view('turmas.index', compact('turmas'));
    }

   
    public function create()
    {
        return view('turmas.create');
    }

   
    public function store(Request $request)
    {
       
        $request->validate([
            'nome_turma' => 'required|string|max:255',
            'turno' => 'required|in:Manhã,Tarde,Integral',
            'quantidade_vagas' => 'required|integer|min:1',
            'ano_letivo' => 'required|integer',
            'serie' => 'required|string',
        ]);

       
        Turma::create($request->all());

        return redirect()->route('turmas.index')->with('success', 'Turma cadastrada com sucesso!');
    }

   
    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        return view('turmas.edit', compact('turma'));
    }

   
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'nome_turma' => 'required|string|max:255',
            'turno' => 'required|in:Manhã,Tarde,Integral',
            'quantidade_vagas' => 'required|integer|min:1',
            'ano_letivo' => 'required|integer',
            'serie' => 'required|string',
        ]);

       
        $turma = Turma::findOrFail($id);
        $turma->update($request->all());

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

   
    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();

        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
}
