@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Cadastrar Novo Aluno</h1>
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

                <form action="{{ route('alunos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="nome_completo">Nome Completo</label>
                        <input class="form-control" id="nome_completo" name="nome_completo" type="text" value="{{ old('nome_completo') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="data_nascimento">Data de Nascimento</label>
                        <input class="form-control" id="data_nascimento" name="data_nascimento" type="date" value="{{ old('data_nascimento') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tipo_endereco">Tipo de Endereço</label>
                        <select class="form-select" id="tipo_endereco" name="tipo_endereco">
                            <option value="Cobrança">Cobrança</option>
                            <option value="Residencial">Residencial</option>
                            <option value="Correspondência">Correspondência</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="endereco">Endereço</label>
                        <input class="form-control" id="endereco" name="endereco" type="text" value="{{ old('endereco') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cep">CEP</label>
                        <input class="form-control" id="cep" name="cep" type="text" value="{{ old('cep') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="numero">Número</label>
                        <input class="form-control" id="numero" name="numero" type="text" value="{{ old('numero') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="complemento">Complemento</label>
                        <input class="form-control" id="complemento" name="complemento" type="text" value="{{ old('complemento') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="serie">Série</label>
                        <select class="form-select" id="serie" name="serie">
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

                    <div class="mb-3">
                        <label class="form-label" for="segmento">Segmento</label>
                        <input class="form-control" id="segmento" name="segmento" type="text" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nome_pai">Nome do Pai</label>
                        <input class="form-control" id="nome_pai" name="nome_pai" type="text" value="{{ old('nome_pai') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nome_mae">Nome da Mãe</label>
                        <input class="form-control" id="nome_mae" name="nome_mae" type="text" value="{{ old('nome_mae') }}">
                    </div>

                    <button class="btn btn-primary" type="submit">Cadastrar Aluno</button>
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
    </script>
@endsection
