function pagamento(formapagamento){
    var url = document.URL.toLowerCase().split('pedir')[0];
    var formAction = url + "pedir/pagamento";

    var formData = new FormData();
    formData.append('formapagamento', formapagamento);

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        $("#request-info-pay").html(data);
    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}

function enviarpedido(formapagamento, observacoes){
    var url = document.URL.toLowerCase().split('pedir')[0];
    var formAction = url + "pedir/enviarpedido";

    var formData = new FormData();
    formData.append('formapagamento', formapagamento);
    formData.append('observacoes', observacoes);

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        if (data.status == 'success')
            window.location.href = url + "Perfil";
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

    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}


$(document).ready(function () {
    pagamento($('#request-input-pay').val());

    //Contador de caracteres
    $('#request-input-obs').on('input', function () {
        var caracteresRestantes = 200 - $(this).val().length;
        $('#counter').text(caracteresRestantes + ' caracteres restantes');
    });

    $('#request-input-pay').change(function() {
        var formapagamento = $(this).val();
        pagamento(formapagamento);
    });

    $("#form-request").submit(function (event) {
        event.preventDefault();
        var formapagamento = $('#request-input-pay').val();
        var observacoes = $('#request-input-obs').val();
        enviarpedido(formapagamento,observacoes);
    });
});

