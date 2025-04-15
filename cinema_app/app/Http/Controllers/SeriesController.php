<?php

//A base do CRUD, no caso so o CR

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SeriesController extends Controller
{
    private $apiKey = '657b80c8'; //pode ser colocada no env
    private $baseUrl = 'https://www.omdbapi.com/';

    public function import(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        $title = $request->input('titulo');

        try {
            $response = Http::withoutVerifying()->get($this->baseUrl, [
                'apikey' => $this->apiKey,
                't' => $title,
                'type' => 'series',
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['Response']) && $data['Response'] === 'True') {
                $existingSeries = Series::where('id_imdb', $data['imdbID'])->first();
                
                if ($existingSeries) {
                    return response()->json([
                        'message' => 'Serie ja existe no sistema!',
                        'serie' => $existingSeries
                    ], 200);
                }
                $series = Series::create([
                    'titulo' => $data['Title'],
                    'ano' => $data['Year'],
                    'avaliacao' => $data['Rated'] ?? null,
                    'lancamento' => $data['Released'] ?? null,
                    'genero' => $data['Genre'] ?? null,
                    'diretor' => $data['Director'] ?? null,
                    'escritor' => $data['Writer'] ?? null,
                    'atores' => $data['Actors'] ?? null,
                    'enredo' => $data['Plot'] ?? null,
                    'lingua' => $data['Language'] ?? null,
                    'pais' => $data['Country'] ?? null,
                    'premios' => $data['Awards'] ?? null,
                    'poster' => $data['Poster'] ?? null,
                    'avaliacao_imdb' => $data['imdbRating'] !== 'N/A' ? (float)$data['imdbRating'] : null,
                    'votos_imdb' => $data['imdbVotes'] !== 'N/A' ? (int)str_replace(',', '', $data['imdbVotes']) : null,
                    'id_imdb' => $data['imdbID'],
                    'tipo' => $data['Type'],
                    'total_temporadas' => $data['totalSeasons'] !== 'N/A' ? (int)$data['totalSeasons'] : null,
                ]);

                return response()->json([
                    'message' => 'Série Importada!',
                    'series' => $series
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Série não encontrada',
                    'error' => $data['Error'] ?? '??'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao importar série',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        $query = Series::query();

        if ($request->has('avaliacao') && is_numeric($request->avaliacao)) {
            $avaliacao = (float) $request->avaliacao;
            $query->where('avaliacao_imdb', '>=', $avaliacao);
        }

        $series = $query->get();

        return response()->json([
            'contagem' => $series->count(),
            'series' => $series
        ], 200);
    }
}

?>