<?php

class Bloco {

    public $codcategoria;
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
            $this->option = $this->conexao->cache->read('optionbloco');
            if ($this->option == NULL || $this->option == '') {
                $colunas = 'DISTINCT pes.bloco';
                $res = $this->procurar(NULL, $colunas);
                $qtd = $this->conexao->qtdResultado($res);
                if ($qtd > 0) {
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

//    function procurar($post = NULL, $colunas = 'cp.*', $ca = 0) {
//        $and = '';
//        if (isset($post['codcategoria']) && $post['codcategoria'] != NULL && $post['codcategoria'] != '') {
//            $post['codcategoria'] = (int) $post['codcategoria'];
//            if ($post['codcategoria'] > 0) {
//                $and .= " and cp.codcategoria = {$post['codcategoria']}";
//            }
//        }
//        if (isset($post['nome']) && $post['nome'] != NULL && $post['nome'] != '') {
//            $and .= " and cp.nome like '%{$post['nome']}%'";
//        }
//        if (isset($post['data1']) && $post['data1'] != NULL && $post['data1'] != '') {
//            $and .= " and cp.dtcadastro >= '{$post['data1']}'";
//        }
//        if (isset($post['data2']) && $post['data2'] != NULL && $post['data2'] != '') {
//            $and .= " and cp.dtcadastro <= '{$post['data2']} 23:59:59'";
//        }
//        if (isset($post['cadastrado_por']) && $post['cadastrado_por'] != NULL && $post['cadastrado_por'] != '') {
//            $and .= " and cp.cadastrado_por = {$post['cadastrado_por']}";
//        }
//
//        $sql = "SELECT SQL_CACHE {$colunas} FROM categoriapessoa AS cp WHERE 1 = 1 {$and}";

//        if ($ca) {
//            return $this->conexao->comandoArray($sql);
//        } else {
//            return $this->conexao->comando($sql);
//        }
//    }
    
    function procurar($post, $colunas = 'pes.*', $ca = 0) {
        $and = '';

        $sql = 'SELECT ' . $colunas . ' FROM pessoa AS pes WHERE pes.codempresa = ' . $_SESSION['codempresa'] . ' and bloco <> "" '  . $and;

        if ($ca) {
            return $this->conexao->comandoArray($sql);
        } else {
            return $this->conexao->comando($sql);
        }
    }

}
