<?php

class Atestado {

    public $codcategoria;
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
        return $this->conexao->inserir('atestado', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('atestado', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('atestado', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('atestado', $this);
    }

    
    function procurar($post) {
        $and = '';
        if (isset($post['codmorador']) && $post['codmorador'] != NULL && $post['codmorador'] != '') {
            $and .= ' and a.codmorador = ' . $post['codmorador'];
        }
        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
            $and .= ' and a.codfuncionario = ' . $post['codfuncionario'];
        }        

        $sql = 'SELECT a.*, p.nome as funcionario, DATE_FORMAT(a.dtcadastro, "%d/%m/%Y %H:%i") as dtcadastro2, 
            DATE_FORMAT(a.dtvencimento, "%d/%m/%Y %H:%i") as dtvencimento2 
            FROM atestado AS a 
            inner join pessoa as p on p.codpessoa = a.codfuncionario
        WHERE a.codempresa = ' . $_SESSION['codempresa'] . ' '  . $and;
   
        return $this->conexao->comando($sql);
    }

}
