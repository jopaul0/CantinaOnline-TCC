$(document).ready(function () {
    $("#cadastrar").submit(function (event) {
        event.preventDefault();

        var jsonData = {
            "cpf": $("#cpf-cadastro").val(),
            "nome": $("#nome-cadastro").val(),
            "sobrenome": $("#sobrenome-cadastro").val(),
            "email": $("#email-cadastro").val(),
            "telefone": $("#telefone-cadastro").val(),
            "senha": $("#senha-cadastro").val()
        };

        var url = document.URL.toLowerCase().split('login')[0];
        var formAction = url + "login/registrar";


        $.ajax({
            type: "POST",
            url: formAction,
            data: JSON.stringify(jsonData),
            contentType: "application/json; charset=utf-8",
            dataType: 'JSON'
        }).done(function (data) {
            if (data.status == 'success')
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
            alert(xhr.responseText)
        });
    });


    $("#logar").submit(function (event) {
        event.preventDefault();

        var formData = new FormData();
        formData.append('usuario', $("#usuario-logar").val());
        formData.append('senha', $("#senha-logar").val());

        var url = document.URL.toLowerCase().split('login')[0];
        var formAction = url + "login/logar";
        
        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).done(function (data) {
            if (data.status == 'success')
                window.location.href = url;
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
