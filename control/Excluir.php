<?php

include './ValidaSessao.php';

if (!isset($_POST["tabela"]) || $_POST["tabela"] == NULL || $_POST["tabela"] == "") {
    die(json_encode(array('mensagem' => 'Por favor preencha tabela!!!', 'situacao' => false)));
}
$and = "";
foreach ($_POST as $key => $value) {
    if ($key != "tabela") {
        $$key = $value;
        $and = " and $key = $value";
    }
}

if ($and != "") {
    $sql = "delete from {$_POST["tabela"]} where codempresa = {$_SESSION["codempresa"]} {$and}";
    $resSalvar = $conexao->comando($sql);
}

if ($resSalvar == FALSE) {
    die(json_encode(array('mensagem' => 'Erro ao excluir causado por: ' . mysqli_error($conexao->conexao), 'situacao' => false)));
} else {
    die(json_encode(array('mensagem' => 'Excluido com sucesso!!!', 'situacao' => true)));
}
