<div class="container-fluid">
    <br>
    <form class="form-procurar" id="fPpessoa" method="post" onsubmit="return false">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>
                        <i class="fa fa-calendar"></i>
                        Dt. Inicio
                    </label>
                    <input type="date" class="form-control" name="data1" id="data1" title="Digite data de inicio onde foi feito o cadastro"  title="Data inicial de seu cadastro">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>
                        <i class="fa fa-calendar"></i>
                        Dt. Fim
                    </label>
                    <input type="date" class="form-control" name="data2" id="data2" title="Digite data de fim onde foi feito o cadastro" title="Data final de seu cadastro">
                </div>
            </div> 
            <div class="col-md-3">
                <div class="form-group">
                    <label for="statusp">Status</label>
                    <select id="statusp" class="form-control codstatus" multiple name="status[]"></select>
                </div>  
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="blocop">Bloco</label>
                    <select id="blocop" class="form-control codbloco" multiple data-actions-box="true" name="bloco[]"></select>
                </div>
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="apartamentop">Apartamento</label>
                    <select id="apartamentop" class="form-control codapartamento" multiple data-actions-box="true" name="apartamento[]"></select>
                </div>
            </div> 
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codnivelp">Perfil</label>
                    <select id="codnivelp" class="form-control codnivel" multiple data-actions-box="true" name="codnivel[]"></select>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codcategoriap">Categoria</label>
                    <select id="codcategoriap" class="form-control codcategoria" multiple data-actions-box="true" name="codcategoria[]"></select>
                </div>
            </div>
          
            <div class="col-md-12">
                <button id="btnProcurar" type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i> Procurar</button>
            </div>
        </div> 
    </form>
    <br>
    <div id="listagemPessoa" class="table-responsive"></div>
</div>

<div id="modalImagem" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="nome_imagem">Modal Header</h4>
      </div>
      <div class="modal-body">
        <img class="img-responsive" id="img01">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>