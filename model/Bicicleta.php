<?php

class Bicicleta {

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
        return $this->conexao->inserir('bicicleta', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('bicicleta', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('bicicleta', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('bicicleta', $this);
    }

    
    function procurar($post) {
        $and = '';
        if (isset($post['codmorador']) && $post['codmorador'] != NULL && $post['codmorador'] != '') {
            $and .= ' and b.codmorador = ' . $post['codmorador'];
        }
        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
            $and .= ' and b.codfuncionario = ' . $post['codfuncionario'];
        }        
        if (isset($post['localizacao']) && $post['localizacao'] != NULL && $post['localizacao'] != '') {
            $and .= ' and b.localizacao = "' . $post['localizacao']. '"';
        }        
        if (isset($post['nome']) && $post['nome'] != NULL && $post['nome'] != '') {
            $and .= ' and b.nome = "' . $post['nome']. '"';
        }        
        $sql = 'SELECT b.*, p.nome as funcionario, 
            DATE_FORMAT(b.dtcadastro, "%d/%m/%y %h:%i") as dtcadastro2
            FROM bicicleta AS b 
            inner join pessoa as p on p.codpessoa = b.codfuncionario
        WHERE b.codempresa = ' . $_SESSION['codempresa'] . ' '  . $and;

        return $this->conexao->comando($sql);
    }

}
