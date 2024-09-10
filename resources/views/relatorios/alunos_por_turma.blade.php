@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório: Alunos por Turma</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome da Turma</th>
                <th>Série</th>
                <th>Turno</th>
                <th>Total de Alunos Matriculados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($relatorio as $turma)
                <tr>
                    <td>{{ $turma->nome_turma }}</td>
                    <td>{{ $turma->serie }}</td>
                    <td>{{ $turma->turno }}</td>
                    <td>{{ $turma->matriculas_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
