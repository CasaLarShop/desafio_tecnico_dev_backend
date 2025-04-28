<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema de Séries')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css') {{-- Se estiver usando Vite para CSS --}}

    @php
        $currentRoute = Route::currentRouteName();
    @endphp
</head>

<body class="w-full flex min-h-screen bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]">

    <!-- Sidebar -->
    <aside class="w-22rem bg-white dark:bg-gray-800 shadow-md flex flex-col">
        <div class="p-6">
            <h1 class="text-gray-800 dark:text-gray-100 text-4xl font-bold">CasaLar Series</h1>
        </div>

        <nav class="flex flex-col flex-1 p-6 space-y-6 gap-4">
        <a href="{{ route('welcome') }}"
            class="w-full text-left p-3 rounded font-semibold transition
                {{ $currentRoute == 'welcome'
                    ? 'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-400'
                    : 'hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
            Página inicial
        </a>

        <a href="{{ route('series.import') }}"
            class="w-full text-left p-3 rounded font-semibold transition
                {{ $currentRoute == 'series.import'
                    ? 'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-400'
                    : 'hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
            Importar
        </a>

        <a href="{{ route('series.list') }}"
            class="w-full text-left p-3 rounded font-semibold transition
                {{ $currentRoute == 'series.list'
                    ? 'bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-400'
                    : 'hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
            Minhas Séries
        </a>
        </nav>
    </aside>


    <!-- Main content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>
</html>
