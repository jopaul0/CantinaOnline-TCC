
function adicionarcarrinho(formData) {
    var url = document.URL.toLowerCase().split('produtos')[0];
    var formAction = url + "Carrinho/adicionarproduto";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}

$(document).ready(function () {
    $("#form-carrinho").submit(function (event) {
        event.preventDefault();

        var formData = new FormData();
        formData.append('id_preco', $('#input-carrinho').val());
        formData.append('preco', $('#input-carrinho').find('option:selected').data('preco'));

        adicionarcarrinho(formData).done(function (data) {
            var url = document.URL.toLowerCase().split('produtos')[0];
            if (data.status == 'success') {
                window.location.href = url + "Carrinho";
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
});



