<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema Escolar</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('alunos.index') }}">Alunos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('turmas.index') }}">Turmas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('matriculas.index') }}">Matricular</a>
                    </li>
                </ul>
            </div>
        </div>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('relatorios.alunosPorSerieSegmento') }}">Relatório Alunos por Série/Segmento</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('relatorios.alunosPorTurma') }}">Relatório Alunos por Turma</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('relatorios.irmaos') }}">Relatório de Irmãos</a>
            </li>
        </ul>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user() ? Auth::user()->name : '' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user() ? Auth::user()->email : '' }}</div>
            </div>

            @if (Auth::user())
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <a class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white" href="{{ route('login') }}">
                        Log in
                    </a>
                </div>
            @endif
        </div>
    </nav>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-mrcRLLLUrtMOE2DRHfGhQdjSgIRGAGzvRlsbPOfQm5LmSNcJchxp5B8FCR02CWzr" crossorigin="anonymous"></script>
</body>

</html>
