<?php

class Telefone {

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
        return $this->conexao->inserir('telefone', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('telefone', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('telefone', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('telefone', $this);
    }

    
    function procurar($post) {
        $and = '';
        if (isset($post['codpessoa']) && $post['codpessoa'] != NULL && $post['codpessoa'] != '') {
            $and .= ' and t.codpessoa = ' . $post['codpessoa'];
        }
        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
            $and .= ' and t.codfuncionario = ' . $post['codfuncionario'];
        }        
        if (isset($post['numero']) && $post['numero'] != NULL && $post['numero'] != '') {
            $and .= ' and t.numero = "' . $post['numero']. '"';
        }           
        $sql = 'SELECT t.*, p.nome as funcionario, DATE_FORMAT(t.dtcadastro, "%d/%m/%Y %H:%i") as dtcadastro2 
            FROM telefone AS t 
            inner join pessoa as p on p.codpessoa = t.codfuncionario
        WHERE t.codempresa = ' . $_SESSION['codempresa'] . $and;
        return $this->conexao->comando($sql);
    }

}
