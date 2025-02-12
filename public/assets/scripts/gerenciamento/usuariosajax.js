function editarusuario(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/editarusuario";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function deletarusuario(cpfUsuario) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/deletarusuario";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}

function updateTabelaUsuarios() {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/updatetabelausuarios";

    return $.ajax({
        type: "POST",
        url: formAction,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}