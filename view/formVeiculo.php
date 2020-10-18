<div class="container-fluid">
    <br>
    <form name="fveiculo" id="fveiculo" onsubmit="return false;">
        <input type="hidden" id="codveiculo" name="codveiculo">
        <input type="hidden" name="codmorador" value="<?=$_SESSION["codpessoa"]?>">
        <div class="row col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Placa</label>
                    <input type="text" name="placa" id="placa" maxlength="8" minlength="8" class="form-control placa" value=""/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Modelo</label>
                    <input type="text" name="marca" id="marca" class="form-control" value=""/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Cor</label>
                    <input type="text" name="cor" id="cor" class="form-control" value=""/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button id="btnSalvarVeiculo" onclick="salvarVeiculo()" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Veiculo</button>
            </div>
        </div>        
    </form>
    <br>
    <div class="responsive" id="listagemVeiculo"></div>
</div>