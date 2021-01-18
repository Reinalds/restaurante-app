@extends('layouts.app')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

@section('content')

<div style="padding-right:3%; padding-left:3%">
    <h1 style="border-bottom: 1px solid #d2d6de">Cardápio</h1>

    @if (Auth::user()->tipo == 1)
    <div style="float: right">
        <a href="{{ route('pratos.adicionarView') }}" class="btn btn-success"><b>
            <i class="fas fa-plus"></i>
        Adicionar Prato
        </b></a>
        <span> </span>
    </div> 
    @endif
    <table style="text-align: center" class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col" style="text-align: center" >Nome</th>
                <th scope="col" style="text-align: center" >Preço</th>
                <th scope="col" style="text-align: center" >Ingredientes</th>
                <th scope="col" style="width: 5%;text-align:center"></th>
                <th scope="col" style="width: 5%;text-align:center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pratos as $prato)
            <tr>
                <td>{{ $prato->nome }}</td>
                <td>R$ {{ $prato->preco }} </td>
                <td>
                    <details>
                        <summary class="btn btn-info">Mostrar</summary>
                        @foreach ($prato->ingredientes as $ingrediente)
                            <li>{{ $ingrediente->nome }}</li>
                        @endforeach
                    </details>
                </td>
                @if (Auth::user()->tipo == 1)
                <td>

                    <a href="{{ route('pratos.editarView', ['id' => $prato->id]) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td>
                    <a href="{{ route('pratos.deletar', ['id' => $prato->id]) }}" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
