<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'ano',
        'avaliacao',
        'lancamento',
        'genero',
        'diretor',
        'escritor',
        'atores',
        'enredo',
        'lingua',
        'pais',
        'premios',
        'poster',
        'avaliacao_imdb',
        'votos_imdb',
        'id_imdb',
        'tipo',
        'total_temporadas',
    ];

    protected $casts = [
        'avaliacao_imdb' => 'float',
        'votos_imdb' => 'integer',
        'total_temporadas' => 'integer',
    ];
}

?>