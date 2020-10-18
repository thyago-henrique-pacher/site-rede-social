<?php
$codmorador = explode('/', $uri)[3];

?>
<a href="../model/Conexao.php">Conexao</a>
<style>
    .camposImportantes select{
        border: 1px solid #337ab7;
    }
</style>
<section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> <i class="fa fa-user"></i> Cadastro de Usuários</h3>
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#cadastro"><i class="fa fa-pencil" aria-hidden="true"></i> Cadastro</a></li>
                    <li><a data-toggle="tab" href="#procurar"><i class="fa fa-search" aria-hidden="true"></i> Procurar</a></li>
                    <li class="usuarioEditar hidden"><a data-toggle="tab" href="#tab_atestado"><i class="fa fa-stethoscope" aria-hidden="true"></i> Atestado</a></li>
                    <li class="usuarioEditar hidden"><a data-toggle="tab" href="#tab_arquivo"><i class="fa fa-file-text-o" aria-hidden="true"></i> Arquivo</a></li>
                    <li class="usuarioEditar hidden"><a data-toggle="tab" href="#tab_telefone"><i class="fa fa-mobile" aria-hidden="true"></i> Telefone</a></li>
                    <li class="usuarioEditar hidden"><a data-toggle="tab" href="#tab_veiculos"><i class="fa fa-car" aria-hidden="true"></i> Veículos</a></li>
                    <li class="usuarioEditar hidden"><a data-toggle="tab" href="#tab_observacao"><i class="fa fa-list-ul" aria-hidden="true"></i> Observação</a></li>
                    <li class="usuarioEditar hidden"><a data-toggle="tab" href="#tab_bicicleta"><i class="fa fa-bicycle" aria-hidden="true"></i> Bicicleta</a></li>
                </ul>

                <div class="tab-content" style="border: 1px solid gainsboro">
                    <div id="cadastro" class="tab-pane fade in active">
                        <?php include './formPessoa.php'; ?>                                                         
                    </div>
                    <div id="procurar" class="tab-pane fade">
                        <?php include './formProcurarPessoa.php'; ?>
                    </div> 
                    <div id="tab_atestado" class="tab-pane fade">
                        <?php include './formAtestado.php'; ?>
                    </div> 
                    <div id="tab_arquivo" class="tab-pane fade">
                        <?php include './formArquivo.php'; ?>
                    </div>
                    <div id="tab_telefone" class="tab-pane fade">  
                        <?php include './formTelefone.php'; ?>
                    </div> 
                    <div id="tab_veiculos" class="tab-pane fade">
                        <?php include './formVeiculo.php'; ?>
                    </div>
                    <div id="tab_observacao" class="tab-pane fade">  
                        <?php include './formObservacaoMorador.php'; ?>
                    </div>
                    <div id="tab_bicicleta" class="tab-pane fade">
                        <?php include './formBicicleta.php'; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>