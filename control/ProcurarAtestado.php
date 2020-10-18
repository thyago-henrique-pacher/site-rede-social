<?php

include "./ValidaSessao.php";

include "../model/Atestado.php";
$atestado = new Atestado($conexao);

$resatestado = $atestado->procurar($_POST);
$qtdatestado = $conexao->qtdResultado($resatestado);

if ($qtdatestado > 0) {
   echo json_encode(mysqli_fetch_all($resatestado, MYSQLI_ASSOC)); 
}
   