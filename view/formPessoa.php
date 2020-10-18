<div class="container-fluid">
    <br>
    <form id="fpessoa">
        <input type="hidden" id="codpessoa" name="codpessoa" value="">
     
        <div class="row" id="div_navegacao" style="display: none">
            <div class="col-md-2"> 
                <label>Navegação:</label>
            </div>
            <div class="col-md-8">
                <label><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Anterior</label>
                <label class="pull-right">Próximo <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></label>
            </div>
            <div class="col-md-2"></div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tipopessoa">Tipo</label>
                    <select id="tipopessoa" class="form-control" name="tipopessoa" required>
                        <option value="">--Selecione--</option>
                        <option value="m">Morador</option>
                        <option value="f">Funcionário</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codcategoria">Categoria</label>
                    <select id="codcategoria" class="form-control codcategoria" name="codcategoria" required></select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codnivel">Perfil</label>
                    <select id="codnivel" class="form-control codnivel" name="codnivel"></select>
                </div>  
            </div>
            <div class="col-md-3 hidden" id="caixa_status">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" class="form-control" name="status">
                        <?php
                            $array_status = array('a' => 'Ativo', 'i' => 'Inativo', 'e' => 'Ex-morador', 'n' => 'Novo');
                            echo "<option value='{$id}'>{$nome}</option>";
                            foreach ($array_status as $key => $value) {
                                echo "<option value='{$key}'>{$value}</option>";
                            }
                        ?>
                    </select>
                </div>  
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="imagempes">Imagem</label>
                    <input id="imagempes" type="file" class="form-control" name="imagem" accept="image/*">
                    <img id="imgPreview" height="150" src="/sistema/visao/recursos/img/sem_imagem.png">
                </div>
                <div id="progressSend">
                    <div id="barEnvio"></div>
                    <div id="percentEnvio">0%</div>
                </div>
                <div id="statusEnvio" style="display: none"></div>
            </div>
            <div class="col-md-4">
                <a target="_blank" href="/sistema/visao/TirarFoto.php?codpessoa=6" id="btnWebcam" class="btn btn-default"><i class="fa fa-camera" aria-hidden="true"></i> Tirar Foto com Webcam</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" class="form-control" name="nome" placeholder="Digite o nome do usuário" value="<?= $res['nome'] ?>" required minlength="3" maxlength="250">
                </div> 
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="bloco">Bloco</label>
                    <!--<select id="bloco" class="form-control codbloco" name="bloco"></select>-->
                    <input type="text" id="bloco" class="form-control" name="bloco" placeholder="Digite o bloco" value="<?= $res['bloco'] ?>" required minlength="1" maxlength="100">
                </div>
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="apartamento">Apartamento</label>
                    <!--<select id="apartamento" class="form-control codapartamento" name="apartamento"></select>-->
                    <input type="text" id="apartamento" class="form-control" name="apartamento" placeholder="Digite o bloco" value="<?= $res['apartamento'] ?>" required minlength="1" maxlength="100">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" class="form-control" name="email" placeholder="Digite e-mail" value="<?= $res['email'] ?>" list="blocos" minlength="5" maxlength="250">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" class="form-control" name="senha" placeholder="Digite senha" value="" list="blocos" minlength="5" maxlength="10" readonly onfocus="$(this).removeAttr('readonly');">
                </div>
            </div>
            <div class="col-md-3 morador">
                <div class="form-group">
                    <label for="dtnascimento">Data de Nascimento</label>
                    <input type="date" id="dtnascimento" class="form-control" name="dtnascimento" value="<?= $res['dtnascimento'] ?>" max="<?= date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="rg">RG </label>
                    <input type="text" id="rg" class="form-control" name="rg" value="<?= $res['rg'] ?>" placeholder="Digite RG">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" class="form-control" name="cpf" value="<?= $res['cpf'] ?>" placeholder="Digite CPF">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group morador">
                    <label>Recebe msg</label>
                    <select id="recebemsg" class="form-control" name="recebemsg">
                        <option value="">--Selecione--</option>
                        <option value="n">Não</option>
                        <option value="s">Sim</option>
                    </select>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="form-group morador">
                    <label for="fazreserva">Faz Reserva</label>
                    <select id="fazreserva" class="form-control" name="reserva">
                        <option value="">--Selecione--</option>
                        <option value="n">Não</option>
                        <option value="s">Sim</option>
                    </select>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="form-group funcionario">
                    <label for="morador">Acessa Portal</label>
                    <select id="morador" class="form-control" name="morador">
                        <option value="">--Selecione--</option>
                        <option value="n">Não</option>
                        <option value="s">Sim</option>
                    </select>
                </div>  
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="acessapainel">Acessa Painel</label>
                    <select id="acessapainel" class="form-control" name="acessapainel">
                        <option value="">--Selecione--</option>
                        <option value="n">Não</option>
                        <option value="s">Sim</option>
                    </select>
                </div>  
            </div> 
            <div class="col-md-12">
                <button id="btnSalvar" type="button" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
            </div>
        </div>
    </form>
    <br>
</div>