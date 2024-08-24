<?php

use Illuminate\Support\Facades\Route;

Route::get('/' , function() {
   return view("principal.index");
});

Route::get('produtos/', function() {
    return view('produtos.lista');
});

Route::get('/gerencia', function() {
    return view('admin.principal.index');
});