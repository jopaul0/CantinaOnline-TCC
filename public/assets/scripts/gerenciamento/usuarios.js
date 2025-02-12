let atualizada = true;


function ligareventos() {

    //Preview
    $('.edit-foto').on('change', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });

    //hovers
    $('.btn-editar-produto').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-primary');
        $(this).find('i').removeClass('text-primary');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-primary');
    });
    $('.btn-deletar-produto').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-danger');
        $(this).find('i').removeClass('text-danger');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-danger');
    });
    $('.btn-abrir-tabela').hover(function () {
        $(this).removeClass('btn-light');
        $(this).addClass('btn-dark');
        $(this).find('i').removeClass('text-dark');
        $(this).find('i').addClass('text-light');
    }, function () {
        $(this).removeClass('btn-dark');
        $(this).addClass('btn-light');
        $(this).find('i').removeClass('text-light');
        $(this).find('i').addClass('text-dark');
    });


    //Mascarar Campos
    var valorAnterior = '';
    var apagando = false;
    $('.editar-cpf').on('keydown', function (e) {
        if (e.which === 8 || e.which === 46) {
            apagando = true;
        }
    });
    $('.editar-cpf').on('input', function () {
        if (apagando) {
            apagando = false;
            return;
        }
        var valor = $(this).val().replace(/[.-]/g, ''); // remove . e -
        valor = valor.replace(/[a-zA-Z]/g, ''); // remove letras
        valor = valor.replace(/[^0-9]/g, ''); // remove caracteres não numéricos
        valor = valor.substring(0, 11); // limita a 12 caracteres

        var formato = '';
        if (valor.length > 0) formato += valor.substring(0, 3) + '.';
        if (valor.length > 3) formato += valor.substring(3, 6) + '.';
        if (valor.length > 6) formato += valor.substring(6, 9) + '-';
        if (valor.length > 9) formato += valor.substring(9);

        $(this).val(formato);
    });

    var valorAnterior = '';
    var apagando = false;
    $('.editar-telefone').on('keydown', function (e) {
        if (e.which === 8 || e.which === 46) {
            apagando = true;
        }
    });
    $('.editar-telefone').on('input', function () {
        if (apagando) {
            apagando = false;
            return;
        }
        var valor = $(this).val().replace(/[^\d]/g, ''); // remove caracteres não numéricos
        valor = valor.substring(0, 11); // limita a 11 caracteres

        var formato = '';
        if (valor.length > 0) formato += '(' + valor.substring(0, 2) + ')';
        if (valor.length > 2) formato += valor.substring(2, 7);
        if (valor.length > 6) formato += '-' + valor.substring(7);

        $(this).val(formato);
    });

    $(".editar-usuario-form").submit(function (event) {
        event.preventDefault();

        var idUsuario = $(this).data('usuario-id');

        var formData = new FormData();

        formData.append('cpf', idUsuario);
        formData.append('nome', $('#edit-nome-' + idUsuario).val());
        formData.append('sobrenome', $('#edit-sobrenome-' + idUsuario).val());
        formData.append('telefone', $('#edit-telefone-' + idUsuario).val());
        formData.append('email', $('#edit-email-' + idUsuario).val());
        formData.append('senha', $('#edit-senha-' + idUsuario).val());

        console.log('#edit-cpf-'+idUsuario);
        console.log($('#edit-cpf-' + idUsuario).val());
        console.log($('#edit-nome-' + idUsuario).val());
        console.log($('#edit-sobrenome-' + idUsuario).val());
        console.log($('#edit-telefone-' + idUsuario).val());
        console.log($('#edit-email-' + idUsuario).val());
        console.log($('#edit-senha-' + idUsuario).val());
   
        var fileInput = $('#edit-foto-'+ idUsuario)[0];
        if (fileInput) {
          if (fileInput.files && fileInput.files[0]) {
            formData.append('imagem', fileInput.files[0]);
          } else {
            formData.append('imagem', null);
          }
        } else {
          formData.append('imagem', null);
        }


      


    });
}

$(document).ready(function () {
    ligareventos();
});


$(document).ready(function () {
    setInterval(function () {
        if (!atualizada) {
            desligaeventos();
            ligareventos();
            atualizada = true;
        }
    }, 3000);
});