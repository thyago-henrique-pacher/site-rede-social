<?php

class Nivel {

    public $codnivel;
    public $codfuncionario;
    public $nome;
    public $dtcadastro;
    public $option = '';
    private $conexao;

    public function __construct($conexao) {
        if (!isset($this->cadastrado_por) || $this->cadastrado_por == NULL || $this->cadastrado_por == '') {
            $this->cadastrado_por = $_SESSION['codpessoa'];
        }
        if (!isset($this->codempresa) || $this->codempresa == NULL || $this->codempresa == '') {
            $this->codempresa = $_SESSION['codempresa'];
        }
        $this->dtatualizacao = date('Y-m-d H:i:s');
        $this->conexao = $conexao;
    }

    public function inserir() {
        return $this->conexao->inserir('nivel', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('nivel', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('nivel', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('nivel', $this);
    }

    /** se for usar cache não passar codigo para selected */
    public function option() {
        $res = $this->procurar();
        $qtd = $this->conexao->qtdResultado($res);
        if ($qtd > 0) {
            while ($nivelp = $this->conexao->resultadoArray($res)) {
                $this->option .= '<option value="' . $nivelp["codnivel"] . '">' . $nivelp["nome"] . '</option>';
            }
        } else {
            $this->option .= '<option value="">--Nada encontrado--</option>';
        }
        return $this->option;
    }

    function procurar($post = NULL, $colunas = 'nvl.*') {

        $sql = 'SELECT nvl.* FROM nivel AS nvl WHERE nvl.codempresa = ' . $_SESSION['codempresa'];
        return $this->conexao->comando($sql);
    }

}
