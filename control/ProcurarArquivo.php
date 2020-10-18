<?php

session_start();
//validação caso a sessão caia
if (!isset($_SESSION["codpessoa"]) || $_SESSION["codpessoa"] == NULL || $_SESSION["codpessoa"] == "") {
    die("<script>alert('Sua sessão caiu, por favor logue novamente!!!');window.close();</script>");
}

include "../model/Conexao.php";
$conexao = new Conexao();

include "../model/ArquivoPessoa.php";
$arquivo = new ArquivoPessoa($conexao);

$resarquivo = $arquivo->procurar($_POST);
$qtdarquivo = $conexao->qtdResultado($resarquivo);

if ($qtdarquivo > 0) {
   echo json_encode(mysqli_fetch_all($resarquivo, MYSQLI_ASSOC)); 
}
   