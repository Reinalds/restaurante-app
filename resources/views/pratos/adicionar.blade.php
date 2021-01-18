@extends('layouts.app')

@if (Auth::user()->tipo == 1)
    
@endif
@section('content')
    <div style="padding-left:15%; padding-right:15%">
        <h1 style="border-bottom: 1px solid #d2d6de">Cadastrar Prato</h1>
    </div>
    <div style="padding-left:20%; padding-right:20%">
        <form action="{{ route('pratos.adicionar') }}" method="post" enctype="application/x-www-form-urlencoded">
            <div id="pratoForm">
                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input class="form-control" type="text" id="nome" name="nome">
                </div>
                <div class="form-group">
                    <label for="preco">Preço: </label>
                    <input class="form-control" type="text" id="preco" name="preco" placeholder="___.__">
                </div>
                
                <h3 style="border-bottom: 1px solid #d2d6de">Ingredientes <small>Selecione múltiplos ingredientes utilizando Shift e/ou Ctrl.</small></h3>
                
                <select id="ingredientes" class="form-control" name="ingredientes[]" multiple>
                    @foreach($ingredientes as $ingrediente)
                        <option value="{{ $ingrediente->id }}"> {{ $ingrediente->nome }}</option>
                    @endforeach
                </select>
                <br>
            <button type="submit" class="btn btn-success" id="cadastrarPratoBtn">Cadastrar</button>
            @csrf
        </form>
    </div>

@endsection

@else

@section('content')
    <h1>Voce nao tem permissao para acesar essa pagina</h1>
@endsection

@endif