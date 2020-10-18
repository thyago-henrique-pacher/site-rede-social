<?php

include './ValidaSessao.php';

include '../model/Atestado.php';
$atestado = new Atestado($conexao);

foreach ($_POST as $key => $value) {
    $atestado->$key = $value;
}

if (isset($_FILES['arquivo'])) {
    if ($_SESSION['codpessoa'] == 6 || $_SESSION['codpessoa'] == 9) {
        $livre_tam = "true";
    } else {
        $livre_tam = NULL;
    }
    $upload = new Upload($_FILES["arquivo"], $livre_tam);
    if ($upload->erro == '') {
        $atestado->arquivo = $upload->nome_final;
    }else{
        die(json_encode(array('mensagem' => 'Erro ao carregar arquivo causado por: '. $upload->erro, 'situacao' => false)));
    }
}

if(!isset($_POST["dtvencimento"]) || $_POST["dtvencimento"] == NULL || $_POST["dtvencimento"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha dt. vencimento!!!', 'situacao' => false)));
}
if(!isset($_POST["codmorador"]) || $_POST["codmorador"] == NULL || $_POST["codmorador"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencha morador!!!', 'situacao' => false)));
}

if (isset($atestado->codatestado) && $atestado->codatestado != NULL && $atestado->codatestado != '') {
    $resSalvar = $atestado->atualizar();
} else {
    $resSalvar = $atestado->inserir();
}


if($resSalvar == FALSE){
    die(json_encode(array('mensagem' => 'Erro ao salvar atestado causado por: '. mysqli_error($conexao->conexao), 'situacao' => false)));
}else{
    die(json_encode(array('mensagem' => 'Atestado salvo com sucesso!!!', 'situacao' => true)));
}
