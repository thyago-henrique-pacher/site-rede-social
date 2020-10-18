<div class="container-fluid">
    <br>
    <form name="ftelefone" id="ftelefone" onsubmit="return false;">
        <input type="hidden" id="codtelefone" name="codtelefone">
        <input type="hidden" name="codmorador" value="<?=$_SESSION["codpessoa"]?>">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group"> 
                    <label>Número</label>
                    <input name="numero" id="numero" type="text" maxlength="15" minlength="8" class="form-control"/>
                </div>
            </div>  
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <button id="btnSalvarTelefone" onclick="salvarTelefone()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Telefone</button>
            </div>
        </div>        
    </form>
    <br>
    <div class="responsive" id="listagemTelefone"></div>
</div>