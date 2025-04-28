<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/import', [SeriesController::class, 'import'])->name('series.import');

Route::post('/import', [SeriesController::class, 'importSeries'])->name('series.importSeries');

Route::get('/series', [SeriesController::class, 'list'])->name('series.list');
