<section class="wrapper">
    <h3><i class="fa fa-angle-right"></i> <i class="fa fa-envelope"></i> Cadastro de Mensagem Morador</h3>
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#cadastro"><i class="fa fa-pencil" aria-hidden="true"></i> Cadastro</a></li>
                    <li><a data-toggle="tab" href="#procurar"><i class="fa fa-search" aria-hidden="true"></i> Procurar</a></li>
                </ul>

                <div class="tab-content" style="border: 1px solid gainsboro">
                    <div id="cadastro" class="tab-pane fade in active">
                        <?php include './formMensagem.php'; ?>
                    </div>
                    <div id="procurar" class="tab-pane fade">
                        <?php include './formProcurarMensagem.php'; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>