<?php
include './ValidaSessao.php';

include '../model/Veiculo.php';
$veiculo = new Veiculo($conexao);

foreach ($_POST as $key => $value) {
    $veiculo->$key = $value;
}

if(!isset($_POST["codmorador"]) || $_POST["codmorador"] == NULL || $_POST["codmorador"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha morador!!!', 'situacao' => false)));
}

if (isset($veiculo->codveiculo) && $veiculo->codveiculo != NULL && $veiculo->codveiculo != '') {
    $resSalvar = $veiculo->atualizar();
} else {
    $resSalvar = $veiculo->inserir();
}


if($resSalvar == FALSE){
    die(json_encode(array('mensagem' => 'Erro ao salvar veiculo causado por: '. mysqli_error($conexao->conexao), 'situacao' => false)));
}else{
    die(json_encode(array('mensagem' => 'Veiculo salvo com sucesso!!!', 'situacao' => true)));
}
