<?php

include './ValidaSessao.php';

include '../model/Telefone.php';
$telefone = new Telefone($conexao);

foreach ($_POST as $key => $value) {
    $telefone->$key = $value;
}

if(!isset($_POST["numero"]) || $_POST["numero"] == NULL || $_POST["numero"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha numero!!!', 'situacao' => false)));
}
if(!isset($_POST["codmorador"]) || $_POST["codmorador"] == NULL || $_POST["codmorador"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha morador!!!', 'situacao' => false)));
}
$telefone->codpessoa = $_POST["codmorador"];

if (isset($telefone->codtelefone) && $telefone->codtelefone != NULL && $telefone->codtelefone != '') {
    $resSalvar = $telefone->atualizar();
} else {
    $resSalvar = $telefone->inserir();
}


if($resSalvar == FALSE){
    die(json_encode(array('mensagem' => 'Erro ao salvar telefone causado por: '. mysqli_error($conexao->conexao), 'situacao' => false)));
}else{
    die(json_encode(array('mensagem' => 'Telefone salvo com sucesso!!!', 'situacao' => true)));
}
