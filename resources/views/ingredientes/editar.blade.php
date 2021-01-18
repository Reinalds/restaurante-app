@extends('layouts.app')

@if (Auth::user()->name)

@section('content')
    <div style="padding-left:15%; padding-right:15%">
        <h1 style="border-bottom: 1px solid #d2d6de">Atualizar Prato</h1>
    </div>
    <div style="padding-left:20%; padding-right:20%">
        <form action="{{ route('ingrediente.editar', ['id' => $ingrediente->id]) }} " method="POST" enctype="application/x-www-form-urlencoded">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" type="text" id="nome" name="nome" value="{{ $ingrediente->nome }}">
            </div>
            <button type="submit" class="btn btn-success">Atualizar</a>
            @method('PUT')
            @csrf
        </form>
    </div>

@endsection

@else

@section('content')
    <p>Voce nao tem permissao para acessar essa pagina</p>
@endsection

@endif