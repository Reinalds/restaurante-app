@extends('layouts.app')

@if (Auth::user()->tipo == 1)

@section('content')

    <form action="{{ route('ingrediente.inserir') }}" method="post" enctype="application/x-www-form-urlencoded">
        <label for='nome'>Nome do ingrediente: </label>
        <input type="text" id='nome' name='nome_ingrediente'>
        <button type="submit">Salvar</button>
        @csrf
    </form>

@endsection

@else

@section('content')
    <p>Voce nao tem permissao para acessar essa pagina</p>
@endsection

@endif