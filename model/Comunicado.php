<?php

class Comunicado {

    public $codcomunicado;
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
        return $this->conexao->inserir('comunicado', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('comunicado', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('comunicado', $this);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('comunicado', $this);
    }

    /** se for usar cache não passar codigo para selected */
    public function option() {
        if ($this->option == '') {
            $this->option = $this->conexao->cache->read('optioncomunicado');
            if ($this->option == NULL || $this->option == '') {
                $colunas = 'DISTINCT cmd.codcomunicado, cmd.nome';
                $res = $this->procurar(NULL, $colunas);
                $qtd = $this->conexao->qtdResultado($res);
                if ($qtd > 0) {
                    $this->option .= '<option value="">--Selecione--</option>';
                    while ($comunicadop = $this->conexao->resultadoArray($res)) {
                        $this->option .= '<option value="' . $comunicadop["codcomunicado"] . '">' . $comunicadop["nome"] . '</option>';
                    }
                } else {
                    $this->option .= '<option value="">--Nada encontrado--</option>';
                }
                $this->conexao->cache->save('optioncomunicado', $this->option);
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
//        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
//            $and .= " and cp.codfuncionario = {$post['codfuncionario']}";
//        }
//
//        $sql = "SELECT SQL_CACHE {$colunas} FROM comunicado AS cp WHERE 1 = 1 {$and}";

//        if ($ca) {
//            return $this->conexao->comandoArray($sql);
//        } else {
//            return $this->conexao->comando($sql);
//        }
//    }
    
    function procurar($post, $colunas = 'cmd.*') {

        $sql = 'SELECT ' . $colunas . ' FROM comunicado AS cmd WHERE cmd.codempresa = ' . $_SESSION['codempresa'] . ' '  . $and;
        
        if ($ca) {
            return $this->conexao->comandoArray($sql);
        } else {
            return $this->conexao->comando($sql);
        }
    }

}
