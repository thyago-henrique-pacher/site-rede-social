<?php

/*
 * @author Thyago Henrique Pacher - thyago.pacher@gmail.com
 */

date_default_timezone_set('America/Sao_Paulo');

include 'Cache.php';

class Conexao {

    public $host = '31.220.109.52';
    public $usuario = 'root';
    public $senha = 'Brasil1602*';
    public $banco = 'sistema';
    public $porta = '3306';
    private $resultado;
    public $conexao;
    public $cache;
    public $nivelp;
    public $hoje;

    function __construct($usuario = null, $senha = null, $enderecoip = null, $banco = null) {
        if (isset($usuario) && $usuario != NULL && $usuario != "") {
            $this->banco = $banco;
            $this->host = $enderecoip;
            $this->usuario = $usuario;
            $this->senha = $senha;
        }
        if (!isset($this->cache) && $this->cache == NULL)
            $this->cache = new Cache();
        if (!isset($this->hoje) && $this->hoje == NULL)
            $this->hoje = date('Y-m-d');;
        $this->conectar();
    }

    function __destruct() {
        if ($this->conexao != FALSE) {
            mysqli_close($this->conexao);
        }
        if (isset($this->resultado) && $this->resultado != NULL)
            mysqli_free_result($this->resultado);
        unset($this->resultado);
    }

    public function conectar() {
        $this->conexao = mysqli_init();
        mysqli_real_connect($this->conexao, $this->host, $this->usuario, $this->senha, $this->banco, 3306, NULL, MYSQLI_CLIENT_COMPRESS);
        if (!$this->conexao) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        mysqli_set_charset($this->conexao, 'utf8');
    }

    function get_include_contents($filename) {
        if (is_file($filename)) {
            ob_start();
            include $filename;
            return ob_get_clean();
        }
        return false;
    }

    function setPermissoes($codnivel, $page) {
        $sql = 'SELECT SQL_CACHE np.*, pgn.nome AS pagina, mdl.nome AS modulo, pgn.link AS link
        FROM nivel_pagina AS np
        INNER JOIN pagina AS pgn ON pgn.codpagina = np.codpagina
        INNER JOIN modulo AS mdl ON mdl.codmodulo = pgn.codmodulo
        WHERE np.codnivel = ' . $codnivel . ' AND pgn.link = "' . $page . '"';

        $this->nivelp = $this->comandoArray($sql);
    }

    public function trataString($valor) {
        return mysqli_escape_string($this->conexao, $valor);
    }

    /* retorna mysql_query */

    public function comando($query) {
        $this->resultado = mysqli_query($this->conexao, $query);
        return $this->resultado;
    }

    public function comandoArray($query) {
        return mysqli_fetch_array(mysqli_query($this->conexao, $query), MYSQLI_ASSOC);
    }

    public function comandoArrayAssoc($query) {
        $resultado = $this->comando($query);
        return mysqli_fetch_assoc($resultado);
    }

    /*     * retorna a quantidade de resultados da consulta */

    public function qtdResultado($resultado = NULL) {
        if ($resultado == NULL) {
            $resultado = $this->resultado;
        }
        return mysqli_num_rows($resultado);
    }

    public function resultadoArray($resultado = null) {
        if ($resultado == NULL) {
            $resultado = $this->resultado;
        }
        return mysqli_fetch_array($resultado);
    }

    public function verificaAtividadeUsuario() {
        if (isset($_SESSION['codpessoa']) && $_SESSION['codpessoa'] != NULL && $_SESSION['codpessoa'] != '') {
            mysqli_real_query($this->conexao, 'update acesso set ultimaacao = "' . date('Y-m-d H:i:s') . '", dtsaida = "" where codpessoa = ' . $_SESSION['codpessoa'] . ' and codempresa = ' . $_SESSION['codempresa'] . ' and data = CURRENT_DATE()');
        }
    }

    /**
     * é enviar dados pendentes ou realizar tarefas de limpeza. Além disso, a função é útil se tiver objetos muito grandes que não precisem ser completamente salvos.
     */
    public function __sleep() {
        return array('host', 'usuario', 'senha', 'banco', 'porta');
    }

    /**
     * é reestabelecer qualquer conexão com banco de dados que podem ter sido perdidas durante a serialização, e realizar outras tarefas de reinicialização.
     */
    public function __wakeup() {
        $this->conectar();
    }

    public function inserir($tabela, $objeto) {
        $valores = '';
        $campos = '';
        $res = $this->comando('DESC ' . $tabela);
        if ($this->qtdResultado($res) > 0) {
            while ($campo = $this->resultadoArray($res)) {
                $campoNome = $campo['Field'];
                $campoChave = $campo['Key'];
                if ($campoChave != 'PRI' && isset($campoNome) && isset($objeto->$campoNome) && $objeto->$campoNome != NULL && $objeto->$campoNome != '') {
                    $objeto->$campoNome = addslashes($objeto->$campoNome);
                    $campos .= "{$campoNome},";
                    if ($campo['Type'] === 'text') {
                        $valores .= '"' . $objeto->$campoNome . '",';
                    } elseif ($campo['Type'] === 'date' && strpos($campo['Type'], '/')) {
                        $valores .= '"' . implode('-', array_reverse(explode('/', $objeto->$campoNome))) . '",';
                    } elseif ($campo['Type'] === 'double' && strpos($objeto->$campoNome, ',')) {
                        $valores .= '"' . str_replace(',', '.', $objeto->$campoNome) . '",';
                    } elseif ($campo['Type'] == "int(11)") {
                        $valores .= '"' . (int) $objeto->$campoNome . '",';
                    } elseif ($campoNome == "codempresa" && ($objeto->$campoNome == NULL || $objeto->$campoNome == "")) {
                        $valores .= '"' . (int) $_SESSION["codempresa"] . '",';
                    } elseif ($campoNome == "codfuncionario" && ($objeto->$campoNome == NULL || $objeto->$campoNome == "")) {
                        $valores .= '"' . (int) $_SESSION["codpessoa"] . '",';
                    } else {
                        $valores .= '"' . $objeto->$campoNome . '",';
                    }
                }
            }
        }

        $sql = 'insert into ' . $tabela . '(' . substr($campos, 0, strlen(trim($campos)) - 1) . ') values(' . substr($valores, 0, strlen(trim($valores)) - 1) . ')';
        $resInserir = mysqli_real_query($this->conexao, $sql);
        $this->verificaAtividadeUsuario();
        return $resInserir;
    }

    public function atualizar($tabela, $objeto) {
        $setar = '';
        $where = '';
        $chavePrimaria = 0;
        $res = $this->comando('DESC ' . $tabela);
        if ($this->qtdResultado($res) > 0) {
            while ($campo = $this->resultadoArray($res)) {
                $campoNome = $campo['Field'];
                $campoChave = $campo['Key'];
                if ($campoChave != 'PRI' && isset($objeto->$campoNome) && $objeto->$campoNome != NULL && trim($objeto->$campoNome) != '') {
                    $objeto->$campoNome = addslashes($objeto->$campoNome);
                    if ($campo['Type'] === 'text') {
                        $setar .= $campoNome . ' = "' . $objeto->$campoNome . '", ';
                    } elseif ($campo['Type'] === 'date' && strpos($campo['Type'], '/')) {
                        $setar .= $campoNome . ' = "' . implode('-', array_reverse(explode('/', $objeto->$campoNome))) . '", ';
                    } elseif ($campo['Type'] === 'double' && strpos($objeto->$campoNome, ',')) {
                        $setar .= $campoNome . ' = "' . (double) str_replace(',', '.', $objeto->$campoNome) . '", ';
                    } elseif ($campo['Type'] == "int(11)") {
                        $setar .= $campoNome . ' = "' . (int) $objeto->$campoNome . '", ';
                    } else {
                        $setar .= $campoNome . ' = "' . $objeto->$campoNome . '", ';
                    }
                } elseif ($campoChave === 'PRI') {
                    $chavePrimaria = $objeto->$campoNome;
                    $where .= $campoNome . ' = "' . $objeto->$campoNome . '"';
                }
            }
        }

        $sql = 'update ' . $tabela . ' set ' . substr($setar, 0, strlen(trim($setar)) - 1) . ' where ' . $where;
        $this->verificaAtividadeUsuario();
        return mysqli_real_query($this->conexao, $sql);
    }

    public function excluir($tabela, $objeto) {
        $where = '';
        $res = $this->comando('DESC ' . $tabela);
        $chavePrimaria = 0;
        if ($this->qtdResultado($res) > 0) {
            while ($campo = $this->resultadoArray($res)) {
                $campoNome = $campo['Field'];
                $campoChave = $campo['Key'];
                if ($campoChave == 'PRI') {
                    $chavePrimaria = $objeto->$campoNome;
                    $where .= $campoNome . '= "' . $objeto->$campoNome . '"';
                    break;
                }
            }
        }

        $sql = 'delete from ' . $tabela . ' where ' . $where;
        $this->verificaAtividadeUsuario();
        return mysqli_real_query($this->conexao, $sql);
    }

    public function excluirMultiplos($tabela, $post) {
        if (isset($post) && $post != NULL && $tabela != "") {
            $where = '';
            foreach ($post as $key => $value) {
                $where .= " $key";
                $array_par = implode(",", $post[$key]);
                $array_par = str_replace(',', '","', $array_par);
                if ($array_par != NULL && $array_par != "") {
                    $where .= ' in ("' . $array_par . '")';
                }
                break;
            }

            if (isset($where) && $where != NULL && $where != "") {
                $sql = 'delete from ' . $tabela . ' where ' . $where;
                $this->verificaAtividadeUsuario();
                return mysqli_real_query($this->conexao, $sql);
            }
        }
    }

    public function procurarCodigo($tabela, $objeto) {
        $where = '';
        $res = $this->comando('DESC ' . $tabela);
        $qtdTabela = $this->qtdResultado($res);
        if ($qtdTabela > 0) {
            while ($campo = $this->resultadoArray($res)) {
                $campoNome = $campo['Field'];
                $campoChave = $campo['Key'];
                if ($campoChave == 'PRI') {
                    $where .= $campoNome . '= "' . $objeto[$campoNome] . '"';
                    break;
                }
            }
        }
        $sql = 'select * from ' . $tabela . ' where ' . $where;
        $this->verificaAtividadeUsuario();
        return $this->comandoArray($sql);
    }

    public function trocaStatus($status) {
        if ($status == "a") {
            $status = "Ativo";
        } elseif ($status == "i") {
            $status = "Inativo";
        } elseif ($status == "n") {
            $status = "Novo";
        }
        return $status;
    }

    public function trocaSimNao($valor) {
        return ($valor == "s") ? "Sim" : "Não";
    }

}
