<div class="container-fluid">
    <br>
    <form id="fPmensagem">
        <div class="row">        
            <div class="col-md-3">
                <div class="form-group">
                    <label>
                        <i class="fa fa-calendar"></i>
                        Dt. Inicio
                    </label>
                    <input type="date" class="form-control" name="data1" id="data1" title="Digite data de inicio onde foi feito o cadastro" min="<?= $data1msg ?>" max="<?= $conexao->hoje; ?>" title="Data inicial de seu cadastro" value="<?= $conexao->hoje; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>
                        <i class="fa fa-calendar"></i>
                        Dt. Fim
                    </label>
                    <input type="date" class="form-control" name="data2" id="data2" title="Digite data de fim onde foi feito o cadastro" min="<?= $data1msg ?>" max="<?= $conexao->hoje; ?>" title="Data final de seu cadastro" value="<?= $conexao->hoje; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="assunto" id="responder" class="form-control" name="assunto" placeholder="Digite assunto" value="" required minlength="3" maxlength="250">
                </div>
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="blocop">Bloco</label>
                    <select id="blocop" class="form-control codbloco selectpicker" multiple data-actions-box="true" name="bloco"></select>
                </div>
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="apartamento">Apartamento</label>                    
                    <select id="apartamento" class="form-control codapartamento selectpicker" multiple data-actions-box="true" name="apartamento"></select>
                </div>
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="codmorador">Morador</label>                    
                    <select id="codmorador" class="form-control codpessoa selectpicker" multiple data-actions-box="true" name="codmorador"></select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codnivel">Nível</label>
                    <select id="codnivel" class="form-control codnivel selectpicker" multiple data-actions-box="true" name="codnivel" required=""></select>
                </div>  
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <button id="btnProcurarMensagem" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processando..." class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i> Procurar</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 table-responsive" >
            <table id="tblmensagem" class="table table-bordered table-striped dataTable display nowrap" cellspacing="0" width="100%" style="display: none">
                <thead>
                    <tr>
                        <th>Por</th>
                        <th>Assunto</th>                        
                        <th>Qtd. Total</th>
                        <th>Qtd. Enviado</th>
                        <th>Qtd. Lido</th>
                        <th>E-mail</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="mDestinatarios" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Texto da mensagem:</h4>
                        <span id="textoMsg"></span> 
                    </div>
                    <br>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="tblmensagemdestinatario" class="table table-bordered table-striped dataTable display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Para</th>
                                    <th>E-mail</th>
                                    <th>Enviado</th>
                                    <th>Lido</th>
                                    <th>Bloco</th>
                                    <th>Apartamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <br>
                <div style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Resposta do usuário:</h5>
                            <span id="resposta"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <form id="frmResponderMensagem">
                            <input type="hidden" name="codpessoa" value="">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="responder">Responder</label>
                                    <textarea id="responder" class="form-control" rows="5" spellcheck="true"></textarea>
                                </div>
                            </div>
                        </form>                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>