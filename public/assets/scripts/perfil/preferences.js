$(document).ready(function () {
    $("#form-preferences").submit(function (event) {
        event.preventDefault();

        var url = document.URL.toLowerCase().split('perfil')[0];
        var formAction = url + "perfil/editarpreferencias";
        
        var darkmode = $('#dark-mode').is(':checked');
        var notification = $('#notification-mode').is(':checked');

       

        var formData = new FormData();
        formData.append('formapagamento', $('#formpay-fav').val());
        if(darkmode) {
            formData.append('modoescuro', 'Escuro');
        }
        else{
            formData.append('modoescuro', 'Claro');
        }

        if(notification) {
            formData.append('notificacao', 'Sim');
        }
        else{
            formData.append('notificacao', 'Não');
        }

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
                      <button class="swal-btn-azul fechar-btn-modal" onclick="location.reload()">Atualizar</button>
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

        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

    });
});
