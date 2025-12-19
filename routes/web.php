<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\carController;

// Rota Pública
Route::get('/', [MonitorController::class, 'index']);

// Rotas Protegidas
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard Principal
    Route::get("/home", [MonitorController::class, 'dashboard'])->name("home");

    // Fluxo de Consulta FIPE
    Route::get('/modelos', [MonitorController::class, 'modelos'])->name("modelos");
    Route::get('/anos', [MonitorController::class, 'anos'])->name("anos");
    Route::get('/detalhes', [MonitorController::class, 'detalhes'])->name("detalhes");

    // Garagem (CRUD)
    Route::get('/garagem', [CarController::class, 'index'])->name("garage.index");
    Route::post('/garagem', [CarController::class, 'store'])->name("garage.store");
    Route::delete('/garagem/{id}', [CarController::class, 'destroy'])->name('garage.destroy'); // Corrigido

    // Análise Gráfica
    Route::get('/dashboard/analise/{id}', [MonitorController::class, 'analise'])->name('dashboard.analise');
});
