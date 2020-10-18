var table = {};
var pasta = '';
var hoje = new Date();
var hojeAmericano = hoje.toISOString();

function arrayColunas(data, invisible) {
    var array_colunas = [], i = 0;
    for (var k in data) {
        if ($.inArray(i, invisible) < 0) {
            if ($.inArray(k, ['dtcadastro', 'dtnascimento', 'dtabertura', 'dtstatus', 'dtvenda', 'dtpago']) >= 0)
                array_colunas.push({
                    data: k,
                    render: function (data, type, row) {
                        if (data == '0000-00-00 00:00:00')
                            return 'Não foi pago';
                        if (data.length > 10)
                            return moment(new Date(data)).format('DD/MM/YYYY HH:mm');
                        else
                            return moment(new Date(data)).format('DD/MM/YYYY');
                    }
                });
            else if ($.inArray(k, ['acessapainel', 'morador', 'recebemsg', 'situacao', 'lido']) >= 0)
                array_colunas.push({
                    data: k,
                    render: function (data, type, row) {
                        return (data == 's') ? 'Sim' : 'Não';
                    }
                });
            else if (k == 'imagem')
                array_colunas.push({
                    data: k,
                    render: function (data, type, row) {
                        return '<i class="fa fa-picture-o myImg" aria-hidden="true" onclick="abreModalImage(\'' + data + '\')"></i>';
                    }
                });
            else if (k == 'visualizar')
                array_colunas.push({
                    data: k,
                    render: function (data, type, row) {
                        return '<i class="fa fa-eye" aria-hidden="true" onclick="procuraDestinatarios(\'' + data + '\')"></i>';
                    }
                });
            else if (k == 'resposta')
                array_colunas.push({
                    data: k,
                    render: function (data, type, row) {
                        return '<i class="fa fa-reply" aria-hidden="true" onclick="procuraResposta(\'' + data + '\')"></i>';
                    }
                });
            else
                array_colunas.push({"data": k});
        }
        i++;
    }
    return array_colunas;
}

function procurarObjeto(objeto, funcaoEditar) {
    $.ajax({
        url: "/novo/control/ProcurarObjeto.php",
        type: 'POST',
        data: {tabela: objeto.tabela, campo: objeto.campo, codigo: objeto.codigo},
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if(data.situacao === undefined){
                funcaoEditar(data);
            }else{
                swal("Erro", data.mensagem, "error");
            }
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

async function carregaOption(model) {
    $.ajax({
        url: "/novo/control/BuscaOption.php",
        type: 'POST',
        data: {model: model},
        dataType: 'text',
        success: function (data, textStatus, jqXHR) {
            $('.cod' + model.toLowerCase()).html(data);
            $('.form-procurar .cod' + model.toLowerCase()).selectpicker('render');
        }, error: function (jqXHR, textStatus, errorThrown) {
            swal("Erro", "Erro causado por:" + errorThrown, "error");
        }
    });
}

function confirmaExclusao(arrkey, folder) {
    var length = folder.length - 1;
    var folderm = '';
    if (folder[length] == 'm')
        folderm = folder.substring(0, length) + 'n';
    else
        folderm = folder;
    swal({
        title: "Você tem certeza?",
        text: "Você irá excluir todos(as) " + folderm + "s!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sim, apague tudo!",
        cancelButtonText: "Cancelar!",
        closeOnConfirm: false
    }, function () {
        excluir(folder, arrkey);
    })
}

function dataTablePadrao(tabela, data, colunas, folder, funcaoEditar) {
    pasta = folder;
 
    if ($.fn.dataTable.isDataTable(tabela)) {
        table[folder].destroy();
    }
    table[folder] = $(tabela).DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ resultados por pág.",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "pág _PAGE_ de _PAGES_ com _TOTAL_ resultados",
            "infoEmpty": "Nenhum resultado disponivel",
            "infoFiltered": "(filtrando de _MAX_ total resultados)",
            "search": 'Procurar',
            "emptyTable": "Nenhum dado encontrado!",
            "paginate": {
                "previous": "Pág. ant.",
                "next": "Próx. pág."
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fa fa-pencil" aria-hidden="true"></i> Editar',
                className: 'btn btn-primary',
                init: function (api, node, config) {
                    $(node).removeClass('dt-button');
                },
                action: function (e, dt, button, config) {
                    if (funcaoEditar != undefined)
                        funcaoEditar(dt.rows('.selected').data()[0]);
                    else
                        editar(folder, dt.rows('.selected').data()[0]);
                }
            },
            {
                text: '<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir',
                className: 'btn btn-danger',
                init: function (api, node, config) {
                    $(node).removeClass('dt-button');
                },
                action: function (e, dt, button, config) {
                    var obj = dt.rows('.selected').data();
                    var key = Object.keys(obj[0])[0];
                    var keys = [];
                    for (var i = 0; i < obj.length; i++) {
                        keys.push(obj[i][key]);
                    }
                    keys = JSON.parse('{"' + key + '": [' + keys.toString() + ']}');
                    confirmaExclusao(keys, folder);
                }
            },
            {
                extend: 'collection',
                text: '<i class="fa fa-download" aria-hidden="true"></i> Exportar',
                className: 'btn btn-success',
                init: function (api, node, config) {
                    $(node).removeClass('dt-button');
                },
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-clone" aria-hidden="true"></i> Copiar'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF'
                    }
                ]
            }
        ],
        select: {
            style: 'multi'
        },
        "data": data,
        "columns": colunas,
        "responsive": true,
        "autoWidth": false,
        "order": [[0, "asc"]],
        "aoColumnDefs": [{"bSearchable": true}]
    });


    $(tabela + " tbody").on("click", "tr", function () {
        $(this).toggleClass("selected");
        var length = table[folder].rows('.selected').data().length;
        if (length > 0) {
            table[folder].button(1).enable();
            if (length > 1)
                table[folder].button(0).disable();
            else
                table[folder].button(0).enable();
        } else {
            table[folder].button(1).disable();
            table[folder].button(0).disable();
        }
    });

    if (folder != "Visualizacao") {
        table[folder].button(0).disable();
        table[folder].button(1).disable();
        if (folder == "statusmensagem")
            table[folder].button(2).remove();
        else if (folder == "mensagemdestinatario") {
            table[folder].button(0).remove();
            table[folder].button(0).remove();
        }
    } else {
        table[folder].button(0).remove();
        table[folder].button(0).remove();
    }
    pasta = '';
}

function editar(folder, data) {
    var array_func = {'pessoa': setarLinhaPessoa(data)};
    array_func[folder];
    console.log(data);
    $.each(data, function (k, valor) {
        console.log("#f" + folder + ' #' + k);
        $("#f" + folder + ' #' + k).val(valor);
    });

    var $imgPreview = $("#imgPreview");
    if ($imgPreview.length) {
        if (data.imagem != '')
            $imgPreview.attr("src", "/sistema/arquivos/" + data.imagem);
    }

    $('.nav-tabs a:first').tab('show');
}

function comboDinamico() {
    var cond = $(".codpessoa").length > 0;
    $(".codbloco").change(function () {
        var id = $(this).prop('id');
        var arrcod = $("#" + id).val();

        var $apartamento = $('#' + id).parents().find(".codapartamento");
        if (cond)
            var $morador = $('#' + id).parents().find(".codpessoa");

        if (arrcod.length > 0) {
            $apartamento.find("option").hide();
            for (var i in arrcod)
                $apartamento.find("option.bloco" + arrcod[i]).show();
            if (cond) {
                $morador.find("option").hide();
                for (var i in arrcod)
                    $morador.find("option.bloco" + arrcod[i]).show();
                $morador.selectpicker('refresh');
            }
            $apartamento.selectpicker('refresh');
        }

        $('#' + id).parents().find(".codapartamento").selectpicker('deselectAll');
        if (cond) {
            $('#' + id).parents().find(".codpessoa").selectpicker('deselectAll');
        }
    });

    if (cond) {
        $("#codapartamento").change(function () {
            var id = $(this).prop('id');
            var arrcod = $("#" + id).val();
            var $morador = $('#' + id).parents().find(".codpessoa");

            $morador.find("option").hide();
            for (var i in arrcod)
                $morador.find("option.apartamento" + arrcod[i]).show();
            $morador.selectpicker('deselectAll');

            $morador.selectpicker('refresh');
        });
    }
}

function datatableSimples(tabela, data, colunas) {
    $(tabela).DataTable({
        "language": {
            "lengthMenu": "Mostrando _MENU_ resultados por pág.",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "pág _PAGE_ de _PAGES_ com _TOTAL_ resultados",
            "infoEmpty": "Nenhum resultado disponivel",
            "infoFiltered": "(filtrando de _MAX_ total resultados)",
            "search": 'Procurar',
            "emptyTable": "Nenhum dado encontrado!",
            "paginate": {
                "previous": "Pág. ant.",
                "next": "Próx. pág."
            }
        },
        "data": data,
        "columns": colunas,
        "responsive": true,
        "autoWidth": false,
        "order": [[0, "asc"]]
    });
}

function limparForms() {
    $("input, select").val('');
    $('.selectpicker').selectpicker('deselectAll');
    if ($("#imgPreview").length > 0)
        $("#imgPreview").prop("src", "/sistema/visao/recursos/img/sem_imagem.png");
}

function procuraFuncionarios() {
    if ($("#teamMembers").length) {
        $.ajax({
            url: "/novo/control/pessoa/Procurar.php",
            type: 'POST',
            dataType: 'json',
            data: {tipopessoa: 'f', status: 'a'},
            success: function (data, textStatus, jqXHR) {
                var content = '';
                $.each(data, function (key, pessoa) {
                    content += '<div class="desc">' +
                            '<div class="thumb">' +
                            '<img class="img-circle" src="/sistema/arquivos/' + pessoa.imagem + '" width="35px" height="35px" align="">' +
                            '</div>' +
                            '<div class="details">' +
                            '<p><a href="/novo/pessoa/' + pessoa.codpessoa + '">' + pessoa.nome.toUpperCase() + '</a><br/>' +
                            '<muted>Available</muted>' +
                            '</p>' +
                            '</div>' +
                            '</div>';
                });
                $("#teamMembers").html(content);
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Dashboard", "Erro ao procurar membros do time, causado por:" + errorThrown, "error");
            }
        });
    }
}

function procuraNovasNotificacoes() {
    if ($("#notifications").length) {
        $.ajax({
            url: "/novo/control/pessoa/ProcurarNovasNotificacoes.php",
            type: 'POST',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                var content = '';
                for (var i in data) {
                    content += '<div class="desc">' +
                            '<div class="thumb">' +
                            '<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>' +
                            '</div>' +
                            '<div class="details">' +
                            '<p><muted>18 Hours Ago</muted><br/>' +
                            '<a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>' +
                            '</p>' +
                            '</div>' +
                            '</div>';
                }
                $("#notifications").html(content);
            }, error: function (jqXHR, textStatus, errorThrown) {
                swal("Dashboard", "Erro ao procurar notificações, causado por:" + errorThrown, "error");
            }
        });
    }
}

/**
 * funciona para setar as datas de pesquisa nos valores inicial e final
 * */
function defineDatasIniciais(){
    var separa_data = hojeAmericano.split('T');
    if($("#data1").length){
        $("#data1").val(separa_data[0]);
    }
    if($("#data2").length){
        $("#data2").val(separa_data[0]);
    }    
}

$(function () {
    
    defineDatasIniciais();
    
    if ($(".codcategoria").length > 0)
        carregaOption("Categoria");
    if ($(".codnivel").length > 0)
        carregaOption("Nivel");
    if ($(".codbloco").length > 0) {
        carregaOption("Bloco");
        comboDinamico();
    }
    if ($(".codapartamento").length > 0)
        carregaOption("Apartamento");
    if ($(".codstatus").length > 0)
        carregaOption("Status");
    if ($(".codcomunicado").length > 0)
        carregaOption("Comunicado");
    if ($(".codpessoa").length > 0)
        carregaOption("Pessoa");

    if ($(".telefone").length || $(".celular").length || $(".placa").length) {
        if ($(".telefone").length) {
            $(".telefone").mask("(99)9999-9999");
        }
        if ($(".celular").length) {
            $(".celular").mask("(99)99999-9999");
        }
        if ($(".placa").length) {
            $(".placa").mask("AAA-9999");
        }
    }

    procuraFuncionarios();
//    procuraNovasNotificacoes();

});