$(document).ready(function () {

    /**
     * @description:Função responsável por abrir os form na modal e decidir se é um
     * novo registro ou uma update
     */

    $("#open-form").click(function ()
    {
        $('input[type="submit"]').val('Salvar');
        if ($('.modal-title').text() === "") {
            $('.modal-title').text("Novo Registro");
        }
        $('input[type="hidden"][name="id"]').remove();
        $("#modal-form").modal({
            backdrop: "static"
        });


        listaCombo();
        salvar();
    });

    //Função responsável por capturar ação de edição da table
    $('.edit').click(function ()
    {

        var id = this.id;
        var tr = $(this);

        $('form').each(function () {

            if ($(this).attr('id') !== "login-nav") {
                formulario = $(this);
            }
        });

        editar(id, formulario, tr);

    });

    //Função responsável por capturar ação de exclusão na table
    $('.delete').click(function ()
    {
        var id = this.id;
        $('form').each(function () {

            if ($(this).attr('id') !== "login-nav") {
                formulario = $(this);
            }
        });
        excluir(id, formulario);
    });

    $("#login").click(function ()
    {
        $("#login-nav").submit(function () {

            var dados = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: "login_login",
                data: dados,
                success: function () {
                    location.reload();
                },
                error: function (textStatus) {
                    console.log(textStatus);
                }});
            return false;
        });
    });

    $("#logout").click(function ()
    {

        $.ajax({
            type: 'POST',
            url: "login_logout",
            success: function () {
                location.reload();
            },
            error: function (textStatus) {
                console.log(textStatus);
            }
        });
        return false;
    });

    $(".add-cart").click(function ()
    {
        var dados = "id_produto=" + this.id;

        console.log(dados);
        $.ajax({
            type: 'POST',
            url: "carrinho_add",
            data: dados,
            success: function (data, textStatus, jqXHR) {
                console.log(data);
                console.log(textStatus);
                // location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });

    $(".quantidade").change(function ()
    {
        /*Pegamos a quantidade no input*/
        var quantidade = $(this).val();

        /*Pegamos o valor do atributo data no TD valor unitario*/
        var unitario = $(this).closest('tr').find('.val_unitario').val();

        /*buscamos o seletor TD data-total para manipularmos o objeto*/
        var total = $(this).closest('tr').find('.val_total');

        parseInt(quantidade);

        if (quantidade > 99)
        {
            quantidade = $(this).val(99);
            alert("Limite máximo de 99 unidades");
        }
        if (quantidade < 1)
        {
            quantidade = $(this).val(1);
            alert("Limite mínimo de 1 unidade");
        }

        var v_total = (parseFloat(unitario) * parseInt(quantidade));
        total.val(v_total);

        calculaTotal();

    });

    function calculaTotal()
    {
        var total = 0;

        $('.val_total').each(function () {

            total += parseFloat($(this).val());

        });
        $('#total_compra').val(total);
    }

    $("#comprar").click(function ()
    {
        var data = new Array;


        $('tr.produto-list').each(function () {

            var item = {
                id_produto: $(this).find('input[type="hidden"][name="id_produto"]').val(),
                quantidade: $(this).find('.quantidade').val(),
                preco: $(this).find('.val_unitario').val()
            };

            data.push(item);
        });

        json = JSON.stringify(data);

        $.ajax({
            type: 'POST',
            url: "pedido",
            data: {'itens': json},
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                $(this).closest('tr').remove();
                $(".mensagem-cart").css({diplay: "block"});
                $(".mensagem-cart").addClass("sucesso");
                $(".mensagem-cart").append("h4").text('Compra Finalizada');
                setTimeout(function () {
                    $(".mensagem-cart").fadeOut();
                }, 3000);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });

    $(".delete-item").click(function ()
    {
        var dados = "id_produto=" + this.id;
        $.ajax({
            type: 'POST',
            url: "carrinho_del",
            data: dados,
            success: function (data, textStatus, jqXHR) {
                $(this).closest('tr').remove();
                $(".mensagem-cart").css({diplay: "block"});
                $(".mensagem-cart").addClass("sucesso");
                $(".mensagem-cart").append("h4").text('Produto removido de sua cesta');
                setTimeout(function () {
                    $(".mensagem-cart").fadeOut();
                }, 3000);


            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });

    function editar(id, formulario, tr)
    {
        listaCombo();
        var nome = tr.parent().closest('tr').find('td[data-nome]').data('nome');
        var email = tr.parent().closest('td').find('td[data-email]').data('email');

        $('input[type="text"][name="nome"]').val(nome);
        $('input[type="email"][name="email"]').val(email);
        $('input[type="hidden"][name="id"]').val(id);
        $('input[type="submit"]').val('Editar');
        $('.modal-title').text("Editar - ID::" + id + " Nome::" + nome);

        formulario.submit(function () {

            var dados = formulario.serialize();
            formulario.submit(function () {
                return false;
            });

            $.ajax({
                type: 'POST',
                url: formulario.attr('id') + "_editar",
                data: dados,
                beforeSend: function (xhr) {
                    var teste = confirm("Deseja editar este registro?");
                    if (teste === true) {
                        return true;
                    } else {
                        xhr.abort();
                    }
                },
                success: function () {
                    alert("Registro editado com sucesso!");
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
            return false;
        });
    }

    function excluir(id, formulario)
    {
        $.ajax({
            type: 'POST',
            url: formulario.attr('id') + "_excluir",
            data: {id: id},
            beforeSend: function (xhr) {
                var teste = confirm("Deseja excluir este registro?");
                if (teste === true) {
                    return true;
                } else {
                    xhr.abort();
                }
            },
            success: function () {
                alert("Registro excluido com sucesso!");
                location.reload();
            },
            error: function (textStatus) {
                alert("Erro ao excluir registro->" + textStatus);
            }
        });
    }

    function salvar(formulario)
    {
        $('form').each(function () {

            if ($(this).attr('id') !== "login-nav") {

                var formulario = $(this);
                formulario.submit(function () {

                    var dados = formulario.serialize();
                    $.ajax({
                        type: 'POST',
                        url: formulario.attr('id') + "_salvar",
                        data: dados,
                        success: function () {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                    return false;
                });
            }
        });
    }

    function listaCombo()
    {
        $("select").each(function (index, value) {

            var model = $('form').attr('id');
            var select = $(value).attr('id');
            var required = $(value).data('required');

            if (required !== undefined) {

                $(this).html("<option value='0'> Selecione primeiro " + ucFirst(required) + "</option>");

                var id_required = parseInt($("#" + required + " option:selected").val());

                do {
                    $("#" + required).on("change", function () {

                        id_required = parseInt($("#" + required + " option:selected").val());
                        carregaSelect(model, select, required, id_required);

                    });
                    break;
                } while (id_required === 0);

            } else {

                carregaSelect(model, select, required, id_required);
            }
        }
        );
    }

    /**Função responsavel por carregar qualquer select com base nos parametros passados
     * @param {type} model: Formulário do select
     * @param {type} select: select a ser preenchido
     * @param {type} required: Atributo [data-required] que indica qual select deve é requisito para o proximo select
     * @param {type} id_required: ID do option selecionado
     * @returns O combo preenchido
     */
    function carregaSelect(model, select, required, id_required)
    {

        var url = null;
        var data = null;

        if (required === undefined) {
            url = model + "_lista_combo_" + select;

        } else {
            url = model + "_lista_combo_" + select + "_by_" + required;

            data = {"id": id_required, "field_required": required};
        }

        $.ajax({
            dataType: "json",
            type: 'POST',
            url: url,
            data: data,
            success: function (dados) {

                var option = "<option>Selecione " + ucFirst(select) + "</option>";
                $.each(dados, function (i, obj) {

                    option += '<option value="' + obj["id_" + select] + '">' + obj["nome"] + '</option>';
                });
                $('#' + select).html(option).show();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }

        });
    }

    function ucFirst(string)
    {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
});