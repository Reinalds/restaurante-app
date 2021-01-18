@extends('layouts.app')

@section('content')
    
<div style="padding-right:3%; padding-left:3%">
    <h1 style="border-bottom: 1px solid #d2d6de">Pedidos</h1>

    @if (Auth::user()->tipo == 1 || Auth::user()->tipo == 3)
        <div id="realizar-pedido">
            <a href="{{ route('pedidos.novo') }}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> <b>Novo Pedido</b></a>
        </div>
    @endif
    <hr>
    <div class="row">
    <div class="col-sm-4" id="recebido">
        <h2 style="border-bottom: 1px solid #d2d6de">Pedidos em espera</h2>
        @foreach ($pedidos as $pedido)
            @if ($pedido->status === 1)
            <ul style="width:400px; text-align: center;">
                <li class="list-group-item"><b>Codigo do pedido:</b> {{ $pedido->id }}</li>
                <li class="list-group-item"><b>Garcom responsavel:</b> {{ $pedido->nome_funcionario_1 }}</li>
                <li class="list-group-item"><b>Status:</b> Recebido</li>
                <li class="list-group-item"><b>Recebido em:</b> {{ $pedido->created_at }}</li>
                <li class="list-group-item"><b>Ultima atualizacao:</b> {{ $pedido->updated_at }}</li>
                <li class="list-group-item">
                {{-- <button type="button" class="btn btn-outline-info">Detalhes</button> --}}
                    <div id="detalhesPedido">
                        {{-- <li>{{ $prato->nome }}</li> --}}
                        {{-- <li>{{ $prato->pivot->quantidade }}</li> --}}
                    </div>
                    <div class="btn-group">                    
                        <button type="button" 
                            class="btn btn-primary"
                            data-toggle="modal" 
                            data-target="#myModal"
                        ><span class="glyphicon glyphicon glyphicon-info-sign"></span> Detalhes
                        </button>
                        @if (Auth::user()->tipo == 2)
                            <a href="{{ route('pedidos.preparar', ['id' => $pedido->id]) }}" class="btn btn-primary">Comecar Preparo <span class="glyphicon glyphicon-fire"></span></a>
                        @endif
                    </div>
                </li>
            </ul>
                @endif
            
            @endforeach
    </div>

    <div class="col-sm-4" id="em-preparo">
        <h2 style="border-bottom: 1px solid #d2d6de">Pedidos em preparo</h2>
        @foreach ($pedidos as $pedido)
            @if ($pedido->status === 2)
            <ul style="width:400px; text-align: center;">
                <li  class="list-group-item"><b>Codigo do pedido:</b> {{ $pedido->id }}</li>
                <li  class="list-group-item"><b>Garcom responsavel:</b> {{ $pedido->nome_funcionario_1 }}</li>
                <li  class="list-group-item"><b>Cozinheiro responsavel:</b> {{ $pedido->nome_funcionario_2 }}</li>
                <li  class="list-group-item"><b>Status:</b> Em Preparo</li>
                <li class="list-group-item"><b>Recebido em:</b> {{ $pedido->created_at }}</li>
                <li class="list-group-item"><b>Ultima atualizacao:</b> {{ $pedido->updated_at }}</li>
                <li  class="list-group-item">
                    {{-- <button type="button" class="btn btn-outline-info">Detalhes</button> --}}
                    <div id="detalhesPedido">
                        {{-- <li>{{ $prato->nome }}</li> --}}
                        {{-- <li>{{ $prato->pivot->quantidade }}</li> --}}
                    </div>    
                    <div class="btn-group">
                        <button type="button" 
                            class="btn btn-primary"
                            data-toggle="modal" 
                            data-target="#myModal"
                            ><span class="glyphicon glyphicon glyphicon-info-sign"></span> Detalhes
                        </button>
                        @if (Auth::user()->tipo == 2)
                            <a href="{{ route('pedidos.concluir', ['id' => $pedido->id]) }}" class="btn btn-primary">Pedido Pronto <span class="glyphicon glyphicon-ok"></span></a>
                        @endif
                    </div>
                </li>
            </ul>
            @endif
        @endforeach
    </div>

    <div class="col-sm-4" id="pronto">
        <h2 style="border-bottom: 1px solid #d2d6de">Pedidos prontos</h2>
        @foreach ($pedidos as $pedido)
            @if ($pedido->status === 3)
            <ul style="width:400px; text-align: center">
                <li class="list-group-item"><b>Codigo do pedido:</b> {{ $pedido->id }}</p>
                <li class="list-group-item"><b>Garcom responsavel:</b> {{ $pedido->nome_funcionario_1 }}</p>
                <li class="list-group-item"><b>Cozinheiro responsavel:</b> {{ $pedido->nome_funcionario_2 }}</p>
                <li class="list-group-item"><b>Status:</b> Pronto</p>
                <li class="list-group-item"><b>Recebido em:</b> {{ $pedido->created_at }}</li>
                <li class="list-group-item"><b>Ultima atualizacao:</b> {{ $pedido->updated_at }}</li>
                {{-- <button type="button" class="btn btn-outline-info">Detalhes</button> --}}
                <li class="list-group-item">
                    <div id="detalhesPedido">
                        {{-- <li>{{ $prato->nome }}</li> --}}
                        {{-- <li>{{ $prato->pivot->quantidade }}</li> --}}
                    </div>
                    <button type="button" 
                        class="btn btn-primary"
                        data-toggle="modal" 
                        data-target="#myModal"
                        ><span class="glyphicon glyphicon glyphicon-info-sign"></span> Detalhes
                    </button>
                </li>
            </ul>
            @endif
        @endforeach
    </div>
    </div>


    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalhes do pedido</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @foreach ($pedido->pratos as $prato)
                    <ul>
                        <li class="list-group-item"><b>Prato:</b> {{ $prato->nome }}</li>
                        <li class="list-group-item"><b>Quantidade:</b> {{ $prato->pivot->quantidade }}</li>
                    </ul>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalhes do pedido</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @foreach ($pedido->pratos as $prato)
                    <ul>
                        <li class="list-group-item"><b>Prato:</b> {{ $prato->nome }}</li>
                        <li class="list-group-item"><b>Quantidade:</b> {{ $prato->pivot->quantidade }}</li>
                    </ul>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalhes do pedido</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @foreach ($pedido->pratos as $prato)
                    <ul>
                        <li class="list-group-item"><b>Prato:</b> {{ $prato->nome }}</li>
                        <li class="list-group-item"><b>Quantidade:</b> {{ $prato->pivot->quantidade }}</li>
                    </ul>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection