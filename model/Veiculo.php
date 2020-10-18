<?php

class Veiculo {

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
        return $this->conexao->inserir('veiculo', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('veiculo', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('veiculo', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('veiculo', $this);
    }

    
    function procurar($post) {
        $and = '';
        if (isset($post['codmorador']) && $post['codmorador'] != NULL && $post['codmorador'] != '') {
            $and .= ' and v.codmorador = ' . $post['codmorador'];
        }
        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
            $and .= ' and v.codfuncionario = ' . $post['codfuncionario'];
        }        
     
        if (isset($post['placa']) && $post['placa'] != NULL && $post['placa'] != '') {
            $and .= ' and v.placa = "' . $post['placa']. '"';
        }        
        $sql = 'SELECT v.*, p.nome as funcionario, DATE_FORMAT(v.dtcadastro, "%d/%m/%Y %H:%i") as dtcadastro2  FROM veiculo AS v 
            inner join pessoa as p on p.codpessoa = v.codfuncionario
        WHERE v.codempresa = ' . $_SESSION['codempresa'] . ' and v.placa <> "" '  . $and;
        return $this->conexao->comando($sql);
    }

}
