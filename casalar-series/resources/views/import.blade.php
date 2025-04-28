@extends('layout')

@section('title', 'Importar Séries')

@section('content')
    <h1 class="p-6 text-2xl font-bold mb-6">Importar Séries</h1>

    <div class="p-6 rounded shadow-md">
        <form id="importSeries" class="flex items-center gap-3" action="#" method="POST">
            @csrf
            <input
                type="text"
                id="seriesName"
                name="seriesName"
                placeholder="Nome da série"
                class="w-[400px] border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 text-gray-800 dark:text-gray-100 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-600"
                required
            />

            <button
                type="submit"
                class="border border-gray-400 dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold px-5 py-2 rounded-full transition"
            >
                Importar
            </button>
        </form>

        <div id="responseMessage" class="mt-6 text-center text-lg font-semibold"></div>
    </div>

    <script>
        const form = document.getElementById('importSeries');
        const responseMessage = document.getElementById('responseMessage');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const seriesName = document.getElementById('seriesName').value.trim();
            
            if (!seriesName) {
                responseMessage.textContent = "Por favor, informe o nome da série.";
                responseMessage.className = 'mt-6 text-red-600 font-bold';
                return;
            }
            
            try {
                submitButton.disabled = true;
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                responseMessage.textContent = "Importando série...";
                responseMessage.className = 'mt-6 text-blue-600 font-bold';

                const response = await fetch("{{ route('series.importSeries') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ seriesName: seriesName })
                });
                
                const data = await response.json();
                
                if (response.ok && data.success) {
                    responseMessage.textContent = `Série "${data.Title}" importada com sucesso! Ano: ${data.Year}`;
                    responseMessage.className = 'mt-6 text-green-600 font-bold';
                } else if (response.status === 409) {
                    responseMessage.textContent = `Série "${data.Title}" já cadastrada!`;
                    responseMessage.className = 'mt-6 text-yellow-600 font-bold';
                } else if (response.status === 404) {
                    responseMessage.textContent = `Série "${seriesName}" não encontrada!`;
                    responseMessage.className = 'mt-6 text-yellow-600 font-bold';
                } else {
                    throw new Error(data.error || 'Série não encontrada.');
                }
            } catch (error) {
                responseMessage.textContent = error.message;
                responseMessage.className = 'mt-6 text-red-600 font-bold';
            } finally {
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>
@endsection
