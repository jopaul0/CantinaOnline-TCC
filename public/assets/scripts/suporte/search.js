let atualizada = true;
function ligareventos() {
    $('#input-search-suport').on('input', function () {
        atualizartabela();
        atualizada = false;
    });
}

function atualizartabela(){
    var url = document.URL.toLowerCase().split('suporte')[0];
    var formAction = url + "suporte/atualizarfaq";

    var formData = new FormData();
    formData.append('parametro', $('#input-search-suport').val());

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        $('#faq').html(data);
    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}

$(document).ready(function () {
    ligareventos();
});
function desligaeventos() {
    $('#input-search-suport').off('input');

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