function salvarObservacao() {    $.ajax({        url: "/novo/control/SalvarObservacaoMorador.php",        type: "POST",        data: $("#fobservacao").serialize(),        dataType: 'json',        success: function (data, textStatus, jqXHR) {            if (data.situacao === true) {                swal("Observacao salvo", data.mensagem, "success");                procurarObservacao(true);                btNovoObservacao();            } else if (data.situacao === false) {                swal("Erro", data.mensagem, "error");            }        }, error: function (jqXHR, textStatus, errorThrown) {            swal("Erro", "Erro causado por:" + errorThrown, "error");        }    });}function setarLinhaObservacao(json) {    $("#fobservacao #codobservacao").val(json.codobservacao);    $("#fobservacao #observacao_morador").val(json.texto);}function procurarObservacao(acao) {    if ($("#listagemObservacao").length) {        $.ajax({            url: "/novo/control/ProcurarObservacaoMorador.php",            type: "POST",            data: {codmorador: document.fobservacao.codmorador.value},            dataType: 'text',            success: function (data, textStatus, jqXHR) {                if (acao === false && data === "") {                    swal("Atenção", "Nada encontrado!", "error");                }                if (data != "") {                    data = JSON.parse(data);                    document.getElementById("listagemObservacao").innerHTML = '<table id="table_obs"></table>';                    var colunas = [                        {"data": "dtcadastro2", title: 'Dt. Cadastro'},                        {"data": "texto", title: 'Texto'},                        {"data": "funcionario", title: 'Cadastro por'},                        {                            "data": null,                            title: 'Opções',                            render: function (data, type, row) {                                // Combine the first and last names into a single table field                                var bt1 = "<a href='javascript: setarLinhaObservacao(" + JSON.stringify(row) + ")'><i class='fa fa-pencil' aria-hidden='true'></i></a> ";                                var bt2 = "<a href='javascript: excluirObservacao(" + row.codobservacao + ")'><i class='fa fa-trash' aria-hidden='true'></i></a> ";                                return bt1 + bt2;                            }                        }                                            ]                    datatableSimples('#table_obs', data, colunas);                }else{                    $("#listagemObservacao").html('');                }            }, error: function (jqXHR, textStatus, errorThrown) {                swal("Erro ao procurar obs", "Erro causado por:" + errorThrown, "error");            }        });    }}function excluirObservacao(codobservacao) {    if (typeof (codobservacao) == "undefined") {//test do parametro opcional        codobservacao = $("#codobservacao").val();    }    swal({        title: "Confirma exclusão?",        text: "Você não poderá mais visualizar as informações dessa observação!",        type: "warning",        showCancelButton: true,        confirmButtonColor: "#DD6B55",        confirmButtonText: "Sim, exclua ele!",        cancelButtonText: "Não",        closeOnConfirm: false,        closeOnCancel: true    }, function (isConfirm) {        if (isConfirm) {            if (codobservacao !== null && codobservacao !== "") {                $.ajax({                    url: "/novo/control/Excluir.php",                    type: "POST",                    data: {codobservacao: codobservacao, tabela: 'observacaomorador'},                    dataType: 'json',                    success: function (data, textStatus, jqXHR) {                        if (data.situacao === true) {                            swal("Observação excluido", data.mensagem, "success");                            procurarObservacao(false);                            btNovoObservacao();                        } else if (data.situacao === false) {                            swal("Erro ao excluir", data.mensagem, "error");                        }                    }, error: function (jqXHR, textStatus, errorThrown) {                        swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");                    }                });            } else {                swal("Campo em branco", "Por favor escolha uma observacao para excluir!", "error");            }        }    });}function btNovoObservacao() {    var codmorador = document.fobservacao.codmorador.value;    $("#fobservacao input, #fobservacao textarea").val('');    document.fobservacao.codmorador.value = codmorador;}function abreRelatorioObservacao(tipo) {    document.getElementById("tipo").value = (tipo === 1) ? "pdf" : "xls";    document.getElementById("fpobservacao").submit();}/**daqui para baixa responsável pelo ajax de inserir ou atualizar observacao e também pelo upload sem redirecionar página*/(function () {    procurarObservacao();    $("#btNovoObservacao").click(function () {        btNovoObservacao();    });    $("#btSalvarObservacao").click(function () {        salvarObservacao();    });})();