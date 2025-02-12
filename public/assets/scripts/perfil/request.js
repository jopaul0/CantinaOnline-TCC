let atualizada = true;
function ligareventos() {

    $(".btn-toggle-modal-request").on('click', function (event) {
        var idpedido = $(this).data('id-pedido');

        $("#input-id-pedido").val(idpedido);
    });

    $("#btn-confirm-cancel-request").on('click', function (event) {
        var idpedido = $("#input-id-pedido").val();

        var url = document.URL.toLowerCase().split('perfil')[0];
        var formAction = url + "perfil/cancelarpedido";

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
            $('#modal-confirm-cancel-request').modal('hide');
            atualizada = false;
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });


}


function atualizartabela(){
    var url = document.URL.toLowerCase().split('perfil')[0];
    var formAction = url + "perfil/atualizartabelapedidos";



    var formData = 0;

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        $('#profile-container-request').html(data);
    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}


$(document).ready(function () {
    ligareventos();
});

function desligaeventos() {
    $(".btn-toggle-modal-request").off('click');


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