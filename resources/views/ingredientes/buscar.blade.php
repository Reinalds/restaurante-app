@extends('layouts.app')

@section('content')

<div style="padding-right:3%; padding-left:3%">
    <h1 style="border-bottom: 1px solid #d2d6de">Ingredientes</h1>
    <table class="table table-striped table-sm">
        <tr>
            <th>Nome</th>
            @if (Auth::user() ->tipo == 1)
            <th style="width:80px">
                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
            @endif
        </tr>
        @foreach($ingredientes as $ingrediente)
        <tr>
            <td>{{ $ingrediente->nome }}</td>
            @if(Auth::user()->tipo == 1)
            <td>
                <div class="btn-group" style="width:80px">
                <a href=" {{ route('ingrediente.editarView', ['id' => $ingrediente->id]) }}"class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                <form action="{{ route('ingrediente.remover', ['id' => $ingrediente->id]) }}" method="POST" style="display: inline;">
                    @method('DELETE')
                    @csrf
                    <button type="submit" style="width:40px" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></button>
                </form>
                </div>
            </td>
            @endif
        </tr>
        @endforeach
    </table>
</div>

<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Cadastrar Ingrediente</h3>
            </div>
            <div class="modal-body">
            <form action="{{ route('ingrediente.inserir') }}" method="post" enctype="application/x-www-form-urlencoded" id="formAdd">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input class="form-control" type="text" id="nome" name="nome_ingrediente" required>
                    </div>
                    
                    @method('POST')
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="formAdd" class="btn btn-success">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

@endsection