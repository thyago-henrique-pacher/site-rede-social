function abreModalImage(imagem) {

    $("#img01").attr("src", "/sistema/arquivos/" + imagem.imagem);
    $("#nome_imagem").html("Imagem de " + imagem.nome);
    $("#modalImagem").modal();
}

function setarLinhaPessoa(result) {
    $("#fpessoa select").selectpicker('destroy');
    $("input[name='codmorador']").val(result.codpessoa);
    $.each(result, function (index, value) {
        var tipo = $("#fpessoa input[name='" + index + "']").prop("type");
        if (tipo != "file") {
            $("#fpessoa input[name='" + index + "']").val(value);
            $("#fpessoa #" + index).val(value);
            
        } else if (tipo == "file") {
            var foto = (value != undefined && value != '')
                    ? "/sistema/arquivos/" + value
                    : "/sistema/visao/recursos/img/sem_imagem.png";
            $("#imgPreview").prop("src", foto);
        } else if (tipo == "password") {
            $("#fpessoa #" + index).val(window.atob(value));
        }
    });
    if (result.qtd_apartamento <= 1) {
        $("#div_navegacao").hide();
    } else {
        $("#div_navegacao").show();
    }
    procurarArquivo();
    procurarAtestado();
    procurarBicicleta();
    procurarObservacao();
    procurarTelefone();
    procurarVeiculo();
    $('.nav-tabs a:first').tab('show');
    $(".usuarioEditar").removeClass('hidden');
    $("#caixa_status").removeClass('hidden');
}

function btNovoPessoa() {
    $("#fpessoa input").val("");
    $("#fpessoa select").val("");
    $(".usuarioEditar").addClass('hidden');
    $("#caixa_status").hide();
}

function excluirPessoa(codpessoa) {
    if (typeof (codpessoa) == "undefined") {//test do parametro opcional
        codpessoa = $("#codpessoa").val();
    }
    swal({
        title: "Confirma exclusão?",
        text: "Você não poderá mais visualizar as informações dessa pessoa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, exclua ele!",
        cancelButtonText: "Não",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            if (codpessoa !== null && codpessoa !== "") {
                $.ajax({
                    url: "/novo/control/Excluir.php",
                    type: "POST",
                    data: {codpessoa: codpessoa, tabela: 'pessoa'},
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {
                        if (data.situacao === true) {
                            swal("Usuário excluido", data.mensagem, "success");
                            procurarPessoa(false);
                            btNovoPessoa();
                        } else if (data.situacao === false) {
                            swal("Erro ao excluir", data.mensagem, "error");
                        }
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        swal("Erro ao excluir", "Erro causado por:" + errorThrown, "error");
                    }
                });
            } else {
                swal("Campo em branco", "Por favor escolha uma pessoa para excluir!", "error");
            }
        }
    });
}

function procurarPessoa(acao) {
    if ($("#listagemPessoa").length) {
        $.ajax({
            url: "/novo/control/pessoa/Procurar.php",
            type: "POST",
            data: $("#fPpessoa").serialize(),
            dataType: 'text',
            success: function (data, textStatus, jqXHR) {
                if (acao === false && data === "") {
                    swal("Atenção", "Nada encontrado!", "error");
                }
                if (data != "") {
                    data = JSON.parse(data);
                    document.getElementById("listagemPessoa").innerHTML = '<table class="table table-hover table-bordered" style="width: 100%" id="table_pessoa"></table>';
                    var colunas = [
                        {"data": "bloco", title: 'BL'},
                        {"data": "apartamento", title: 'Apto.'},
                        {"data": "nome", title: 'Nome'},
                        {"data": "email", title: 'E-mail'},
                        {
                            "data": "dtcadastro",
                            title: '<i class="fa fa-calendar" aria-hidden="true"></i> Dt. Cadastro',
                            render: function (data, type, row) {
                                return moment(new Date(data)).format('DD/MM/YYYY HH:mm');
                            }
                        },
                        {
                            "data": "funcionario",
                            "title": 'Cadastro por'
                        },
                        {
                            "data": "imagem", title: 'Imagem',
                            "render": function (data, type, row) {
                                if (data != undefined && data != null && data != "") {
                                    return '<a href="javascript: abreModalImage({\'imagem\': \'' + row.imagem + '\', \'nome\': \'' + row.nome + '\'})"><i class="fa fa-image" aria-hidden="true"></i></a>';
                                } else {
                                    return "";
                                }
                            }
                        },
                        {
                            "data": null,
                            title: 'Opções',
                            render: function (data, type, row) {
                                // Combine the first and last names into a single table field
                                var bt2 = "<a href='javascript: excluirPessoa(" + row.codpessoa + ")'><i class='fa fa-trash' aria-hidden='true'></i></a> ";
                                return bt2;
                            }
                        }
                    ]
                    dataTablePadrao('#table_pessoa', data, colunas, "pessoa", setarLinhaPessoa);
                } else {
                    $("#listagemPessoa").html('');
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Erro ao procurar pessoa", "Erro causado por:" + errorThrown, "error");
            }
        });
    }
}


$(function () {
    var folder = "pessoa";

    $("#tipopessoa").change(function () {
        if ($(this).val() == 'm') {
            $("#morador, #recebemsg, #fazreserva").val("s");
            $("#acessapainel").val("n");
            $(".funcionario").hide();
            $(".morador").show();
        } else {
            $("#morador").val("n");
            $("#acessapainel").val("s");
            $("#status").val("a");
            $(".morador").hide();
            $(".funcionario").show();
        }
    });

    $("#btnProcurar").click(function () {
        procurarPessoa(false);
    });

    $("#btnSalvar").click(function () {
        salvar(folder);
    });

    $("#imagempes").change(function () {
        var ext_arquivo = $(this).val().split('.').pop();
        var aceitos = $(this).prop("accept");
        var preview = document.getElementById('imgPreview');
        if (aceitos != undefined && aceitos != "") {
            if ($.inArray(ext_arquivo, ['jpg', 'jpeg', 'gif', 'bmp', 'png']) < 0) {
                swal("Cadastro pessoa", "Arquivos com extensões não permitidas estão presentes!", "warning");
                preview.src = "/sistema/visao/recursos/img/sem_imagem.png";
                $("#imagempes").val('').focus();
                $("#btnSalvar").prop("disabled", true);
            } else {
                $("#btnSalvar").prop("disabled", false);
                var file = document.querySelector('input[type=file]').files[0];
                var reader = new FileReader();
                reader.onloadend = function () {
                    preview.src = reader.result;
                };
                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "";
                }
            }
        }
    });


});