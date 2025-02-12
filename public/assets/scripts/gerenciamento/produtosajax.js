// Funções AJAX
function addProduto(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/addproduto";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}

function addImagem(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/adicionarimagem";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function addVariedade(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/adicionarvariedade";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function deleteImagem(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/deleteimagem";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function promoverimagem(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/promoverimagem";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function atualizarproduto(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/atualizarproduto";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function atualizarvariedade(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/atualizarvariedade";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function adicionarpreco(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/adicionarpreco";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function deletarvariedade(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/deletarvariedade";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}
function deletarpreco(formData) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/deletarpreco";

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}

function updateTabelaProdutos() {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/updatetabelaprodutos";

    return $.ajax({
        type: "POST",
        url: formAction,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}

function deleteProduto(idProduto) {
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/gerenciamento/deleteproduto";

    var formData = new FormData();
    formData.append('id', idProduto);

    return $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    });
}

