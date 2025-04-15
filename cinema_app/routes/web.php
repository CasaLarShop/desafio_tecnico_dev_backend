<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

Route::get('/', function () {
    return view('welcome');
});

//rotas projeto
Route::get('/series', [SeriesController::class, 'index']);
Route::post('/series/import', [SeriesController::class, 'import'])->withoutMiddleware(['web']);
