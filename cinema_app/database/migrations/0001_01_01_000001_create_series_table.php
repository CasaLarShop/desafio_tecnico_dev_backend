<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('ano');
            $table->string('avaliacao')->nullable();
            $table->string('lancamento')->nullable();
            $table->string('genero')->nullable();
            $table->string('diretor')->nullable();
            $table->text('escritor')->nullable();
            $table->string('atores')->nullable();
            $table->text('enredo')->nullable();
            $table->string('lingua')->nullable();
            $table->string('pais')->nullable();
            $table->string('premios')->nullable();
            $table->string('poster')->nullable();
            $table->float('avaliacao_imdb')->nullable();
            $table->integer('votos_imdb')->nullable();
            $table->string('id_imdb')->unique();
            $table->string('tipo');
            $table->integer('total_temporadas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('series');
    }
};

?>