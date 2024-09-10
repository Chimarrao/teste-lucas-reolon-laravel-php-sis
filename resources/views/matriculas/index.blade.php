@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Matricular Alunos</h1>

    <!-- Selecionar Série -->
    <div class="mb-3">
        <label for="serie" class="form-label">Selecione a Série</label>
        <select id="serie" class="form-select">
            <option value="">Selecione a Série</option>
            @foreach ($series as $serie)
                <option value="{{ $serie }}">{{ $serie }}</option>
            @endforeach
        </select>
    </div>

    <!-- Lista de Alunos -->
    <div class="row">
        <div class="col-md-6">
            <h2>Alunos Sem Turma</h2>
            <ul id="alunos-list" class="list-group">
                <!-- Alunos sem turma serão carregados aqui -->
            </ul>
        </div>

        <!-- Lista de Turmas Condizentes com a Série Selecionada -->
        <div class="col-md-6">
            <h2>Turmas</h2>
            <div id="turmas-list">
                <!-- Turmas serão carregadas dinamicamente aqui -->
            </div>
        </div>
    </div>
</div>

<!-- Inclusão do SortableJS para o Drag-and-Drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.getElementById('serie').addEventListener('change', function () {
    const serie = this.value;

    // Limpa os campos de alunos e turmas quando a série é trocada
    document.getElementById('alunos-list').innerHTML = '';
    document.getElementById('turmas-list').innerHTML = '';

    if (!serie) return; // Se a série não for selecionada, não faz nada

    // Realiza a requisição para buscar alunos e turmas da série selecionada
    fetch(`/matriculas/alunos/${serie}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error); // Exibe erro se as turmas não forem encontradas
                return;
            }

            const { alunosSemTurma, alunosComTurma, turmas } = data;

            // Preencher a lista de alunos sem turma
            const alunosList = document.getElementById('alunos-list');
            if (alunosSemTurma.length === 0) {
                alunosList.innerHTML = 'Nenhum aluno sem turma';
            }
            alunosSemTurma.forEach(aluno => {
                const li = document.createElement('li');
                li.textContent = aluno.nome_completo;
                li.className = 'list-group-item';
                li.dataset.alunoId = aluno.id;
                alunosList.appendChild(li);
            });

            // Inicializa o SortableJS para alunos sem turma
            new Sortable(alunosList, {
                group: 'shared',
                animation: 150
            });

            // Preencher as turmas e alunos já matriculados
            const turmasList = document.getElementById('turmas-list');
            turmas.forEach(turma => {
                const turmaCard = document.createElement('div');
                turmaCard.classList.add('card', 'mb-3');

                turmaCard.innerHTML = `
                    <div class="card-header">
                        ${turma.nome_turma} (${turma.serie}) - ${turma.turno}
                    </div>
                    <div class="card-body">
                        <ul id="turma-${turma.id}" class="turma-list list-group" data-turma-id="${turma.id}">
                            <!-- Alunos já matriculados serão carregados aqui -->
                        </ul>
                    </div>
                `;

                turmasList.appendChild(turmaCard);

                // Preencher alunos já matriculados na turma
                const turmaUl = document.querySelector(`#turma-${turma.id}`);
                alunosComTurma.forEach(aluno => {
                    if (aluno.turma_id === turma.id) {
                        const li = document.createElement('li');
                        li.textContent = aluno.nome_completo;
                        li.className = 'list-group-item';
                        li.dataset.alunoId = aluno.id;

                        // Adicionar a classe "disabled" para bloquear o drag nos alunos já matriculados
                        li.classList.add('disabled');
                        turmaUl.appendChild(li);
                    }
                });

                // Inicializa o SortableJS para as turmas
                new Sortable(turmaUl, {
                    group: 'shared',
                    animation: 150,
                    onAdd: function (evt) {
                        const alunoId = evt.item.dataset.alunoId;
                        const turmaId = evt.to.dataset.turmaId;

                        // Realiza a matrícula via AJAX
                        fetch('/matricular-aluno', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                aluno_id: alunoId,
                                turma_id: turmaId
                            })
                        }).then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                alert(data.error);
                                // Caso ocorra erro, retorna o aluno à lista anterior
                                evt.from.appendChild(evt.item);
                            } else {
                                alert(data.success);
                            }
                        }).catch(error => {
                            console.error('Erro ao matricular aluno:', error);
                            evt.from.appendChild(evt.item); // Devolve o aluno à lista anterior em caso de erro
                        });
                    }
                });
            });
        })
        .catch(error => {
            console.error('Erro ao carregar alunos e turmas:', error);
        });
});
</script>
@endsection
