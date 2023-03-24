<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\AnuidadeController;
use App\Http\Controllers\AssociadoController;
use App\Http\Controllers\PagamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AssociadoController::class, 'dashboard'])
    ->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {

    Route::prefix('/associados')->group( function () {

        Route::get('/', [AssociadoController::class, 'index'])->name('associados');
        Route::get('/pagamentos/em-dia', [AssociadoController::class, 'pagamentosEmDia'])->name('associados-em-dia');
        Route::get('/pagamentos/em-atraso', [AssociadoController::class, 'pagamentosEmAtraso'])->name('associados-em-atraso');
        Route::get('/criar', [AssociadoController::class, 'create'])->name('associados-criar');
        Route::get('/{id}/exibir', [AssociadoController::class, 'show'])->name('associados-exibir');
        Route::get('/{id}/editar', [AssociadoController::class, 'edit'])->name('associados-editar');
        Route::get('/dashboard', [AssociadoController::class, 'dashboard'])->name('associados-dashboard');

        Route::post('/', [AssociadoController::class, 'store'])->name('associados-salvar');

        Route::put('/{id}/atualizar', [AssociadoController::class, 'update'])->name('associados-atualizar');

        Route::delete('/{id}/deletar', [AssociadoController::class, 'destroy'])->name('associados-deletar');
    });

    Route::prefix('/admin/anuidades')->group( function () {

        Route::get('/', [AnuidadeController::class, 'index'])->name('anuidades');
        Route::get('/criar', [AnuidadeController::class, 'create'])->name('anuidades-criar');
        Route::get('/{id}/exibir', [AnuidadeController::class, 'show'])->name('anuidades-exibir');
        Route::get('/{id}/editar', [AnuidadeController::class, 'edit'])->name('anuidades-editar');

        Route::post('/', [AnuidadeController::class, 'store'])->name('anuidades-salvar');

        Route::put('/{id}/atualizar', [AnuidadeController::class, 'update'])->name('anuidades-atualizar');

        Route::delete('/{id}/deletar', [AnuidadeController::class, 'destroy'])->name('anuidades-deletar');
    });

    Route::prefix('/pagamentos')->group( function () {

        Route::get('/{id}/pagar/associado/{idAssociado}', [PagamentoController::class, 'pagar'])->name('pagamentos-pagar');

       /*  Route::get('/criar', [PagamentoController::class, 'create'])->name('pagamentos-criar');
        Route::get('/{id}/exibir', [PagamentoController::class, 'show'])->name('pagamentos-exibir');
        Route::get('/{id}/editar', [PagamentoController::class, 'edit'])->name('pagamentos-editar');

        Route::post('/', [PagamentoController::class, 'store'])->name('pagamentos-salvar');

        Route::put('/{id}/atualizar', [PagamentoController::class, 'update'])->name('pagamentos-atualizar');

        Route::delete('/{id}/deletar', [PagamentoController::class, 'destroy'])->name('pagamentos-deletar'); */
    });

});



