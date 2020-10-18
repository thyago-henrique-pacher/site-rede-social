
<div class="container-fluid">
    <br>
    <form name="farquivo" id="farquivo" action="/novo/controller/SalvarArquivoPessoa.php" method="post">
        <input type="hidden" id="codarquivo" name="codarquivo">
        <input type="hidden" name="codmorador" value="<?=$_SESSION["codpessoa"]?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome</label>
                    <input name="nome" id="nome" type="text" maxlength="150" minlength="2" required class="form-control"/>
                </div>
            </div>  
            <div class="col-md-6">
                <div class="form-group">
                    <label>Arquivo</label>
                    <input name="arquivo" id="arquivo" type="file" required class="form-control"/>
                </div>
                <div id="div_arquivo"></div>
            </div>  
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <button id="btnSalvarArquivo" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Arquivo</button>
            </div>
        </div>        
    </form> 
    <br>
    <div class="responsive" id="listagemArquivo"></div>
</div>