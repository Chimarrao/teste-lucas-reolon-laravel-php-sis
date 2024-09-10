@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório: Alunos por Série e Segmento</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Série</th>
                <th>Segmento</th>
                <th>Total de Alunos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($relatorio as $item)
                <tr>
                    <td>{{ $item->serie }}</td>
                    <td>{{ $item->segmento }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
