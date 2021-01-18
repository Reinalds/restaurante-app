<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prato;

class PratoController extends Controller
{
    //Lembrar de verificar o retorno das funcoes com return Response::view, redirect ou View::make

    public function buscarPratos() {
        
        $pratos_buscados = Prato::all();

        $pratos = array();
        
        foreach($pratos_buscados as $prato) {
            
            array_push($pratos, $prato);
        }

        return view('pratos.buscar', ['pratos' => $pratos]);
    }
    
    //Verificar se retirar idPrato de hidden no model Prato sera suficiente
    //Atualizacao: na verdade o hasMany ingredientes no prato faz isso
    public function buscarIngredientesPrato($idPrato) {

        // $ingredientesPrato = IngredientePrato::where('idPrato', '=', $idPrato);

        // foreach($ingredientesPrato as $ingredienteTmp) {

        //     $ingrediente = Ingrediente::where('idIngrediente', '=', $ingredienteTmp->idIngrediente);

        //     echo($ingrediente);
        // }

        $ingredientes_prato = Prato::find($idPrato)->ingredientes;
        $meus_ingredientes = array();

        foreach($ingredientes_prato as $ingrediente) {

            array_push($meus_ingredientes, $ingrediente);                
        }

    }
    
    public function adicionarPrato(Request $request) {

        if($request->input('nome') == "" || $request->input('preco') == "") {
            
            return redirect()->back();
        }

        $prato = new Prato;

        $prato->nome = $request->input('nome');
        $prato->preco = $request->input('preco');
        $prato->saveOrFail();

        $prato->ingredientes()->sync($request->ingredientes);


        //Buscar no banco o id do novo prato
        /*
        $pratoAfterDB = Prato::where('nome', '=', $request->input('nome'))->firstOrFail();

        $ingredientes = $request->input('ingredientes');
        $quantidade = $request->input('quantidade');
        $i = 0;


        foreach($ingredientes as $ingrediente) {

            //$ingredienteTmp = Ingrediente::where('nome', '=', $ingrediente->nome);
            //$idIngrediente = $ingredienteTmp->idIngrediente; //Verificar se o eloquent realiza os relacionamentos auto

            $ingredientePrato = new IngredientePrato;

            //Realiza as insercoes na associativa (verificar se funciona com o withPivot())
            $ingredientePrato->prato_id = $pratoAfterDB->id;
            $ingredientePrato->ingrediente_id = $ingrediente;
            $ingredientePrato->quantidade = $quantidade[$i];

            $ingredientePrato->save();

            $i++;
        }
        */
        return redirect()->route('pratos.buscar');

    }

    public function atualizarPrato(Request $request) {

        $prato_id = $request->input('id');
        $pratoTmp = Prato::findOrFail($prato_id);

        if($request->has('nome')) {
            $pratoTmp->nome = $request->input('nome');
        }
        if($request->has('preco')) {
            $pratoTmp->preco = $request->input('preco');
        }
    
        $pratoTmp->save();

        $pratoTmp->ingredientes()->sync($request->ingredientes);

        return redirect()->route('pratos.buscar');

    }
    
    public function removerPrato($id) {

        $prato = Prato::find($id);
        $prato->delete();
        
        return redirect()->route('pratos.buscar');
    }

    //---------------------------------------------------------------------------
    /*Ao implementar a interface, seguir a seguinte logica para os ingredientes de um prato: ao lado
      de cada ingrediente um botao para atualizar ou remover, e no final um botao para adicionar outro
      ingrediente.
    */
    public function adicionarIngredientePrato($id_ingrediente, $id_prato, $quantidade) {

        $ingrediente_prato = new IngredientePrato;

        $ingrediente_prato->id_ingrediente = $id_ingrediente;
        $ingrediente_prato->id_prato = $id_prato;
        $ingrediente_prato->quantidade = $quantidade;

        $ingrediente_prato->save();
    }

    public function atualizarIngredientePrato(Request $request) {

        $id_prato = $request->input('id_prato');
        $id_ingrediente = $request->input('id_ingrediente');

        $ingrediente_prato = IngredientePrato::where('id_prato', '=', $id_prato)->where('id_ingrediente', '=', $id_ingrediente)->get();

        $ingrediente_prato->quantidade = $request->input('quantidade');

        $ingrediente_prato->save();

    }

    public function removeringredientePrato($id_ingrediente, $id_prato) {

        $ingrediente_prato = IngredientePrato::where('id_ingrediente', '=', $id_ingrediente)->where('id_prato', '=', $id_prato)->get();
        $ingrediente_prato->delete();
    }


}
