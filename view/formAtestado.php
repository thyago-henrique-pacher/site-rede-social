<div class="container-fluid">
    <br>
    <form name="fatestado" id="fatestado"  action="/novo/controller/SalvarAtestado.php" method="post">
        <input type="hidden" id="codatestado" name="codatestado">
        <input type="hidden" name="codmorador" value="<?=$_SESSION["codpessoa"]?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Dt. vencimento</label>
                    <input name="dtvencimento" id="dtvencimento" type="date" required class="form-control" min="<?=date("Y-m-d")?>"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="codtipo" id="codtipo" class="form-control">
                        <?php
                            $sql = "select codtipo, nome from tipoatestado where codempresa = ". $_SESSION["codempresa"];
                            $restipo = $conexao->comando($sql);
                            $qtdtipo = $conexao->qtdResultado($restipo);
                            if($qtdtipo > 0){
                                echo "<option value=''>--Selecione--</option>";
                                while($tipop = $conexao->resultadoArray($restipo)){
                                    echo "<option value='{$tipop["codtipo"]}'>{$tipop["nome"]}</option>";
                                }
                            }else{
                                echo "<option value=''>--Nada encontrado--</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Arquivo</label>
                    <input name="arquivo" id="arquivo" type="file" class="form-control"/>
                    <div id="arquivo_baixado"></div>
                </div>
            </div>            
            <div class="col-md-12">
                <div class="form-group">
                    <label>Observação</label>
                    <textarea name="observacao" id="observacao" spellcheck="true" class="form-control"></textarea>
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-12">
                <button id="btnSalvarAtestado" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Atestado</button>
            </div>
        </div>        
    </form>
    <br>
    <div class="responsive" id="listagemAtestado"></div>
</div>