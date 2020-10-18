<?php

include "./ValidaSessao.php";

if(!isset($_POST["tabela"]) || $_POST["tabela"] == NULL || $_POST["tabela"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencher tabela', 'situacao' => false)));
}
if(!isset($_POST["codigo"]) || $_POST["codigo"] == NULL || $_POST["codigo"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencher codigo', 'situacao' => false)));
}
if(!isset($_POST["campo"]) || $_POST["campo"] == NULL || $_POST["campo"] == ""){
    die(json_encode(array('mensagem' => 'Por favor preencher campo', 'situacao' => false)));
}

$res = $conexao->comandoArray("select * from {$_POST["tabela"]} where {$_POST["campo"]} = {$_POST["codigo"]}");
echo json_encode($res);