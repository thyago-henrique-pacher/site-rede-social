<div class="container-fluid">
    <br>
    <form id="fmensagem">
        <div class="row">
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="bloco">Bloco</label>
                    <select id="bloco" class="form-control codbloco selectpicker" multiple data-actions-box="true" name="bloco[]"></select>
                </div>
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="apartamentop">Apartamento</label>
                    <select id="apartamentop" oi="oi" class="form-control codapartamento selectpicker" multiple data-actions-box="true" name="apartamento"></select>
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
                    <label for="codcategoria">Categoria</label>
                    <select id="codcategoria" class="form-control codcategoria selectpicker" multiple data-actions-box="true" name="codcategoria"></select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codnivel">Nível</label>
                    <select id="codnivel" class="form-control codnivel selectpicker" multiple data-actions-box="true" name="codnivel"></select>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codcomunicado">Comunicado</label>
                    <select id="codcomunicado" class="form-control codcomunicado" name="codcomunicado" required></select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="responder">Responder para</label>
                    <input type="email" id="responder" class="form-control" name="responder" placeholder="Digite e-mail" value="" required minlength="5" maxlength="150" onfocus="$(this).removeAttr('readonly');">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="assunto">Assunto</label>
                    <input type="assunto" id="assunto" class="form-control" name="assunto" placeholder="Digite assunto" value="" required minlength="3" maxlength="250">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="arquivo">Arquivo</label>
                    <input type="file" multiple id="arquivo" class="form-control" name="arquivo[]" >
                </div>
                <div id="progressSend">
                    <div id="barEnvio"></div>
                    <div id="percentEnvio">0%</div>
                </div>
                <div id="statusEnvio" style="display: none"></div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="texto">Texto</label>                    
                    <textarea id="texto" name="texto" class="form-control texto" rows="5" spellcheck="true"></textarea>
                </div>
            </div>
            <div id="divTblCalculadora" class="col-lg-12" style="display: none">
                <p><b>Com os filtros selecionados vão ser enviados:</b></p>
                <table class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Total filtrado</th>
                            <th>Total ativo</th>
                            <th>Total Com E-mail</th>
                            <th>Total Sem E-mail</th>
                            <th>Apto Com E-mail</th>
                            <th>Total à enviar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="qtdTotal"></td>
                            <td id="qtdAtivo"></td>
                            <td id="qtdComEmail"></td>
                            <td id="qtdSemEmail"></td>
                            <td id="qtdAptComEmail"></td>
                            <td id="qtdEnviar"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <b>
                    <p>
                        Quantidade já usada (mês): <span id="qtdTotalMes" class="contabilizador"></span>, 
                        Quantidade já usada (hoje): <span id="qtdTotalDia" class="contabilizador"></span>
                    </p>
                    <ul>
                        <li>* Ao atingir limite de <span id="limiteemail" class="contabilizador"></span> os envios são somente por notificação.</li>
                        <li>* O sistema somente contabiliza quem tem e-mail!</li>
                        <li>* Ao clicar em enviar aguarde até que o mesmo retorne mensagem de erro ou sucesso. Faça isso em horário ao qual não precise mexer no sistema, pois a mesma é uma ação demorada.</li>
                    </ul>
                </b>
            </div>            
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <button id="btnEnviar" type="button" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enviar</button>
            <button id="btnVisualizar" type="button" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</button>
        </div>
    </div>
    <br>
</div>
<div id="modalVisualizacao" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Visualização de destinatários</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="tblVisualizacao" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Bloco</th>
                                    <th>Apartamento</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>