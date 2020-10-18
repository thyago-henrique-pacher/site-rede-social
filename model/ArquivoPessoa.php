<?php

class ArquivoPessoa {

    public $codmorador;
    public $codfuncionario;
    public $nome;
    public $dtcadastro;
    public $option = '';
    private $conexao;

    public function __construct($conexao) {
        if (!isset($this->codfuncionario) || $this->codfuncionario == NULL || $this->codfuncionario == '') {
            $this->codfuncionario = $_SESSION['codpessoa'];
        }
        if (!isset($this->codempresa) || $this->codempresa == NULL || $this->codempresa == '') {
            $this->codempresa = $_SESSION['codempresa'];
        }
        $this->dtatualizacao = date('Y-m-d H:i:s');
        $this->conexao = $conexao;
    }

    public function inserir() {
        return $this->conexao->inserir('arquivopessoa', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('arquivopessoa', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('arquivopessoa', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('arquivopessoa', $this);
    }

    function procurar($post){
        $and = '';
        if (isset($post['codmorador']) && $post['codmorador'] != NULL && $post['codmorador'] != '') {
            $and .= ' and a.codpessoa = ' . $post['codmorador'];
        }
        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
            $and .= ' and a.codfuncionario = ' . $post['codfuncionario'];
        }        

        $sql = 'SELECT distinct a.*, a.dtcadastro, DATE_FORMAT(a.dtcadastro, "%d/%m/%y %h:%i") as dtcadastro2, func.nome as funcionario 
        FROM arquivopessoa AS a
        INNER JOIN pessoa AS func ON func.codpessoa = a.codfuncionario 
        WHERE a.codempresa = ' . $_SESSION['codempresa']  . $and;

        return $this->conexao->comando($sql);
    }

}
