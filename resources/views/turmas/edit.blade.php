@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Editar Turma</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('turmas.update', $turma->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome_turma" class="form-label">Nome da Turma</label>
                    <input type="text" name="nome_turma" class="form-control" id="nome_turma" value="{{ $turma->nome_turma }}">
                </div>

                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select name="turno" id="turno" class="form-select">
                        <option value="Manhã" {{ $turma->turno == 'Manhã' ? 'selected' : '' }}>Manhã</option>
                        <option value="Tarde" {{ $turma->turno == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                        <option value="Integral" {{ $turma->turno == 'Integral' ? 'selected' : '' }}>Integral</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantidade_vagas" class="form-label">Quantidade de Vagas</label>
                    <input type="number" name="quantidade_vagas" class="form-control" id="quantidade_vagas" value="{{ $turma->quantidade_vagas }}">
                </div>

                <div class="mb-3">
                    <label for="ano_letivo" class="form-label">Ano Letivo</label>
                    <input type="number" name="ano_letivo" class="form-control" id="ano_letivo" value="{{ $turma->ano_letivo }}">
                </div>

                <!-- Campo Série como select -->
                <div class="mb-3">
                    <label for="serie" class="form-label">Série</label>
                    <select name="serie" id="serie" class="form-select">
                        <option value="G1" {{ $turma->serie == 'G1' ? 'selected' : '' }}>G1 (3 anos)</option>
                        <option value="G2" {{ $turma->serie == 'G2' ? 'selected' : '' }}>G2 (4 anos)</option>
                        <option value="G3" {{ $turma->serie == 'G3' ? 'selected' : '' }}>G3 (5 anos)</option>
                        <option value="1º" {{ $turma->serie == '1º' ? 'selected' : '' }}>1º ano (6 anos)</option>
                        <option value="2º" {{ $turma->serie == '2º' ? 'selected' : '' }}>2º ano (7 anos)</option>
                        <option value="3º" {{ $turma->serie == '3º' ? 'selected' : '' }}>3º ano (8 anos)</option>
                        <option value="4º" {{ $turma->serie == '4º' ? 'selected' : '' }}>4º ano (9 anos)</option>
                        <option value="5º" {{ $turma->serie == '5º' ? 'selected' : '' }}>5º ano (10 anos)</option>
                        <option value="6º" {{ $turma->serie == '6º' ? 'selected' : '' }}>6º ano (11 anos)</option>
                        <option value="7º" {{ $turma->serie == '7º' ? 'selected' : '' }}>7º ano (12 anos)</option>
                        <option value="8º" {{ $turma->serie == '8º' ? 'selected' : '' }}>8º ano (13 anos)</option>
                        <option value="9º" {{ $turma->serie == '9º' ? 'selected' : '' }}>9º ano (14 anos)</option>
                        <option value="1ºEM" {{ $turma->serie == '1ºEM' ? 'selected' : '' }}>1º ano Ensino Médio (15 anos)</option>
                        <option value="2ºEM" {{ $turma->serie == '2ºEM' ? 'selected' : '' }}>2º ano Ensino Médio (16 anos)</option>
                        <option value="3ºEM" {{ $turma->serie == '3ºEM' ? 'selected' : '' }}>3º ano Ensino Médio (17 anos)</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Turma</button>
            </form>
        </div>
    </div>
</div>
@endsection
