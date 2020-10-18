<div class="container-fluid">
    <br>
    <form name="fbicicleta" id="fbicicleta" action="/novo/controller/SalvarBicicleta.php" method="post">
        <input type="hidden" id="codbicicleta" name="codbicicleta">
        <input type="hidden" name="codmorador" id="codmorador" value="<?=$_SESSION["codpessoa"]?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome</label>
                    <input name="nome" id="nome" type="text" required class="form-control"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <i class="fa fa-street-view" aria-hidden="true"></i>
                        Localização
                    </label>
                    <input name="localizacao" id="localizacao" type="text" class="form-control"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Imagem</label>
                    <input name="imagem" type="file" class="form-control" accept="image/*"/>
                    <div id="div_bicicleta"></div>
                </div>
            </div>             
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <button id="btnSalvarBicicleta" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Bicicleta</button>
            </div>
        </div>        
    </form>
    <br>
    <div class="responsive" id="listagemBicicleta"></div>
</div>