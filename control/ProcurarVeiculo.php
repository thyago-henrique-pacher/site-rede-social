<?php

include "./ValidaSessao.php";

include "../model/Veiculo.php";
$veiculo = new Veiculo($conexao);

$resveiculo = $veiculo->procurar($_POST);
$qtdveiculo = $conexao->qtdResultado($resveiculo);

if ($qtdveiculo > 0) {
   echo json_encode(mysqli_fetch_all($resveiculo, MYSQLI_ASSOC)); 
}
   