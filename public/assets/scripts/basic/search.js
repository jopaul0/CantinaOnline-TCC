$(document).ready(function () {

    $(document).on('click', '.search-suggestions-items', function () {
        $('#desktop-input-search').val($(this).text());
        $('#search-suggestions').addClass('d-none');
    });

    $('#desktop-input-search').on('input', function () {
        var query = $(this).val();
        var jsonData = {
            "query": query
        };
        var url = document.URL.toLowerCase().split('cantinaonline+')[0];
        var formAction = url + "cantinaonline+/home/search";
        if (query.length > 2) {
            $.ajax({
                type: "POST",
                url: formAction,
                data: JSON.stringify(jsonData),
                contentType: "application/json; charset=utf-8",
                dataType: 'JSON'
            }).done(function (data) {
                if (data.length > 0) {
                    $('#search-suggestions').removeClass('d-none');
                    $('#search-suggestions').html(data);
                }
            }).fail(function (xhr, status, error) {
                alert(xhr.responseText)
            });
        } else {
            $('#search-suggestions').addClass('d-none');
        }
    });




    $(document).on('click', '.search-suggestions-items', function () {
        $('#cellphone-input-search').val($(this).text());
        $('#cellphone-search-suggestions').addClass('d-none');
    });

    $('#cellphone-input-search').on('input', function () {
        var query = $(this).val();
        var jsonData = {
            "query": query
        };
        var url = document.URL.toLowerCase().split('cantinaonline+')[0];
        var formAction = url + "cantinaonline+/home/search";
        if (query.length > 2) {
            $.ajax({
                type: "POST",
                url: formAction,
                data: JSON.stringify(jsonData),
                contentType: "application/json; charset=utf-8",
                dataType: 'JSON'
            }).done(function (data) {
                if (data.length > 0) {
                    $('#cellphone-search-suggestions').removeClass('d-none');
                    $('#cellphone-search-suggestions').html(data);
                }
            }).fail(function (xhr, status, error) {
                alert(xhr.responseText)
            });
        } else {
            $('#cellphone-search-suggestions').addClass('d-none');
        }
    });



    $(document).on('click', '.search-suggestions-items', function () {
        $('#mediumscreen-input-search').val($(this).text());
        $('#mediumscreen-search-suggestions').addClass('d-none');
    });

    $('#mediumscreen-input-search').on('input', function () {
        var query = $(this).val();
        var jsonData = {
            "query": query
        };
        var url = document.URL.toLowerCase().split('cantinaonline+')[0];
        var formAction = url + "cantinaonline+/home/search";
        if (query.length > 2) {
            $.ajax({
                type: "POST",
                url: formAction,
                data: JSON.stringify(jsonData),
                contentType: "application/json; charset=utf-8",
                dataType: 'JSON'
            }).done(function (data) {
                if (data.length > 0) {
                    $('#mediumscreen-search-suggestions').removeClass('d-none');
                    $('#mediumscreen-search-suggestions').html(data);
                }
            }).fail(function (xhr, status, error) {
                alert(xhr.responseText)
            });
        } else {
            $('#mediumscreen-search-suggestions').addClass('d-none');
        }
    });

});