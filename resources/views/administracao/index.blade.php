@extends('layouts.app')

@if (Auth::user()->tipo == 1)
    
@section('content')

<div style="padding-right:3%; padding-left:3%">
    <h1 style="border-bottom: 1px solid #d2d6de">Gerencia de Usuarios</h1>
    <table class="table table-striped table-sm">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Cargo</th>
            <th style="width:80px">
                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->name }}</td>
            <td>{{ $usuario->email }}</td>
            <td>
            @if ($usuario->tipo === 1)
                Administrador
            @endif
            @if ($usuario->tipo === 2)
                Cozinheiro
            @endif
            @if ($usuario->tipo === 3)
                Garçom
            @endif
            </td>
            <td>
                <div class="btn-group" style="width:80px">

                <a href="{{ route('administracao.buscarEdicao', ['id_usuario' => $usuario->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></a>
                    <form action="{{ route('administracao.excluir', $usuario->id) }}" method="POST" style="display: inline;">
                        @method('DELETE')
                        @csrf
                        <button type="submit" style="width:40px" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></button>
                    </form>
                </div>
            </td>
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
                <h3>Castrar Novo Usuario</h3>
            </div>
            <div class="modal-body">
                <form action="{{ route('administracao.cadastrar') }}" method="POST" enctype="application/x-www-form-urlencoded" id="formAdd">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email" placeholder="example@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <label for="funcao">Funcao:</label><br>
                    <div class="radio">
                        <label><input type="radio" name="tipo" value="2" checked> Cozinheiro</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="tipo" value="3"> Garçom</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="tipo" value="1"> Administrador</label>
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

@else

@section('content')
    <h1>Voce nao tem permissao para acessar essa pagina</h1>
@endsection

@endif