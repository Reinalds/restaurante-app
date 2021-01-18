<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //Cadastro de clientes: clientes nao logam no sistema; apenas para registrar os pedidos

    public function cadastrarCliente($nome_cliente) {

        $cliente = new Cliente;
        $cliente->nome = $nome_cliente;
        $cliente->save();
    }

}
