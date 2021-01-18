@extends('layouts.app')

@section('content')


<div style="padding-right:3%; padding-left:3%">
    <h1 style="border-bottom: 1px solid #d2d6de">Relatórios</h1>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#garcom">Garçom</a></li>
        <li><a data-toggle="tab" href="#cozinheiro">Cozinheiro</a></li>
    </ul>

    <div class="tab-content">
        <div id="garcom" class="tab-pane fade in active">
            <table class="table table-striped table-sm">
                <tr>
                    <th>Nome</th>
                    <th>Pedidos Realizados</th>
                </tr>
                @foreach ($garcons as $garcon)
                <tr>
                    <td>{{ $garcon->name }}</td>
                    <td>{{ $garcon->desempenho }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div id="cozinheiro" class="tab-pane fade">
            <table class="table table-striped table-sm">
                <tr>
                    <th>Nome</th>
                    <th>Pedidos Preparados</th>
                </tr>
                @foreach ($cozinheiros as $cozinheiro)
                <tr>
                    <td>{{ $cozinheiro->name }}</td>
                    <td>{{ $cozinheiro->desempenho }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection