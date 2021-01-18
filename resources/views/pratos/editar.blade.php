@extends('layouts.app')

@if (Auth::user()->tipo == 1)

@section('content')
    <div style="padding-left:15%; padding-right:15%">
        <h1 style="border-bottom: 1px solid #d2d6de">Atualizar Prato</h1>
    </div>
    <div style="padding-left:20%; padding-right:20%">
        <form action="{{ route('pratos.editarSave') }}" method="POST" enctype="application/x-www-form-urlencoded">
            <input type="text" name="id" value="{{ $prato->id }}" style="display: none">
            <div class="form-group">
                <label for="nome">Nome: </label>
                <input class="form-control" type="text" id="nome" name="nome" value="{{ $prato->nome }}">
            </div>
            <div class="form-group">
                <label for="preco">Preco: </label>
                <input class="form-control" type="text" id="preco" name="preco" value="{{ $prato->preco }}">
            </div>
            <h3 style="border-bottom: 1px solid #d2d6de">Ingredientes <small>Selecione múltiplos ingredientes utilizando Shift e/ou Ctrl.</small></h3>
            <select id="ingredientes" class="form-control" name="ingredientes[]" multiple>
                    @foreach($ingredientes as $ingrediente)
                        @if($prato->ingredientes->contains($ingrediente->id))
                            <option value="{{ $ingrediente->id }}" selected> {{ $ingrediente->nome }}</option>
                        @endif
                        @if(!($prato->ingredientes->contains($ingrediente->id)))
                            <option value="{{ $ingrediente->id }}"> {{ $ingrediente->nome }}</option>
                        @endif
                    @endforeach
                </select>

            <br>
            <button type="submit" class="btn btn-success">Atualizar</button>
            @csrf
            @method('PUT')
        </form>
        <hr>
    </div>

@endsection

@else

@section('content')
    <h1>Voce nao tem permissao para acesar essa pagina</h1>
@endsection

@endif