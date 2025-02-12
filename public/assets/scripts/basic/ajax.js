function atualizasaldo() {
    var url = document.URL.toLowerCase().split('cantinaonline+')[0];
    var formAction = url + "cantinaonline+/perfil/atualizarsaldo";

    formData=0;

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        $('.user-cash').html(data.saldo);
    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}

function atualizafoto() {
    var url = document.URL.toLowerCase().split('cantinaonline+')[0];
    var formAction = url + "cantinaonline+/perfil/atualizarfoto";

    formData=0;

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        $('img.profile-icon').attr("src", url+"cantinaonline+/media/profiles/"+data);

    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}

$(document).ready(function () {
    setInterval(atualizasaldo, 5000);
    setInterval(atualizafoto, 5000);
});

