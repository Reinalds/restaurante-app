
<section>
    <div class="container">
        <h1 style="text-align:center; color:#B22222; margin-bottom: 50px; font-size: 45px">Pratos da casa</h1>
        <div class="row" >
          <div class="col-sm-4" ng-repeat="produto in produtosDestaque">
            <div class="panel panel-primary">
              <div class="panel-heading" style="background-color: #B22222; font-size: 23px">{{produto.nome}}</div>
              <img ng-src="{{produto.img1}}" class="img-fluid" style="width:100%" alt="Image">
              <div class="panel-body">

              </div>
              <div class="panel-footer" style="font-size:20px"><button  style="display:block" class="btn btn-primary" data-toggle="modal" data-target="#descricao">Descrição técnica</button></div>
            </div>
            <div class="modal fade" id="descricao" tabindex="-1" role="dialog" aria-labelledby="descricaoTecnica" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="descricaoTecnica"><b>Descrição Prato</b></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group" style="text-align: center">
                                <li class="list-group-item"><b>Nome</b>: {{produto.preco}}</li>
                                <li class="list-group-item"><b>Preco</b>: R$ {{produto.processador}}</li>
                                <li class="list-group-item"><b>Ingredientes</b>: {{produto.ram}}</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="display:block">Fechar</button>
                        </div>
                      </div>
                    </div>
            </div>

        </div>
      </div><br><br>
</section>
