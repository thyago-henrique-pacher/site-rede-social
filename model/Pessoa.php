<?php

class Pessoa {

    public $codpessoa;
    public $codempresa;
    public $codcategoria;
    public $codnivel;
    public $codfuncionario;
    public $nome;
    public $cpf;
    public $rg;
    public $dtnascimento;
    public $dtcadastro;
    public $option = '';
    private $conexao;

    public function __construct($conexao) {
        if ((!isset($this->cadastrado_por) || $this->cadastrado_por == NULL || $this->cadastrado_por == '') &&
                isset($_SESSION['codpessoa']) && $_SESSION['codpessoa'] != NULL && $_SESSION['codpessoa'] != '') {
            $this->cadastrado_por = $_SESSION['codpessoa'];
        }
        if ((!isset($this->codempresa) || $this->codempresa == NULL || $this->codempresa == '') &&
                isset($_SESSION['codempresa']) && $_SESSION['codempresa'] != NULL && $_SESSION['codempresa'] != '') {
            $this->codempresa = $_SESSION['codempresa'];
        }
        $this->dtatualizacao = date('Y-m-d H:i:s');
        $this->conexao = $conexao;
    }

    public function inserir() {
        return $this->conexao->inserir('pessoa', $this);
    }

    public function atualizar() {
        return $this->conexao->atualizar('pessoa', $this);
    }

    public function excluir() {
        return $this->conexao->excluir('pessoa', $this);
    }

    public function excluirMultiplos($post) {
        return $this->conexao->excluirMultiplos('pessoa', $post);
    }

    public function procuraCodigo() {
        return $this->conexao->procurarCodigo('pessoa', $this);
    }

    /** se for usar cache não passar codigo para selected */
    public function option() {
        $this->option = '';
        if ($this->option == '') {
            $this->conexao->cache->save('optionpessoa', $this->option);
            $this->option = $this->conexao->cache->read('optionpessoa');
            if ($this->option == NULL || $this->option == '') {
                $colunas = 'DISTINCT pes.nome, pes.codpessoa, pes.bloco, pes.apartamento';
                $post['status'] = 'a';
                $post['orderby'] = 'nome';
                $res = $this->procurar($post, $colunas);
                $qtd = $this->conexao->qtdResultado($res);
                if ($qtd > 0) {
                    while ($pessoap = $this->conexao->resultadoArray($res)) {
                        $this->option .= '<option class="bloco' . $pessoap['bloco'] . ' apartamento' . $pessoap['apartamento'] . '" value="' . $pessoap["codpessoa"] . '">' . $pessoap["nome"] . '</option>';
                    }
                } else {
                    $this->option .= '<option value="">--Nada encontrado--</option>';
                }
                $this->conexao->cache->save('optionpessoa', $this->option);
            }
        }
        return $this->option;
    }

    function procurar($post, $colunas = 'pes.*') {
        $and = '';
        if (isset($post['codpessoa']) && $post['codpessoa'] != NULL && $post['codpessoa'] != '') {
            $post['codpessoa'] = (int) $post['codpessoa'];
            if ($post['codpessoa'] > 0) {
                $and .= " and pes.codpessoa = {$post['codpessoa']}";
            }
        }
        if (isset($post['tipopessoa']) && $post['tipopessoa'] != NULL && $post['tipopessoa'] == 'f') {
            $and .= " and pes.codnivel not in (select codnivel from nivel where codempresa = {$_SESSION["codempresa"]} and nome = 'Morador')";
        }elseif (isset($post['tipopessoa']) && $post['tipopessoa'] != NULL && $post['tipopessoa'] == 'm') {
            $and .= " and pes.codnivel in (select codnivel from nivel where codempresa = {$_SESSION["codempresa"]} and nome = 'Morador')";
        }
        
        if (isset($post['codempresa']) && $post['codempresa'] != NULL && $post['codempresa'] != '') {
            $and .= ' and pes.codempresa = ' . $post['codempresa'];
        }
        if (isset($post['codcategoria']) && $post['codcategoria'] != NULL && sizeof($post['codcategoria']) > 0) {
            $array_par = implode(",", $post['codcategoria']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and pes.codcategoria in ("' . $array_par . '")';
            }
        }
        if (isset($post['codfuncionario']) && $post['codfuncionario'] != NULL && $post['codfuncionario'] != '') {
            $and .= ' and pes.codfuncionario = ' . $post['codfuncionario'];
        }
        if (isset($post['bloco']) && $post['bloco'] != NULL && sizeof($post['bloco']) > 0) {
            $array_par = implode(",", $post['bloco']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and pes.bloco in ("' . $array_par . '")';
            }
        }
        if (isset($post['apartamento']) && $post['apartamento'] != NULL && sizeof($post['apartamento']) > 0) {
            $array_par = implode(",", $post['apartamento']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and pes.apartamento in ("' . $array_par . '")';
            }
        }
        if (isset($post['codmorador']) && $post['codmorador'] != NULL && sizeof($post['codmorador']) > 0) {
            $array_par = implode(",", $post['codmorador']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and pes.codpessoa in ("' . $array_par . '")';
            }
        }
        if (isset($post['codnivel']) && $post['codnivel'] != NULL && sizeof($post['codnivel']) > 0) {
            $array_par = implode(",", $post['codnivel']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and pes.codnivel in ("' . $array_par . '")';
            }
        }
        if (isset($post['nome']) && $post['nome'] != NULL && $post['nome'] != '') {
            $and .= ' and pes.pes.nome like "%' . $post['nome'] . '%"';
        }
        if (isset($post['cpf']) && $post['cpf'] != NULL && $post['cpf'] != '') {
            $and .= ' and pes.cpf like "%' . $post['cpf'] . '%"';
        }
        if (isset($post['rg']) && $post['rg'] != NULL && $post['rg'] != '') {
            $and .= ' and pes.rg like "%' . $post['rg'] . '%"';
        }
        if (isset($post['dtnascimento']) && $post['dtnascimento'] != NULL && $post['dtnascimento'] != '') {
            $and .= ' and pes.dtnascimento = ' . $post['dtnascimento'];
        }
        if (isset($post['data1']) && $post['data1'] != NULL && $post['data1'] != '') {
            $and .= ' and pes.dtcadastro >= ' . $post['data1'];
        }
        if (isset($post['data2']) && $post['data2'] != NULL && $post['data2'] != '') {
            $and .= ' and pes.dtcadastro <= "' . $post['data2'] . ' 23:59:59"';
        }
        if (isset($post['status']) && $post['status'] != NULL && count($post['status']) > 0) {
            $array_par = implode(",", $post['status']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and pes.status in ("' . $array_par . '")';
            }
        }
        if(isset($post['status']) && $post['status'] != NULL && !is_array($post['status'])){
            $and .= ' and pes.status = "'.$post['status'].'"';
        }
        if (isset($post['orderby']) && $post['orderby'] != NULL && $post['orderby'] != '') {
            $and .= ' ORDER BY ' . $post['orderby'];
        }

        $sql = 'SELECT distinct pes.codpessoa, pes.codcategoria, nvl.codnivel, pes.status, pes.bloco, pes.fazreserva, 
                pes.liberaacesso, pes.dtnascimento, pes.rg, pes.cpf, pes.dtcadastro, pes.imagem, pes.nome, nvl.nome AS nivel, 
                pes.apartamento, pes.email, cp.nome AS categoria, pes.dtvencimento, pes.acessapainel, pes.morador, pes.recebemsg, 
                func.nome AS funcionario FROM pessoa AS pes 
                INNER JOIN pessoa AS func ON func.codpessoa = pes.codfuncionario 
                LEFT JOIN nivel AS nvl ON pes.codnivel = nvl.codnivel 
                LEFT JOIN categoriapessoa AS cp ON pes.codcategoria = cp.codcategoria 
                WHERE pes.codempresa = ' . $_SESSION['codempresa'] . ' AND pes.nome <> ""' . $and;

        return $this->conexao->comando($sql);
    }

    public function calculadora($post) {
        $and = '';
        if (isset($post['codempresa']) && $post['codempresa'] != NULL && $post['codempresa'] != '') {
            $and .= ' codempresa = ' . $post['codempresa'];
        }
        if (isset($post['bloco']) && $post['bloco'] != NULL && sizeof($post['bloco']) > 0) {
            $array_par = implode(",", $post['bloco']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and bloco in ("' . $array_par . '")';
            }
        }
        if (isset($post['apartamento']) && $post['apartamento'] != NULL && sizeof($post['apartamento']) > 0) {
            $array_par = implode(",", $post['apartamento']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and apartamento in ("' . $array_par . '")';
            }
        }
        if (isset($post['codmorador']) && $post['codmorador'] != NULL && sizeof($post['codmorador']) > 0) {
            $array_par = implode(",", $post['codmorador']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and codpessoa in ("' . $array_par . '")';
            }
        }
        if (isset($post['codcategoria']) && $post['codcategoria'] != NULL && sizeof($post['codcategoria']) > 0) {
            $array_par = implode(",", $post['codcategoria']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and codcategoria in ("' . $array_par . '")';
            }
        }
        if (isset($post['codnivel']) && $post['codnivel'] != NULL && sizeof($post['codnivel']) > 0) {
            $array_par = implode(",", $post['codnivel']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and codnivel in ("' . $array_par . '")';
            }
        }
        if (isset($post['status']) && $post['status'] != NULL && $post['status'] != '') {
            $array_par = implode(",", $post['status']);
            $array_par = str_replace(',', '","', $array_par);
            if ($array_par != NULL && $array_par != "") {
                $and .= ' and pessoa.status in ("' . $array_par . '")';
            }
        }


        $sql = 'SELECT q1.qtd AS qtdTotal, q2.qtd AS qtdComEmail, (q1.qtd - q2.qtd ) AS qtdSemEmail, ' .
                'q3.qtd AS qtdAptComEmail, q4.qtd AS qtdAtivo, q5.qtd AS qtdEnviar ' .
                'FROM ' .
                '(' .
                'SELECT COUNT(1) AS qtd FROM pessoa ' .
                'WHERE' . $and .
                ') q1, ' . // qtdTotal
                '(' .
                'SELECT COUNT(1) AS qtd FROM pessoa ' .
                'WHERE' . $and . ' AND email <> ""' .
                ') q2, ' . // qtdComEmail
                '(' .
                'SELECT COUNT(DISTINCT apartamento, bloco) AS qtd FROM pessoa ' .
                'WHERE' . $and . ' AND email <> "" AND status = "a"' .
                ') q3, ' . // qtdAptComEmail
                '(' .
                'SELECT COUNT(1) AS qtd FROM pessoa ' .
                'WHERE' . $and . ' AND status = "a"' .
                ') q4, ' . // qtdAtivo
                '(' .
                'SELECT COUNT(1) AS qtd FROM pessoa ' .
                'WHERE' . $and . ' AND email <> "" AND status = "a"' .
                ') q5';    // qtdEnviar

        return $this->conexao->comandoArrayAssoc($sql);
    }

}
