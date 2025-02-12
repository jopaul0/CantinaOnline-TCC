let atualizada = true;
function ligareventos() {

    //Abrir barra lateral
    $('.tr-pedido').on('click', function () {
        $('#sidebar-request').toggleClass('show');
        var idpedido = $(this).data('id-pedido');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/atualizarsidebarpedido";

        var formData = new FormData();
        formData.append('id_pedido', idpedido);

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            $('#sidebar-request').html(data);
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });


    //Fechar barra lateral
    $(document).on('click', function (event) {
        if ($(event.target).closest('#sidebar-request').length === 0 && $(event.target).closest('.tr-pedido').length === 0) {
            $('#sidebar-request').removeClass('show');
        }
    });


    $("#form-edit-status").submit(function (event) {
        event.preventDefault();
        var idpedido = $(this).data('id-pedido');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/editarstatuspedido";

        var formData = new FormData();
        formData.append('id_pedido', idpedido);
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
            atualizartabela();
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });

    $('#btn-confirm-payday').on('click', function () {
        var idpedido = $("#btn-add-payday").data('id-pedido');

        var url = document.URL.toLowerCase().split('admin')[0];
        var formAction = url + "admin/adicionarpagamento";

        var formData = new FormData();
        formData.append('id_pedido', idpedido);

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
            $("#modal-confirm-payday").modal('hide');
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
    var formAction = url + "admin/atualizartabelapedidos";

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
    $('.tr-pedido').off('click');
    $('#form-edit-status').off('submit');
    $('#btn-confirm-payday').off('click');
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