var tamarquivos;

function procuraDestinatarios(codcomunicado, assunto) {
    $.ajax({
        url: "/novo/control/mensagem/ProcurarDestinatario.php",
        type: "POST",
        data: {codcomunicado: codcomunicado},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            dataTablePadrao("#tblmensagemdestinatario", data, arrayColunas(data[0], [0]), "mensagemdestinatario");
            var dados = table["mensagem"].row('.selected').data();
            $("#mDestinatarios .modal-title").html("Assunto: " + dados.assunto);
            if (dados.texto != '')
                $("#textoMsg").html(dados.texto);
            else
                $("#textoMsg").html("Mensagem sem texto...");
            $("#mDestinatarios").modal();
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function procuraResposta(codcomunicado) {
    $.ajax({
        url: "/novo/control/mensagem/ProcuraResposta.php",
        type: "POST",
        data: {codmensagem: codcomunicado},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            console.log(data);
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function calculadora() {
    $.ajax({
        url: "/novo/control/mensagem/Calculadora.php",
        type: "POST",
        data: $("#fmensagem").serialize(),
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            for (var i in data)
                $('#' + i).html(data[i]);
            $("#divTblCalculadora").show();
            if (data.qtdEnviar > 0)
                $("#btnEnviar").prop('disabled', false);
            else
                $("#btnEnviar").prop('disabled', true);
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function contaEmail() {
    $.ajax({
        url: "/novo/control/mensagem/ContaEmail.php",
        type: "POST",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            for (var i in data)
                $('#' + i).html(data[i]);
            if (data.limiteemail == data.qtdTotalMes)
                $("#btnEnviar").prop("disabled", true);
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function procuraStatus() {
    $.ajax({
        url: "/novo/control/mensagem/ProcuraStatus.php",
        type: "POST",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            dataTablePadrao("#tblstatusmensagem", data, arrayColunas(data[0], null), "statusmensagem");
            $("#tblstatusmensagem").show();
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function testeUnitarioSalvarMensagem() {
//    var data = {"bloco": "111", "apartamento": "", "codmorador": "41740", "status": "a", "codcategoria": "128", "codcomunicado": "2", "responder": "programador@sitesesistemaspg.com", "assunto": "Feliz Natal Teste", "texto": "<p>Feliz Natal para Todos</p>"};
    var data = {"bloco": "111", "apartamento": "1", "codmorador": "41740", "codcategoria": "128", "codnivel": "1", "codcomunicado": "2", "responder": "programador@sitesesistemaspg.com", "assunto": "Não sei teste", "texto": "<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Text&atilde;o bem loko&nbsp;<img src=\"view/js/tinymce/plugins/emoticons/img/smiley-laughing.gif\" alt=\"laughing\" /></p>\r\n</body>\r\n</html>"};
    editar("mensagem", data);
}

$(function () {
    var folder = "mensagem";
    var invisible = [0, 3];

    $("#btnProcurarMensagem").click(function () {
        var $this = $("#btnProcurarMensagem");
        $this.button('loading');
        procurar(folder, invisible, $this);
    });

    $("#btnEnviar").click(function () {
        jQueryForm(folder);
    });

    $("#fmensagem select").change(function () {
        calculadora();
    });

    $("#arquivo").change(function (e) {
        tamarquivos = 0;
        var length = (this.files.length);
        var fileInput = $(this);
        var extPermitidas = ['exe', 'bat', 'php', 'asp', 'aspx', 'html'];
        for (var i = 0; i < length; i++) {
            var ext = this.files[i].name.split('.').pop();
            tamarquivos += this.files[i].size / 1024 / 1024;
            if (tamarquivos > 2) {
                swal("Cadastro Mensagem", "O tamanho dos arquivos passou de 2MB, total: " + tamarquivos.toFixed(2).replace('.', ',') + "MB", "warning");
                $("#arquivo").focus();
                $("#btnEnviar").prop("disabled", true);
                break;
            } else if ($.inArray(ext, extPermitidas) >= 0) {
                swal("Cadastro Mensagem", "Arquivos com extensões não permitidas estão presentes!", "warning");
                $("#arquivo").val('').focus();
                $("#btnEnviar").prop("disabled", true);
            } else
                $("#btnEnviar").prop("disabled", false);
        }
    });

    $("#arquivoc").change(function () {
        var ext_arquivo = $(this).val().split('.').pop();
        var aceitos = $(this).prop("accept");
        var preview = $("#imgPreview");
        if (aceitos != undefined && aceitos != "") {
            if ($.inArray(ext_arquivo, ['jpg', 'jpeg', 'gif', 'bmp', 'png']) < 0) {
                swal("Cadastro comunicado", "Arquivos com extensões não permitidas estão presentes!", "warning");
                preview.prop("src", "/sistema/visao/recursos/img/sem_imagem.png");
                $("#arquivoc").val('').focus();
                $("#btnCadastrarComunicado").prop("disabled", true);
            } else {
                $("#btnCadastrarComunicado").prop("disabled", false);
                var file = $("#arquivoc")[0].files[0];
                var reader = new FileReader();
                reader.onloadend = function () {
                    preview.prop("src", reader.result);
                };
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.prop("src", '');
                }
            }
        }
    });

    $("#codcomunicado").change(function () {
        var codcomunicado = $(this).val();
        var assunto = $(this).find('option:selected').text();
        if (codcomunicado != '') {
            $.ajax({
                url: "/novo/control/comunicado/ProcuraTexto.php",
                type: "POST",
                data: {codcomunicado: codcomunicado},
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    $("#assunto").val(assunto);
                    tinymce.get('texto').setContent(data.texto);
                }, error: function (jqXHR, textStatus, errorThrown) {
                    swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
                }
            });
        }
    });

    $("#btnCadastrarComunicado").click(function () {
        jQueryForm("comunicado");
    });

    $("#btnVisualizar").click(function () {
        $.ajax({
            url: "/novo/control/pessoa/Procurar.php",
            type: "POST",
            data: $("#fmensagem").serialize() + '&simples=1&status[]=a',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                dataTablePadrao("#tblVisualizacao", data, arrayColunas(data[0], null), "visualizacao");
                $("#modalVisualizacao").modal();
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar", "Erro causado por:" + errorThrown, "error");
            }
        });
    });

    $("#fstatusmensagem").submit(function (e) {
        e.preventDefault();
        salvar("statusmensagem");
        procuraStatus();
    });

//    var minutes = 5;
//    var seconds = 0;
//
//    var timer = setInterval(function () {
//        console.log('0' + minutes + ':' + seconds);
//        if (seconds == 0) {
//            if (minutes == 0)
//                clearInterval(timer)
//            else {
//                minutes--;
//                seconds = 60;
//            }
//        }
//        seconds--;
//    }, 1000);


    contaEmail();
    procuraStatus();
});