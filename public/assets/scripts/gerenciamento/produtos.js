
let atualizada = true;


function ligareventos() {
    // Exemplo de reinicialização de modais
    $('.modal').each(function () {
        bootstrap.Modal.getOrCreateInstance(this);
    });


    // Mascarar campos
    var valorAnterior = '';
    var apagando = false;
    $('.addpreco-input').on('keydown', function (e) {
        if (e.which === 8 || e.which === 46) {
            apagando = true;
        }
    });
    $('.addpreco-input').on('input', function () {
        if (apagando) {
            apagando = false;
            return;
        }

        var valor = $(this).val().replace(/[.-]/g, ''); // remove . e -
        valor = valor.replace(/[a-zA-Z]/g, ''); // remove letras
        valor = valor.replace(/[^0-9]/g, ''); // remove caracteres não numéricos
        valor = valor.substring(0, 5); // limita a 5 caracteres

        var formato = '';
        if (valor.length > 0) {
            formato += valor.substring(0, 2) + '.' + valor.substring(2, 4);
        } else formato = valor;

        $(this).val(formato);
    });

    //Preview
    $('#add-foto').on('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });

    //Modal
    $('.modal .btn-secondary').on('click', function () {
        $(this).closest('.modal').modal('hide');
    });


    $('#criarproduto').on('click', function () {
        $('#addProductModal').modal('show');
    });

    //hover
    $('#criarproduto').hover(function () {
        $(this).addClass('btn-primary');
        $(this).find('span').removeClass('text-primary');
        $(this).find('span').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-primary');
        $(this).find('span').removeClass('text-light');
        $(this).find('span').addClass('text-primary');
    });

    $('.btn-editar-produto').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-primary');
        $(this).find('i').removeClass('text-primary');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-primary');
    });
    $('.btn-promover-imagem').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-warning');
        $(this).find('i').removeClass('text-warning');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-warning');
    });
    $('.btn-deletar-produto').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-danger');
        $(this).find('i').removeClass('text-danger');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-danger');
    });
    $('.btn-deletar-imagem').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-danger');
        $(this).find('i').removeClass('text-danger');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-danger');
    });
    $('.btn-abrir-tabela').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-dark');
        $(this).find('i').removeClass('text-dark');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-dark');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-dark');
    });

    $('.btn-adicionar-foto').hover(function () {
        $(this).addClass('btn-primary');
        $(this).find('span').removeClass('text-primary');
        $(this).find('span').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-primary');
        $(this).find('span').removeClass('text-light');
        $(this).find('span').addClass('text-primary');
    });

    $("#addProductForm").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/gerenciamento/addproduto";

        var formData = new FormData();
        formData.append('imagem', $('#add-foto')[0].files[0]);
        formData.append('nome', $('#add-nome').val());
        formData.append('preco', $('#add-preco').val());
        formData.append('descricao', $('#add-descricao').val());
        formData.append('status', $('#add-status').val());
        formData.append('categoria', $('#add-categoria').val());


        addProduto(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {


                $('#addProductForm')[0].reset();
                $('#addProductModal').modal('hide');

                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
              <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
            `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });




    $(".edit-product-form").submit(function (event) {
        event.preventDefault();

        var idProduto = $(this).data('produto-id');

        var formData = new FormData();

        formData.append('id_produto', idProduto);
        formData.append('nome', $('#edit-nome-' + idProduto).val());
        formData.append('categoria', $('#edit-categoria-' + idProduto).val());
        formData.append('descricao', $('#edit-descricao-' + idProduto).val());
        formData.append('status', $('#edit-status-' + idProduto).val());

        atualizarproduto(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {

                $('.edit-product-form')[0].reset();
                $('#modal-editar-' + idProduto).modal('hide');


                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });

    $(".edit-variedade-form").submit(function (event) {
        event.preventDefault();

        var idProduto = $(this).data('produto-id');

        var formData = new FormData();

        formData.append('nome', $('#edit-nome-variedade-' + idProduto).val());
        formData.append('id', $('#edit-variacao-' + idProduto).val());
        formData.append('status', $('#edit-status-variedade-' + idProduto).val());

        atualizarvariedade(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {


                $('.edit-variedade-form')[0].reset();
                $('#modal-editar-' + idProduto).modal('hide');


                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });
    $(".adicionar-preco-form").submit(function (event) {
        event.preventDefault();

        var idProduto = $(this).data('produto-id');

        var formData = new FormData();

        formData.append('id_variedade', $('#addpreco-variacao-' + idProduto).val());
        formData.append('preco', $('#addpreco-preco-' + idProduto).val());
        formData.append('id_tamanho', $('#addpreco-tamanho-' + idProduto).val());

        adicionarpreco(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {

                $('.edit-variedade-form')[0].reset();
                $('#modal-editar-' + idProduto).modal('hide');
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });

    $(".formaddimagem").submit(function (event) {
        event.preventDefault();



        var idProduto = $(this).data('produto-id');
        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/gerenciamento/addproduto";

        var formData = new FormData();
        formData.append('imagem', $('#add-foto-' + idProduto)[0].files[0]);
        formData.append('id_produto', idProduto);

        addImagem(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {

                $('#addImagem-' + idProduto)[0].reset();
                $('#modal-addimagem-' + idProduto).modal('hide');

                var url = document.URL.toLowerCase().split('admin')[0];
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });



    $(".formaddvariedade").submit(function (event) {
        event.preventDefault();



        var idProduto = $(this).data('produto-id');
        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/gerenciamento/adicionarvariedade";

        var formData = new FormData();
        formData.append('nome', $('#add-variedade-nome-' + idProduto).val());
        formData.append('id_produto', idProduto);

        addVariedade(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {

                $('#addvariedade-' + idProduto)[0].reset();
                $('#modal-addvariedade-' + idProduto).modal('hide');

                var url = document.URL.toLowerCase().split('admin')[0];
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });

    $(".deletar-variedade-form").submit(function (event) {
        event.preventDefault();



        var idProduto = $(this).data('produto-id');
        var url = document.URL.toLowerCase().split('admin')[0];

        var formData = new FormData();
        formData.append('id', $('#deletar-variedade-variacao-' + idProduto).val());

        deletarvariedade(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {

                $('#addvariedade-' + idProduto)[0].reset();
                $('#modal-addvariedade-' + idProduto).modal('hide');

                var url = document.URL.toLowerCase().split('admin')[0];
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });


    $(".deletar-preco-form").submit(function (event) {
        event.preventDefault();



        var idProduto = $(this).data('produto-id');
        var url = document.URL.toLowerCase().split('admin')[0];

        var formData = new FormData();
        formData.append('id', $('#deletar-preco-preco-' + idProduto).val());

        deletarpreco(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {

                $('#addvariedade-' + idProduto)[0].reset();
                $('#modal-addvariedade-' + idProduto).modal('hide');

                var url = document.URL.toLowerCase().split('admin')[0];
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });
            }

            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });


    });


    $('.btn-deletar-imagem').on('click', function () {
        var idProduto = $(this).data('produto-id');
        var imagem = $('.img-produto-' + idProduto + ' img.active').data('imagem');

        var formData = new FormData();
        formData.append('imagem', imagem);
        formData.append('id_produto', idProduto);

        deleteImagem(formData).done(function (data) {
            if (data.status == 'success') {
                $('#modal-editar-' + idProduto).modal('hide');

                var url = document.URL.toLowerCase().split('admin')[0];
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });



                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });


            }

            else {
                var url = document.URL.toLowerCase().split('admin')[0];
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });
            }

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });

    $('.btn-promover-imagem').on('click', function () {
        var idProduto = $(this).data('produto-id');
        var imagem = $('.img-produto-' + idProduto + ' img.active').data('imagem');

        var formData = new FormData();
        formData.append('imagem', imagem);
        formData.append('id_produto', idProduto);

        promoverimagem(formData).done(function (data) {

            if (data.status == 'success') {
                $('#modal-editar-' + idProduto).modal('hide');

                var url = document.URL.toLowerCase().split('admin')[0];
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                    `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });



                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });


            }

            else {

                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });
            }

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });

    $('.btn-deletar').on('click', function () {
        var idProduto = $(this).data('produto-id');

        deleteProduto(idProduto).done(function (data) {
            var url = document.URL.toLowerCase().split('admin')[0];
            if (data.status == 'success') {
                $('#modal-deletar-' + idProduto).modal('hide');

                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
                `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });



                updateTabelaProdutos().done(function (data) {
                    $('#linhastabela').empty();
                    $('#linhastabela').html(data.tabela);
                    atualizada = false;
                }).fail(function (xhr, status, error) {
                    alert(xhr.responseText);
                });


            }

            else

                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
              <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
            `,
                    showCancelButton: false, // remove the default "Cancel" button
                    showConfirmButton: false, // remove the default "OK" button
                    width: '40em', // adjust modal width
                    background: '#fef66e', // yellow background
                    customClass: {
                        container: 'swal-modal-amarelo',
                        icon: 'icon-modal-custom',
                        footer: 'footer-modal-logar' // custom class for the modal
                    }
                });

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });


    $('.select-edit').on('click', function () {
        // Remove a classe "active" de todas as imagens
        $('.select-edit').removeClass('active');
        // Adiciona a classe "active" à imagem clicada
        $(this).addClass('active');
    });


}


$(document).ready(function () {
    ligareventos();
});



function desligaeventos() {

    $('.modal').modal('destroy');

    $('#add-preco').off('keydown');

    $('#add-preco').off('input');


    $('#add-foto').off('change');


    $('#modal-edicao .btn-secondary, #modal-deletar .btn-secondary').off('click');


    $('.btn-editar').on('click');


    $('.btn-deletar').off('click');


    $('#criarproduto').off('click');


    $('#criarproduto').off('hover');
    $('.btn-editar-produto').off('hover');
    $('.btn-promover-imagem').off('hover');
    $('.btn-deletar-produto').off('hover');
    $('.btn-deletar-imagem').off('hover');
    $('.btn-abrir-tabela').off('hover');
    $('.btn-adicionar-foto').off('hover');


    $("#addProductForm").off('submit');

    $(".edit-product-form").off('submit');

    $(".formaddimagem").off('submit');

    $("#excluirproduto").off('click');
    $(".btn-deletar-imagem").off('click');
    $(".btn-promover-imagem").off('click');
    $(".btn-deletar").off('click');
    $(".select-edit").off('click');


}


$(document).ready(function () {
    setInterval(function () {
        if (!atualizada) {
            desligaeventos();
            ligareventos();
            atualizada = true;
        }
    }, 3000);
});
