<?php

print_r($_FILES);
die();

include '../ValidaSessao.php';

$pessoa = new Pessoa($conexao);

$msg_retorno = 'Pessoa salva com sucesso!';
$sit_retorno = 'success';

foreach ($_POST as $key => $value) {
    $pessoa->$key = $value;
}

if (isset($pessoa->codpessoa) && $pessoa->codpessoa != NULL && $pessoa->codpessoa != '') {
    if (!$pessoa->atualizar()) {
        $msg_retorno = 'Erro ao atualizar pessoa! Causado por:' . mysqli_error($conexao->conexao);
        $sit_retorno = 'error';
    } else {
        $conexao->cache->save('procurarPessoa', '');
        $msg_retorno = 'Pessoa atualizada com sucesso!';
    }
} else {
    if (!$pessoa->inserir()) {
        $msg_retorno = 'Erro ao salvar pessoa! Causado por:' . mysqli_error($conexao->conexao);
        $sit_retorno = 'error';
    } /*else
        $pessoa->codpessoa = mysqli_insert_id($conexao->conexao);*/
}

die(json_encode(array('mensagem' => $msg_retorno, 'situacao' => $sit_retorno)));