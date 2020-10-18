<?php

include '../ValidaSessao.php';

$pessoa = new Pessoa($conexao);
$res = $pessoa->procurar($_POST);
echo json_encode(mysqli_fetch_all($res, MYSQLI_ASSOC)); 
