@extends('layouts.app')

@if (Auth::user()->tipo == 1)
@section('content')
<div style="padding-left:15%; padding-right:15%">
    <h1 style="border-bottom: 1px solid #d2d6de">Atualizar Usuário</h1>
</div>

<div style="padding-left:20%; padding-right:20%">

<form action="{{ route('administracao.editar') }}" method="POST" enctype="application/x-www-form-urlencoded">
    <input type="text" name="id" value="{{ $usuario->id }}" style="display: none;">
    <div class="form-group">
        <label for="name">Nome</label>
        <input class="form-control" type="text" id="name" name="name" value="{{ $usuario->name }}">
    </div>
    <div class="form-group">
        <label for="name">E-mail</label>
        <input class="form-control" type="text" id="name" name="email" value="{{ $usuario->email }}">
    </div>
    <label for="funcao">Cargo:</label><br>
    <div class="radio">
        @if ($usuario->tipo === 2)
            <label><input type="radio" name="tipo" value="2" checked> Cozinheiro</label>
        @endif
        @if ($usuario->tipo !== 2)
            <label><input type="radio" name="tipo" value="2"> Cozinheiro</label>
        @endif
    </div>
    <div class="radio">
    @if ($usuario->tipo === 3)
        <label><input type="radio" name="tipo" value="3" checked> Garçom</label>
    @endif
    @if ($usuario->tipo !== 3)
        <label><input type="radio" name="tipo" value="3"> Garçom</label>
    @endif
    </div>
    <div class="radio">
        @if ($usuario->tipo === 1)
            <label><input type="radio" name="tipo" value="1" checked> Administrador</label>
        @endif
        @if ($usuario->tipo !== 1)
            <label><input type="radio" name="tipo" value="1"> Administrador</label>
        @endif
    </div>

    <button type="submit" class="btn btn-success">Atualizar</button>
    @method('PUT')
    @csrf
</form>
    
</div>
@endsection

@else

@section('content')
    <h1>Voce nao tem permissao para acessar essa pagina</h1>
@endsection

@endif