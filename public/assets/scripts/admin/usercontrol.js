let atualizada = true;
function ligareventos() {

    //Abrir barra lateral
    $('.tr-usuario').on('click', function () {
        $('#sidebar-users').toggleClass('show');
        var idusuario = $(this).data('id-usuario');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/atualizarsidebarusuario";

        var formData = new FormData();
        formData.append('id_usuario', idusuario);

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            $('#sidebar-users').html(data);
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });

    //Fechar barra lateral
    $(document).on('click', function (event) {
        if ($(event.target).closest('#sidebar-users').length === 0 && $(event.target).closest('.tr-usuario').length === 0) {
            $('#sidebar-users').removeClass('show');
        }
    });

    $('#search-control').on('input', function () {
        atualizartabela();
        atualizada = false;
    });

    $('#select-filter-search').on('change', function () {
        atualizartabela();
        atualizada = false;
    });

    $('#edit-image').on('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });

    $('#btn-confirm-delete-image').on('click', function (event) {
        var idusuario = $('#btn-delete-image').data('id-usuario');
        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/deletarimagemusuario";

        var formData = new FormData();
        formData.append('id_usuario', idusuario);

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
            $("#modal-confirm-delete-image").modal('hide');
            atualizartabela();
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });
    });

    $("#form-edit-user").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/editarusuario";

        var idusuario = $(this).data('id-usuario');

        var formData = new FormData();

        formData.append('id_usuario', idusuario);
        formData.append('nome', $('#edit-name').val());
        formData.append('sobrenome', $('#edit-lastname').val());
        formData.append('cpf', $('#edit-cpf').val());
        formData.append('telefone', $('#edit-phone').val());
        formData.append('email', $('#edit-email').val());
        formData.append('senha', $('#edit-password').val());
        formData.append('status', $('#edit-status').val());
        formData.append('saldo', $('#edit-cash').val());
        formData.append('imagem', $('#edit-image')[0].files[0]);


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

    //Mascarar o campo CPF
    var valorAnterior = '';
    var apagando = false;
    $('#edit-cpf').on('keydown', function (e) {
        if (e.which === 8 || e.which === 46) {
            apagando = true;
        }
    });
    $('#edit-cpf').on('input', function () {
        if (apagando) {
            apagando = false;
            return;
        }
        var valor = $(this).val().replace(/[.-]/g, ''); // remove . e -
        valor = valor.replace(/[a-zA-Z]/g, ''); // remove letras
        valor = valor.replace(/[^0-9]/g, ''); // remove caracteres não numéricos
        valor = valor.substring(0, 11); // limita a 12 caracteres

        var formato = '';
        if (valor.length > 0) formato += valor.substring(0, 3) + '.';
        if (valor.length > 3) formato += valor.substring(3, 6) + '.';
        if (valor.length > 6) formato += valor.substring(6, 9) + '-';
        if (valor.length > 9) formato += valor.substring(9);

        $(this).val(formato);
    });


    $('#edit-phone').on('keydown', function (e) {
        if (e.which === 8 || e.which === 46) {
            apagando = true;
        }
    });
    $('#edit-phone').on('input', function () {
        if (apagando) {
            apagando = false;
            return;
        }
        var valor = $(this).val().replace(/[^\d]/g, ''); // remove caracteres não numéricos
        valor = valor.substring(0, 11); // limita a 11 caracteres

        var formato = '';
        if (valor.length > 0) formato += '(' + valor.substring(0, 2) + ')';
        if (valor.length > 2) formato += valor.substring(2, 7);
        if (valor.length > 6) formato += '-' + valor.substring(7);

        $(this).val(formato);
    });

    // Mascarar campos
    var valorAnterior = '';
    var apagando = false;
    $('#edit-cash').on('keydown', function (e) {
        if (e.which === 8 || e.which === 46) {
            apagando = true;
        }
    });
    $('#edit-cash').on('input', function () {
        if (apagando) {
            apagando = false;
            return;
        }

        var valor = $(this).val().replace(/[.-]/g, ''); // remove . e -
        valor = valor.replace(/[a-zA-Z]/g, ''); // remove letras
        valor = valor.replace(/[^0-9]/g, ''); // remove caracteres não numéricos
        valor = valor.substring(0, 7); // limita a 5 caracteres

        var formato = '';
        if (valor.length > 0) {
            formato += valor.substring(0, 4) + '.' + valor.substring(4, 6);
        } else formato = valor;

        $(this).val(formato);
    });
    $('#edit-password').on('input', function () {
        // Limita o valor a 12 caracteres
        if ($(this).val().length > 12) {
            $(this).val($(this).val().substring(0, 12));
        }
    });

    $("#form-msg-user").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/enviarmensagem";

        var idusuario = $(this).data('id-usuario');

        var formData = new FormData();

        formData.append('id_usuario', idusuario);
        formData.append('titulo', $('#msg-title').val());
        formData.append('conteudo', $('#msg-text').val());


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
}



function atualizartabela() {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/atualizartabelausuario";

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
    $('.tr-usuario').off('click');
    $('#select-filter-search').off('change');
    $('#search-control').off('input');
    $('#edit-image').off('change');
    $('#form-edit-user').off('submit');
    $('#form-msg-user').off('submit');
    $('#btn-confirm-delete-image').off('click');
    $('#edit-cpf').off('keydown');
    $('#edit-cpf').off('input');
    $('#edit-phone').off('keydown');
    $('#edit-phone').off('input');
    $('#edit-cash').off('keydown');
    $('#edit-cash').off('input');
    $('#edit-password').off('input');

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