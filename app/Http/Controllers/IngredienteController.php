<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingrediente;

class IngredienteController extends Controller
{

    public function buscarIngredientes() {

        $meusIngredientes = Ingrediente::all();

        return view('ingredientes.buscar', ['ingredientes' => $meusIngredientes]);
    }
    
    public function novoIngrediente(Request $request) {

        if($request->input('nome_ingrediente') == "") {

            return redirect()->back()->with('popup', 'Campo nao pode ser vazio');
        }

        $novo_ingrediente = new Ingrediente;
        $novo_ingrediente->nome = $request->input('nome_ingrediente');
        $novo_ingrediente->save();

        return redirect()->route('ingrediente.buscar');
    }

    public function buscarViewEditar(Request $request) {

        $ingrediente = Ingrediente::findOrFail($request->input('id'));

        return view('ingredientes.editar', ['ingrediente' => $ingrediente]);
        
    }

    public function editarIngrediente(Request $request) {

        $ingrediente = Ingrediente::findOrFail($request->input('id'));
        $ingrediente->nome = $request->input('nome');
        $ingrediente->save();

        return redirect()->route('ingrediente.buscar');
    }

    public function removerIngrediente(Request $request) {

        $ingrediente = Ingrediente::findOrFail($request->input('id'));
        $ingrediente->delete();

        return redirect()->route('ingrediente.buscar');
    }

}
