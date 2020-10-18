<div class="container-fluid">
    <br>
    <form name="fobservacao" id="fobservacao" onsubmit="return false;">
        <input type="hidden" id="codobservacao" name="codobservacao">
        <input type="hidden" name="codmorador" value="<?=$_SESSION["codpessoa"]?>">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Texto</label>
                    <textarea name="texto" id="observacao_morador" spellcheck="true" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button id="btnSalvarObservacao" onclick="salvarObservacao()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Observação</button>
            </div>
        </div>        
    </form>
    <br>
    <div class="responsive" id="listagemObservacao"></div>
</div>