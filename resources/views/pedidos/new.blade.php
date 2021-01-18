@extends('layouts.app')

@if (Auth::user()->tipo == 1 || Auth::user()->tipo == 3)
    
@section('content')

    <script>
        
        function addPratoSection() {

            document.getElementById("botaoNovoPrato").style.display = "none";
            document.getElementById("addPratoSection").style.display = "";
            document.getElementById("pratosEscolhidos").style.display = "none";
        }
        
        function addPrato() {

            var prato = document.getElementById("pratos");
            
            var idPrato = prato.options[prato.selectedIndex].value;
            var quantidade = document.getElementById("quantidade").value;

            var novoPrato = document.createElement("input");
            var novaQuantidade = document.createElement("input");

            novoPrato.setAttribute("name", "pratos[]");
            novaQuantidade.setAttribute("name", "quantidade[]");

            novoPrato.setAttribute("value", idPrato);
            novaQuantidade.setAttribute("value", quantidade);

            novoPrato.setAttribute("style", "display: none");
            novaQuantidade.setAttribute("style", "display: none");

            document.getElementById("pratosEscolhidos").appendChild(novoPrato);
            document.getElementById("pratosEscolhidos").appendChild(novaQuantidade);
            
            document.getElementById("botaoNovoPrato").style.display = "";
            document.getElementById("addPratoSection").style.display = "none";
            document.getElementById("pratosEscolhidos").style.display = "";

            //Criar area onde serao mostrados os pratos que foram escolhidos

            var pratosEscolhidos = document.getElementById("pratosEscolhidos");

            var pratoNome = document.createElement("li");
            pratoNome.className = "list-group-item";
            var pratoQuantidade = document.createElement("li");
            pratoQuantidade.className = "list-group-item";
            var quebraLinha = document.createElement("br"); 

            pratoNome.innerHTML = "Prato: "+ prato.options[prato.selectedIndex].text;
            pratoQuantidade.innerHTML = "Quantidade: "+ quantidade;

            pratosEscolhidos.appendChild(pratoNome);
            pratosEscolhidos.appendChild(pratoQuantidade);
            pratosEscolhidos.appendChild(quebraLinha);

        }
    
    </script>
    <div style="padding-left:15%; padding-right:15%">
        <h1 style="border-bottom: 1px solid #d2d6de">Realizar Pedido</h1>
    </div>
    <div style="padding-left:20%; padding-right:20%">
        <form action="{{ route('pedidos.novoSalvar') }}" method="POST" enctype="application/x-www-form-urlencoded">

            <div id="botaoNovoPrato">
                <div class="btn-group">
                    <button type="button" class="btn btn-success" onclick="addPratoSection()"><span class="glyphicon glyphicon-plus"></span>Adicionar Prato</button>
                    <button type="submit" class="btn btn-success">Finalizar Pedido <span class="glyphicon glyphicon-ok"></span></button>
                </div>
            </div>
            <hr>
        
            <div style="display: none;" id="addPratoSection">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="pratos">Prato:</label>
                            <select class="form-control" name="pratos" id="pratos">
                                @foreach ($pratos as $prato)
                                    <option value="{{ $prato->id }}">{{ $prato->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="quantidades">Quantidade:</label>
                            <input class="form-control" id="quantidade" name="quantidade">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success" onclick="addPrato()">Adicionar</button>
            </div>
            
            <div id="pratosEscolhidos">
                <h3 style="border-bottom: 1px solid #d2d6de">Pratos Escolhidos</h3>
            </div>
            @csrf
        </form>
    </div>
@endsection

@else

@section('content')
    <p>Voce nao tem permissao para acessar essa pagina</p>
@endsection

@endif