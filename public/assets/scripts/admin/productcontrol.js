let atualizada = true;
function ligareventos() {

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

    $('#add-foto').on('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });


    //Abrir barra lateral
    $('.tr-produto').on('click', function () {
        $('#sidebar-products').toggleClass('show');
        var idProduto = $(this).data('id-produto');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/atualizarsidebarproduto";

        var formData = new FormData();
        formData.append('id_produto', idProduto);

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            $('#sidebar-products').html(data);
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });

    //Fechar barra lateral
    $(document).on('click', function (event) {
        if ($(event.target).closest('#sidebar-products').length === 0 && $(event.target).closest('.tr-produto').length === 0) {
            $('#sidebar-products').removeClass('show');
        }
    });

    $('.img-sec-gerenciamento').on('click', function (event) {
        $('.principal-image').removeClass('principal-image');
        $(this).addClass('principal-image');
    });

    $('#btn-confirm-delete-img').on('click', function (event) {
        var idProduto = $('#btn-delete-img').data('id-produto');
        var image = $('.principal-image').data('imagem');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/deletarimagem";

        var formData = new FormData();
        formData.append('id_produto', idProduto);
        formData.append('imagem', image);

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            $("#modal-confirm-delete-img").modal('hide');
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });


    $('#btn-confirm-delete-product').on('click', function (event) {
        var idProduto = $('#btn-delete-product').data('id-produto');


        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/deletarproduto";

        var formData = new FormData();
        formData.append('id_produto', idProduto);

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            $("#modal-confirm-delete-product").modal('hide');
            atualizartabela();
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });

    $('#btn-promove-img').on('click', function (event) {
        var idProduto = $(this).data('id-produto');
        var image = $('.principal-image').data('imagem');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/tornarimgprincipal";

        var formData = new FormData();
        formData.append('id_produto', idProduto);
        formData.append('imagem', image);

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            atualizartabela();
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });

    $("#form-add-img").submit(function (event) {
        event.preventDefault();

        var idProduto = $('#btn-add-img').data('id-produto');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/adicionarimagem";

        var formData = new FormData();
        formData.append('id_produto', idProduto);
        formData.append('imagem', $('#input-add-image')[0].files[0]);

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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

            $("#modal-add-img").modal('hide');
            $("#input-add-image").val('');
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });

    $("#form-edit-product").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/atualizarproduto";

        var idProduto = $(this).data('id-produto');

        var formData = new FormData();
        formData.append('id_produto', idProduto);
        formData.append('nome', $('#edit-nome').val());
        formData.append('descricao', $('#edit-descricao').val());
        formData.append('categoria', $('#edit-categoria').val());
        formData.append('status', $('#edit-status').val());

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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

            $("#modal-confirm-edit-product").modal('hide');
            atualizartabela();
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });

    $("#form-add-variety").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/adicionarvariedade";

        var idProduto = $('#btn-add-variety').data('id-produto');

        var formData = new FormData();
        formData.append('id_produto', idProduto);
        formData.append('nome', $('#input-add-variety').val());

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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

            $("#modal-add-variety").modal('hide');
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });

    $("#form-delete-variety").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/deletarvariedade";

        var formData = new FormData();
        formData.append('id', $('#input-delete-variety-id').val());

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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

            $("#modal-confirm-delete-variety").modal('hide');
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });


    $("#form-delete-price").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/deletarpreco";

        var formData = new FormData();
        formData.append('id', $('#input-delete-price-id').val());

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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

            $("#modal-confirm-delete-price").modal('hide');
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });

    $("#form-add-price").submit(function (event) {
        event.preventDefault();
        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/adicionarpreco";

        var formData = new FormData();
        formData.append('id_variedade', $('#input-add-price-variety-id').val());
        formData.append('preco', $('#input-add-price-price').val());
        formData.append('id_tamanho', $('#input-add-price-size').val());

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });



    $("#form-edit-variety").submit(function (event) {
        event.preventDefault();
        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/atualizarvariedade";

        var formData = new FormData();
        formData.append('id', $('#input-edit-variety-id').val());
        formData.append('nome', $('#input-edit-variety-nome').val());
        formData.append('status', $('#input-edit-variety-status').val());

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });


    $("#addProductForm").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/addproduto";

        var formData = new FormData();
        formData.append('imagem', $('#add-foto')[0].files[0]);
        formData.append('nome', $('#add-nome').val());
        formData.append('preco', $('#add-preco').val());
        formData.append('descricao', $('#add-descricao').val());
        formData.append('status', $('#add-status').val());
        formData.append('categoria', $('#add-categoria').val());

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                Swal.fire({
                    title: data.message,
                    icon: 'success', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                      <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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
            else
                Swal.fire({
                    title: data.message,
                    icon: 'error', // add an error icon
                    iconColor: '#312eec', // make the icon blue
                    html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                    footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
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

            $('#add-foto').val('');
            $('#add-nome').val('');
            $('#add-preco').val('');
            $('#add-descricao').val('');
            $('#preview').attr('src', url + 'public/assets/style/basic/image/logos/logopng.png');

            $("#addProductModal").modal('hide');
            atualizartabela();
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });

    $('#search-control').on('input', function () {
        atualizartabela();
        atualizada = false;
    });

    $('#select-filter-search').on('change', function () {
        atualizartabela();
        atualizada = false;
    });


}

function atualizartabela() {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/atualizartabelaprodutos";



    var formData = new FormData();
    formData.append('chave', $('#select-filter-search').val());
    formData.append('parametro', $('#search-control').val());

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        $('#adm-table-row').html(data);
    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}

$(document).ready(function () {
    ligareventos();
});

function desligaeventos() {
    $('.tr-produto').off('click');
    $('.img-sec-gerenciamento').off('click');
    $('#btn-promove-img').off('click');
    $('#btn-confirm-delete-img').off('click');
    $('#form-add-img').off('submit');
    $('#form-edit-product').off('submit');
    $('#form-add-variety').off('submit');
    $('#form-delete-variety').off('submit');
    $('#form-delete-price').off('submit');
    $('#form-edit-variety').off('submit');
    $('#addProductForm').off('submit');
    $('#btn-confirm-delete-product').off('click');
    $('.addpreco-input').off('keydown');
    $('.addpreco-input').off('input');
    $('#add-foto').off('change');
    $('#select-filter-search').off('change');
    $('#search-control').off('input');
}

$(document).ready(function () {
    setInterval(function () {
        if (!atualizada) {
            desligaeventos();
            ligareventos();
            atualizada = true;
        }
    }, 1000);
});





