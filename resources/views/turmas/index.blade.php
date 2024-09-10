@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Lista de Turmas</h1>
            <a href="{{ route('turmas.create') }}" class="btn btn-primary">Cadastrar Nova Turma</a>
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
                        <th>Nome da Turma</th>
                        <th>Turno</th>
                        <th>Quantidade de Vagas</th>
                        <th>Ano Letivo</th>
                        <th>Série</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmas as $turma)
                        <tr>
                            <td>{{ $turma->nome_turma }}</td>
                            <td>{{ $turma->turno }}</td>
                            <td>{{ $turma->quantidade_vagas }}</td>
                            <td>{{ $turma->ano_letivo }}</td>
                            <td>{{ $turma->serie }}</td>
                            <td>
                                <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta turma?')">Excluir</button>
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
