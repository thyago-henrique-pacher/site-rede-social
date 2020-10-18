<?php

class ObservacaoMorador {

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
        return $this->conexao->inserir('observacaomorador', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('observacaomorador', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('observacaomorador', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('observacaomorador', $this);
    }

    /** se for usar cache não passar codigo para selected */
    public function option() {
        if ($this->option == '') {
            $this->option = $this->conexao->cache->read('optionbloco');
            if ($this->option == NULL || $this->option == '') {
                $colunas = 'DISTINCT pes.bloco';
                $res = $this->procurar(NULL, $colunas);
                $qtd = $this->conexao->qtdResultado($res);
                if ($qtd > 0) {
                    $this->option .= '<option value="">--Selecione--</option>';
                    while ($blocop = $this->conexao->resultadoArray($res)) {
                        $this->option .= '<option value="' . $blocop["bloco"] . '">' . $blocop["bloco"] . '</option>';
                    }
                } else {
                    $this->option .= '<option value="">--Nada encontrado--</option>';
                }
                $this->conexao->cache->save('optionbloco', $this->option);
            }
        }
        return $this->option;
    }

    function procurar($post){
        $and = '';
        if (isset($post['codmorador']) && $post['codmorador'] != NULL && $post['codmorador'] != '') {
            $and .= ' and o.codmorador = ' . $post['codmorador'];
        }
        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
            $and .= ' and o.codfuncionario = ' . $post['codfuncionario'];
        }        

        $sql = 'SELECT distinct o.texto, o.dtcadastro, DATE_FORMAT(o.dtcadastro, "%d/%m/%y %h:%i") as dtcadastro2, func.nome as funcionario, o.codobservacao 
        FROM observacaomorador AS o
        INNER JOIN pessoa AS func ON func.codpessoa = o.codfuncionario 
        WHERE o.codempresa = ' . $_SESSION['codempresa']  . $and;
 
        return $this->conexao->comando($sql);
    }

}
