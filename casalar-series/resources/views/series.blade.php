@extends('layout')

@section('title', 'Minhas Séries')

@section('content')
    <h1 class="p-6 text-2xl font-bold mb-6">Minhas Séries</h1>

    <div class="p-6 rounded shadow-md">
        <form method="GET" action="{{ route('series.list') }}" class="mb-6 flex items-center gap-3">
            <input 
                type="number" 
                step="0.1" 
                min="0" 
                max="10" 
                name="rating" 
                value="{{ request('rating') }}" 
                placeholder="Pontuação mínima (ex: 8.5)" 
                class="w-[400px] border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 text-gray-800 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-600"
            >
            <button
                type="submit"
                class="border border-gray-400 dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold px-5 py-2 rounded-full transition"
            >
                Filtrar
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 dark:border-gray-600">
                <thead class="dark:bg-gray-800">
                    <tr >
                        <th class="px-6 py-3 text-left text-xs font-bold text-white tracking-wider border border-gray-300 dark:border-gray-600">
                            Título
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-white tracking-wider border border-gray-300 dark:border-gray-600">
                            Gênero
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-white tracking-wider border border-gray-300 dark:border-gray-600">
                            Ano
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-white tracking-wider border border-gray-300 dark:border-gray-600">
                            Pontuação OMDb
                        </th>
                        <th class="px-6 py-3  text-left text-xs font-bold text-white tracking-wider border border-gray-300 dark:border-gray-600">
                            Poster
                        </th> 
                    </tr>
                </thead>
                <tbody class="border border-gray-300 dark:border-gray-600">
                    @foreach ($series as $serie)
                        <tr>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-600">
                                {{ $serie->title }}
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-600">
                                {{ $serie->genre }}
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-600">
                                {{ $serie->year }}
                            </td>
                            <td class="px-6 py-4 text-gray-800 dark:text-gray-100 border border-gray-300 dark:border-gray-600">
                                {{ $serie->imdb_rating }}
                            </td>
                            <td class="px-6 py-4 text-right border border-gray-300 dark:border-gray-600">
                                <a href="{{ $serie->poster }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
