<?php
header('Content-type: text/html; charset=utf-8');
session_start();

if ((!isset($_SESSION["codpessoa"]) || $_SESSION["codpessoa"] == NULL || $_SESSION["codpessoa"] == "")) {
    die("<script>alert('Sua sessão caiu, por favor se logue novamente!');location.href='/';</script>");
}

spl_autoload_register(function ($class_name) {
    if (file_exists('../../model/' . $class_name . '.php')) {        
        include '../../model/' . $class_name . '.php';
    } elseif (file_exists('./model/' . $class_name . '.php')) {        
        include './model/' . $class_name . '.php';
    } elseif (file_exists('../model/' . $class_name . '.php')) {        
        include '../model/' . $class_name . '.php';
    } elseif (file_exists('' . $class_name . '.php')) {        
        include '' . $class_name . '.php';
    } elseif (file_exists('model/' . $class_name . '.php')) {        
        include 'model/' . $class_name . '.php';
    } elseif (file_exists('../' . $class_name . '.php')) {        
        include '../' . $class_name . '.php';
    }
});

$conexao = new Conexao();