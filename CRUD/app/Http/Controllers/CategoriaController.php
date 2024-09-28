<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index() 
    {
        //SELECT * FROM categoria
        //$categorias = Categoria::all();
        $categorias = Categoria::where("cat_ativo", 1)->get();
        return view("categoria.index", compact('categorias'));
    }

    public function SalvarNovaCategoria(Request $request)
    {
        $cat_nome = $request->input('cat_nome');
        $cat_descricao = $request->input('cat_descricao');

        /*
        INSERT INTO categoria (cat_nome, cat_descricao)
        VALUES ('$cat_nome', '$cat_descricao')
        */

        $categoria = new Categoria();
        $categoria->cat_nome = $cat_nome;
        $categoria->cat_descricao = $cat_descricao;
        $categoria->save();

        return redirect('/categoria');
    }

    public function ExcluirCategoria($id)
    {
        //SELECT * FROM categoria WHERE id=1
        $categoria = Categoria::where("id", $id)->first();
        $categoria->cat_ativo = 0;
        $categoria->save();
        //UPDATE categoria SET cat_ativo=0 WHERE id=1

        return redirect("/categoria");

        //DELETE
        /*
        $categoria = Categoria::where("id", $id)->first();
        $categoria->delete();
        */
    }

    public function BuscaAlterar($id)
    {
        $categoria = Categoria::where("id", $id)->first();

        return view('categoria.alterar', compact('categoria'));
    }

    public function SalvarAlteracao(Request $request)
    {
        $nome = $request->input("cat_nome");
        $descricao = $request->input("cat_descricao");
        $id = $request->input("id");

        $categoria = Categoria::where("id",$id)->first();
        $categoria->cat_nome = $nome;
        $categoria->cat_descricao = $descricao;
        $categoria->save();

        return redirect("/categoria");

    }
}
