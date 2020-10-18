<?php

include './ValidaSessao.php';


include '../model/Bicicleta.php';
$bicicleta = new Bicicleta($conexao);

$msg_retorno = 'Bicicleta salva com sucesso!';

foreach ($_POST as $key => $value) {
    $bicicleta->$key = $value;
}


if(!isset($_POST["nome"]) || $_POST["nome"] == NULL || $_POST["nome"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha nome da bike!!!', 'situacao' => false)));
}
if(!isset($_POST["codmorador"]) || $_POST["codmorador"] == NULL || $_POST["codmorador"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha morador!!!', 'situacao' => false)));
}

if (isset($_FILES['imagem'])) {
    if ($_SESSION['codpessoa'] == 6 || $_SESSION['codpessoa'] == 9) {
        $livre_tam = "true";
    } else {
        $livre_tam = NULL;
    }
    $upload = new Upload($_FILES["imagem"], $livre_tam);
    if ($upload->erro == '') {
        $bicicleta->imagem = $upload->nome_final;
    }else{
        die(json_encode(array('mensagem' => 'Erro ao carregar arquivo causado por: '. $upload->erro, 'situacao' => false)));
    }
}

if (isset($bicicleta->codbicicleta) && $bicicleta->codbicicleta != NULL && $bicicleta->codbicicleta != '') {
    $resSalvar = $bicicleta->atualizar();
} else {
    $resSalvar = $bicicleta->inserir();
}


if($resSalvar == FALSE){
    die(json_encode(array('mensagem' => 'Erro ao salvar bicicleta causado por: '. mysqli_error($conexao->conexao), 'situacao' => false)));
}else{
    die(json_encode(array('mensagem' => 'Bicicleta salvo com sucesso!!!', 'situacao' => true)));
}
