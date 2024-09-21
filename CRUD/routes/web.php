<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get("/", function() {
    return view("admin_template.index");
});

Route::get("/categoria", [ CategoriaController::class, "index" ] );

Route::get("/produto", function() {
    return view("produto.index");
});