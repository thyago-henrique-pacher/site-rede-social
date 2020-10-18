<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

session_start();

$_SESSION['codempresa'] = 29;

include '../model/Conexao.php';
$model = trim($_POST["model"]);
if (file_exists('../model/' . $model . '.php')) {
    include '../model/' . $model . '.php';
}
$conexao = new Conexao();
$model = new $model($conexao);
if (isset($model->option)) {
    if ($model->option != '') {
        echo $model->option;
    } else {
        $codnivel = 0;
        if (isset($_POST["codnivel"]) && $_POST["codnivel"] > 0) {
            $codnivel = $_POST["codnivel"];
        }
        echo $model->option($codnivel);
    }
}