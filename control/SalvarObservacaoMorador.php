<?php
include './ValidaSessao.php';


include '../model/ObservacaoMorador.php';
$observacao = new ObservacaoMorador($conexao);

foreach ($_POST as $key => $value) {
    $observacao->$key = $value;
}

if(!isset($_POST["codmorador"]) || $_POST["codmorador"] == NULL || $_POST["codmorador"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha morador!!!', 'situacao' => false)));
}
if(!isset($_POST["texto"]) || $_POST["texto"] == NULL || $_POST["texto"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha texto!!!', 'situacao' => false)));
}

if (isset($observacao->codobservacao) && $observacao->codobservacao != NULL && $observacao->codobservacao != '') {
    $resSalvar = $observacao->atualizar();
} else {
    $resSalvar = $observacao->inserir();
}


if($resSalvar == FALSE){
    die(json_encode(array('mensagem' => 'Erro ao salvar observacao causado por: '. mysqli_error($conexao->conexao), 'situacao' => false)));
}else{
    die(json_encode(array('mensagem' => 'Observação morador salvo com sucesso!!!', 'situacao' => true)));
}
