<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function () {
    Route::get("/categoria", [ CategoriaController::class, "index" ] )->name('categoria');
    Route::post("/categoria", [ CategoriaController::class, "SalvarNovaCategoria" ]);

    Route::get("/categoria/upd/{id}", 
        [CategoriaController::class, 'BuscaAlterar']
    )->name('cat_alterar');
    Route::post("categoria/udp",
        [CategoriaController::class, 'SalvarAlteracao']
    )->name('cat_alt_salva');
    Route::get("/categoria/exc/{id}", 
        [ CategoriaController::class, 'ExcluirCategoria']
    )->name('cat_excluir');


    Route::get("/produto", [ProdutoController::class, 'index'] )->name('produto_idex');
    Route::post("/produto", 
        [ProdutoController::class, 'SalvarNovoProduto'] )->name('produto_novo');
});

Route::get('/login', function() {
    return view("admin_template.login");
})->name('login');

Route::get('/registrar', function() {
    return view("admin_template.registrar");
});

Route::post('/login', [AuthController::class, 'login']);

// Rotas para administradores
Route::middleware('adminAuth')->group(function () {
    echo "ola";
    exit;
    Route::post('/registrar', [AuthController::class, 'registrar']);
    Route::post('/registrar', [AuthController::class, 'registrar']);
    // suas rotas de administradores aqui
});