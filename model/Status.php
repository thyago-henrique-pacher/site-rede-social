<?php

class Status {

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
        return $this->conexao->inserir('categoriapessoa', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('categoriapessoa', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('categoriapessoa', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('categoriapessoa', $this);
    }

    /** se for usar cache não passar codigo para selected */
    public function option() {
        if ($this->option == '') {
            $this->option = $this->conexao->cache->read('optionstatus');
            if ($this->option == NULL || $this->option == '') {
                $colunas = 'DISTINCT pes.status';
                $res = $this->procurar(NULL, $colunas);
                $qtd = $this->conexao->qtdResultado($res);
                if ($qtd > 0) {
                    $this->option .= '<option value="">--Selecione--</option>';
                    while ($statusp = $this->conexao->resultadoArray($res)) {
                        $status = ($statusp["status"] == 'a') ? 'Ativo' : 'Novo';
                        $this->option .= '<option value="' . $statusp["status"] . '">' . $status . '</option>';
                    }
                } else {
                    $this->option .= '<option value="">--Nada encontrado--</option>';
                }
                $this->conexao->cache->save('optionstatus', $this->option);
            }
        }
        return $this->option;
    }

    
    function procurar($post, $colunas = 'pes.*') {

        $sql = 'SELECT ' . $colunas . ' FROM pessoa AS pes WHERE pes.codempresa = ' . $_SESSION['codempresa'] . ' '  . $and;
        return $this->conexao->comando($sql);
    }

}
