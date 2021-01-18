<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\PratoPedido;
use App\User;
use Auth;

class PedidoController extends Controller
{
    
    //Status: 1 - Recebido; 2 - Em preparo; 3 - Pronto
    public function realizarPedido(Request $request) {
        if(empty($request->input('pratos')) || empty($request->input('quantidade'))) {
            return redirect()->back();
        }
        
        $novoPedido = new Pedido;

        //Salvar que o garcom realizou um pedido
        $garcom = User::findOrFail(Auth::id());
        $garcom->desempenho = $garcom->desempenho + 1;
        $garcom->save();
        
        //$novoPedido->idCliente = $idCliente;
        $novoPedido->id_funcionario_1 = Auth::id();
        $novoPedido->nome_funcionario_1 = $garcom->name;
        $novoPedido->status = 1;
        $novoPedido->pago = 0;

        $novoPedido->save();

        $pedidoId = $novoPedido->id;

        $pratos = $request->input('pratos');
        $quantidades = $request->input('quantidade');
        $counter = 0;


        foreach($pratos as $prato) {
            
            $novoPratoPedido = new PratoPedido;
    
            $novoPratoPedido->pedido_id = $pedidoId;
            $novoPratoPedido->prato_id = $prato;
            $novoPratoPedido->quantidade = $quantidades[$counter];
    
            $novoPratoPedido->save();
            
            $counter++;
        }
        
        return redirect()->route('pedidos.buscar');

    }

    public function comecarPreparo($id) {

            //Salvar que o cozinheiro preparou mais um prato
            $cozinheiro = User::findOrFail(Auth::id());
            $cozinheiro->desempenho = $cozinheiro->desempenho + 1;
            $cozinheiro->save();
            
            $pedido = Pedido::findOrFail($id);
            
            $pedido->status = 2;
            $pedido->id_funcionario_2 = Auth::id();
            $pedido->nome_funcionario_2 = $cozinheiro->name;


            //Verificar como vamos obter o id do cozinheiro que vai preparar o pedido (session ou parametro)
            //$pedido->idCozinheiro = $_SESSION['idCozinheiro'];

            $pedido->save();

            return redirect()->route('pedidos.buscar');

    }

    public function finalizarPedido($id) {

                $pedido = Pedido::findOrFail($id);
                
                $pedido->status = 3;

                $pedido->save();
                
                return redirect()->route('pedidos.buscar');
    }

    public function mostrarPedidos(Request $request) {

        $pedidos = Pedido::all();
        $funcionarios = User::all();
                
        return view('pedidos.mostrar', ['pedidos' => $pedidos,
                                        'funcionarios' => $funcionarios]);
    }


}
