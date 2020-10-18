<?php

include "./ValidaSessao.php";

include "../model/Bicicleta.php";
$bicicleta = new Bicicleta($conexao);

$resbicicleta = $bicicleta->procurar($_POST);
$qtdbicicleta = $conexao->qtdResultado($resbicicleta);

if ($qtdbicicleta > 0) {
   echo json_encode(mysqli_fetch_all($resbicicleta, MYSQLI_ASSOC)); 
}
   