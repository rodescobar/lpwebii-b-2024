<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

class ProdutosController extends Controller
{
    public function index() {
        $dados = Produtos::all()->toArray();
        print_r($dados);
    }
    
    public function novo() {

        $dados = new Produtos;
        $dados->prod_nome = "Sapato preto";
        $dados->prod_unidade = 25;
        $dados->save();
    }
}
