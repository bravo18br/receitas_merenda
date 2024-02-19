<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceitasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('botao');
});

Route::get('/receitas_modal', [ReceitasController::class, 'get_receitas_modal_view']);

Route::get('/gerenciar_receitas', [ReceitasController::class, 'get_gerenciar_receitas']);

Route::post('/salvar_receita', [ReceitasController::class, 'post_salvar_receita']);

Route::delete('/receita/{id}', [ReceitasController::class, 'excluir_receita'])->name('receita.excluir');