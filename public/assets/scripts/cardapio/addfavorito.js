$(document).ready(function () {

    $(document).on('click', '.heart', function (event) {
        event.preventDefault();
        event.stopPropagation();

        var id = $(this).data('idproduto');

        var formData = new FormData();
        formData.append('id_produto', id);

        var url = document.URL.toLowerCase().split('cantinaonline')[0];
        var formAction = url + "CantinaOnline+/Produtos/adicionarfavorito";

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

        $(this).removeClass('heart');
        $(this).addClass('heart-favorite');
    });

    $(document).on('click', '.heart-favorite', function (event) {
        event.preventDefault();
        event.stopPropagation();

        var id = $(this).data('idproduto');

        var formData = new FormData();
        formData.append('id_produto', id);

        var url = document.URL.toLowerCase().split('cantinaonline+')[0];
        var formAction = url + "CantinaOnline+/Produtos/deletarfavorito";

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false
        }).fail(function (xhr, status, error) {
            alert(xhr.responseText);
        });

        $(this).removeClass('heart-favorite');
        $(this).addClass('heart');
    });

});