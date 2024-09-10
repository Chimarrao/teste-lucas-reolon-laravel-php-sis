@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Editar Aluno</h1>
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

            <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nome_completo" class="form-label">Nome Completo</label>
                    <input type="text" name="nome_completo" class="form-control" id="nome_completo" value="{{ $aluno->nome_completo }}">
                </div>

                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control" id="data_nascimento" value="{{ $aluno->data_nascimento }}">
                </div>

                <div class="mb-3">
                    <label for="tipo_endereco" class="form-label">Tipo de Endereço</label>
                    <select name="tipo_endereco" id="tipo_endereco" class="form-select">
                        <option value="Cobrança" {{ $aluno->tipo_endereco == 'Cobrança' ? 'selected' : '' }}>Cobrança</option>
                        <option value="Residencial" {{ $aluno->tipo_endereco == 'Residencial' ? 'selected' : '' }}>Residencial</option>
                        <option value="Correspondência" {{ $aluno->tipo_endereco == 'Correspondência' ? 'selected' : '' }}>Correspondência</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" name="endereco" class="form-control" id="endereco" value="{{ $aluno->endereco }}">
                </div>

                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" name="cep" class="form-control" id="cep" value="{{ $aluno->cep }}">
                </div>

                <div class="mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" name="numero" class="form-control" id="numero" value="{{ $aluno->numero }}">
                </div>

                <div class="mb-3">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" name="complemento" class="form-control" id="complemento" value="{{ $aluno->complemento }}">
                </div>

                <!-- Campo Série como select -->
                <div class="mb-3">
                    <label for="serie" class="form-label">Série</label>
                    <select name="serie" id="serie" class="form-select">
                        <option value="G1" {{ $aluno->serie == 'G1' ? 'selected' : '' }}>G1 (3 anos)</option>
                        <option value="G2" {{ $aluno->serie == 'G2' ? 'selected' : '' }}>G2 (4 anos)</option>
                        <option value="G3" {{ $aluno->serie == 'G3' ? 'selected' : '' }}>G3 (5 anos)</option>
                        <option value="1º" {{ $aluno->serie == '1º' ? 'selected' : '' }}>1º ano (6 anos)</option>
                        <option value="2º" {{ $aluno->serie == '2º' ? 'selected' : '' }}>2º ano (7 anos)</option>
                        <option value="3º" {{ $aluno->serie == '3º' ? 'selected' : '' }}>3º ano (8 anos)</option>
                        <option value="4º" {{ $aluno->serie == '4º' ? 'selected' : '' }}>4º ano (9 anos)</option>
                        <option value="5º" {{ $aluno->serie == '5º' ? 'selected' : '' }}>5º ano (10 anos)</option>
                        <option value="6º" {{ $aluno->serie == '6º' ? 'selected' : '' }}>6º ano (11 anos)</option>
                        <option value="7º" {{ $aluno->serie == '7º' ? 'selected' : '' }}>7º ano (12 anos)</option>
                        <option value="8º" {{ $aluno->serie == '8º' ? 'selected' : '' }}>8º ano (13 anos)</option>
                        <option value="9º" {{ $aluno->serie == '9º' ? 'selected' : '' }}>9º ano (14 anos)</option>
                        <option value="1ºEM" {{ $aluno->serie == '1ºEM' ? 'selected' : '' }}>1º ano Ensino Médio (15 anos)</option>
                        <option value="2ºEM" {{ $aluno->serie == '2ºEM' ? 'selected' : '' }}>2º ano Ensino Médio (16 anos)</option>
                        <option value="3ºEM" {{ $aluno->serie == '3ºEM' ? 'selected' : '' }}>3º ano Ensino Médio (17 anos)</option>
                    </select>
                </div>

                <!-- Campo Segmento preenchido automaticamente -->
                <div class="mb-3">
                    <label for="segmento" class="form-label">Segmento</label>
                    <input type="text" name="segmento" class="form-control" id="segmento" value="{{ $aluno->segmento }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="nome_pai" class="form-label">Nome do Pai</label>
                    <input type="text" name="nome_pai" class="form-control" id="nome_pai" value="{{ $aluno->nome_pai }}">
                </div>

                <div class="mb-3">
                    <label for="nome_mae" class="form-label">Nome da Mãe</label>
                    <input type="text" name="nome_mae" class="form-control" id="nome_mae" value="{{ $aluno->nome_mae }}">
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Aluno</button>
            </form>
        </div>
    </div>
</div>

<!-- Script para preencher automaticamente o campo Segmento -->
<script>
    document.getElementById('serie').addEventListener('change', function () {
        const serie = this.value;
        let segmento = '';

        if (['G1', 'G2', 'G3'].includes(serie)) {
            segmento = 'Infantil';
        } else if (['1º', '2º', '3º', '4º', '5º'].includes(serie)) {
            segmento = 'Anos Iniciais';
        } else if (['6º', '7º', '8º', '9º'].includes(serie)) {
            segmento = 'Anos Finais';
        } else if (['1ºEM', '2ºEM', '3ºEM'].includes(serie)) {
            segmento = 'Ensino Médio';
        }

        document.getElementById('segmento').value = segmento;
    });

    // Preencher automaticamente o campo "Segmento" ao carregar a página
    document.addEventListener('DOMContentLoaded', function () {
        const serie = document.getElementById('serie').value;
        let segmento = '';

        if (['G1', 'G2', 'G3'].includes(serie)) {
            segmento = 'Infantil';
        } else if (['1º', '2º', '3º', '4º', '5º'].includes(serie)) {
            segmento = 'Anos Iniciais';
        } else if (['6º', '7º', '8º', '9º'].includes(serie)) {
            segmento = 'Anos Finais';
        } else if (['1ºEM', '2ºEM', '3ºEM'].includes(serie)) {
            segmento = 'Ensino Médio';
        }

        document.getElementById('segmento').value = segmento;
    });
</script>
@endsection
