<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
include "./ValidaSessao.php";

include "../model/ObservacaoMorador.php";
$observacao = new ObservacaoMorador($conexao);

$resobservacao = $observacao->procurar($_POST);
$qtdobservacao = $conexao->qtdResultado($resobservacao);

if ($qtdobservacao > 0) {
   echo json_encode(mysqli_fetch_all($resobservacao, MYSQLI_ASSOC)); 
}else{
    echo "";
}
   