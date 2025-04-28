<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SeriesController extends Controller
{
    public function import()
    { 
        return view('import');
    }

    public function importSeries(Request $request)
    {
        $baseUrl = env('OMDB_API_URL');
        $apiKey = env('OMDB_API_KEY');
        $seriesName = $request->input('seriesName');

        try {
            $finalUrl = "{$baseUrl}&apikey={$apiKey}&t=" . urlencode($seriesName);

            $response = Http::post($finalUrl);

            $data = $response->json();

            if ($response->successful() && $data['Response'] !== 'False') {

                $existingSeries = Series::where('imdb_id', $data['imdbID'])->first();

                if ($existingSeries) {
                    return response()->json([
                        'success' => false,
                        'Title' => $data['Title'],
                        'error' => 'Série já cadastrada.',
                    ], 409); 
                }

                Series::create([
                    'imdb_id' => $data['imdbID'],
                    'title' => $data['Title'],
                    'year' =>$data['Year'] ?? null,
                    'rated' =>$data['Rated'] ?? null,
                    'released' =>$data['Released'] ?? null,
                    'runtime' =>$data['Runtime'] ?? null,
                    'genre' =>$data['Genre'] ?? null,
                    'director' =>$data['Director'] ?? null,
                    'writer' =>$data['Writer'] ?? null,
                    'actors' =>$data['Actors'] ?? null,
                    'plot' =>$data['Plot'] ?? null,
                    'language' =>$data['Language'] ?? null,
                    'country' =>$data['Country'] ?? null,
                    'awards' =>$data['Awards'] ?? null,
                    'poster' =>$data['Poster'] ?? null,
                    'imdb_rating' =>$data['imdbRating'] ?? null,
                    'type' =>$data['Type'] ?? null,
                    'total_seasons' =>$data['totalSeasons'] ?? null,
                ]);

                return response()->json([
                    'success' => true,
                    'Title' => $data['Title'],
                    'Year' => $data['Year'],
                    'Message' => 'Série importada com sucesso!',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'Message' => 'Série não encontrada.',
                    'error' => $data['Error']
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Erro ao importar série: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function list(Request $request)
    {
        $rating = $request->input('rating');

        $query = Series::query();

        if ($rating) {
            $query->where('imdb_rating', '>=', $rating)->orderBy('imdb_rating', 'desc');
        }

        $series = $query->get();
        
        return view('series', compact('series'));
    }
}
