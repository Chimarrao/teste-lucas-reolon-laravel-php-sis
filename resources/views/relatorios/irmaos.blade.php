@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório: Alunos Irmãos</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome do Pai</th>
                <th>Nome da Mãe</th>
                <th>Nome do Aluno</th>
                <th>Série</th>
                <th>Turma</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($relatorio as $nomePai => $alunosPorPai)
                @foreach ($alunosPorPai as $nomeMae => $alunosPorMae)
                    @foreach ($alunosPorMae as $aluno)
                        <tr>
                            <td>{{ $nomePai }}</td>
                            <td>{{ $nomeMae }}</td>
                            <td>{{ $aluno->nome_completo }}</td>
                            <td>{{ $aluno->serie }}</td>
                            <td>{{ $aluno->turma ? $aluno->turma->nome_turma : 'Não matriculado' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
