<?php

include "./ValidaSessao.php";

include "../model/Telefone.php";
$telefone = new Telefone($conexao);

$restelefone = $telefone->procurar($_POST);
$qtdtelefone = $conexao->qtdResultado($restelefone);

if ($qtdtelefone > 0) {
   echo json_encode(mysqli_fetch_all($restelefone, MYSQLI_ASSOC)); 
}
   