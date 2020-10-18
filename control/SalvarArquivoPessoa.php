<?php

include './ValidaSessao.php';

include '../model/ArquivoPessoa.php';
$arquivo = new ArquivoPessoa($conexao);

foreach ($_POST as $key => $value) {
    $arquivo->$key = $value;
}

if (!isset($_POST["codmorador"]) || $_POST["codmorador"] == NULL || $_POST["codmorador"] == "") {
    die(json_encode(array('mensagem' => 'Por favor preencha morador!!!', 'situacao' => false)));
}else{
    $arquivo->codpessoa = $_POST["codmorador"];
}

if (isset($_FILES['arquivo'])) {
    if ($_SESSION['codpessoa'] == 6 || $_SESSION['codpessoa'] == 9) {
        $livre_tam = "true";
    } else {
        $livre_tam = NULL;
    }
    $upload = new Upload($_FILES["arquivo"], $livre_tam);
    if ($upload->erro == '') {
        $arquivo->link = $upload->nome_final;
    }else{
        die(json_encode(array('mensagem' => 'Erro ao carregar arquivo causado por: '. $upload->erro, 'situacao' => false)));
    }
}

if (isset($arquivo->codarquivo) && $arquivo->codarquivo != NULL && $arquivo->codarquivo != '') {
    $resSalvar = $arquivo->atualizar();
} else {
    $resSalvar = $arquivo->inserir();
}


if ($resSalvar == FALSE) {
    die(json_encode(array('mensagem' => 'Erro ao salvar arquivo causado por: ' . mysqli_error($conexao->conexao), 'situacao' => false)));
} else {
    die(json_encode(array('mensagem' => 'Arquivo salvo com sucesso!!!', 'situacao' => true)));
}
