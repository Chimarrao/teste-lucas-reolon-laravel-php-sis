@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Lista de Alunos</h1>
            <a href="{{ route('alunos.create') }}" class="btn btn-primary">Cadastrar Novo Aluno</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Número da Matrícula</th>
                        <th>Nome Completo</th>
                        <th>Data de Nascimento</th>
                        <th>Série</th>
                        <th>Segmento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->id }}</td>
                            <td>{{ $aluno->nome_completo }}</td>
                            <td>{{ $aluno->data_nascimento }}</td>
                            <td>{{ $aluno->serie }}</td>
                            <td>{{ $aluno->segmento }}</td>
                            <td>
                                <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
