function notificacao(){
    var notificacao = $('#home-notificacao');

    notificacao.removeClass('d-none');
    notificacao.addClass('fade-in');

    setTimeout(function() {
        notificacao.removeClass('fade-in');

        setTimeout(function() {
            notificacao.addClass('fade-out');
            setTimeout(function() {
                notificacao.removeClass('fade-out');
                notificacao.addClass('d-none');
            }, 1000);
        }, 3000);
    }, 1000);
}


function notificar(){
    var url = document.URL.toLowerCase().split('cantinaonline+')[0];
    var formAction = url + "cantinaonline+/home/notificacao";

    formData=0;

     $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        if(data.status=='success'){
            $("#notification").html(data.message);
            notificacao();
            console.log('Tá indo, poha!');
        }
    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}

$(document).ready(function () {
    setInterval(notificar, 7000);
});