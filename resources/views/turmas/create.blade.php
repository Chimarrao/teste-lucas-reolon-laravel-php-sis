@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Cadastrar Nova Turma</h1>
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

            <form action="{{ route('turmas.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nome_turma" class="form-label">Nome da Turma</label>
                    <input type="text" name="nome_turma" class="form-control" id="nome_turma" value="{{ old('nome_turma') }}">
                </div>

                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select name="turno" id="turno" class="form-select">
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Integral">Integral</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantidade_vagas" class="form-label">Quantidade de Vagas</label>
                    <input type="number" name="quantidade_vagas" class="form-control" id="quantidade_vagas" value="{{ old('quantidade_vagas') }}">
                </div>

                <div class="mb-3">
                    <label for="ano_letivo" class="form-label">Ano Letivo</label>
                    <input type="number" name="ano_letivo" class="form-control" id="ano_letivo" value="{{ old('ano_letivo') }}">
                </div>

                <div class="mb-3">
                    <label for="serie" class="form-label">Série</label>
                    <select name="serie" id="serie" class="form-select">
                        <option value="">Selecione a Série</option>
                        <option value="G1">G1 (3 anos)</option>
                        <option value="G2">G2 (4 anos)</option>
                        <option value="G3">G3 (5 anos)</option>
                        <option value="1º">1º ano (6 anos)</option>
                        <option value="2º">2º ano (7 anos)</option>
                        <option value="3º">3º ano (8 anos)</option>
                        <option value="4º">4º ano (9 anos)</option>
                        <option value="5º">5º ano (10 anos)</option>
                        <option value="6º">6º ano (11 anos)</option>
                        <option value="7º">7º ano (12 anos)</option>
                        <option value="8º">8º ano (13 anos)</option>
                        <option value="9º">9º ano (14 anos)</option>
                        <option value="1ºEM">1º ano Ensino Médio (15 anos)</option>
                        <option value="2ºEM">2º ano Ensino Médio (16 anos)</option>
                        <option value="3ºEM">3º ano Ensino Médio (17 anos)</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar Turma</button>
            </form>
        </div>
    </div>
</div>
@endsection
