$(document).ready(function () {

  $('#name-profile').hover(
    function () {
      // Code to execute on mouseover
      $('#row-name i').removeClass('d-none');
    },
    function () {
      // Code to execute on mouseout
      $('#row-name i').addClass('d-none');
    }
  );

  $('#cellphone-profile').hover(
    function () {
      // Code to execute on mouseover
      $('#row-cellphone i').removeClass('d-none');
    },
    function () {
      // Code to execute on mouseout
      $('#row-cellphone i').addClass('d-none');
    }
  );

  $('#email-profile').hover(
    function () {
      // Code to execute on mouseover
      $('#row-email i').removeClass('d-none');
    },
    function () {
      // Code to execute on mouseout
      $('#row-email i').addClass('d-none');
    }
  );

  $('#password-profile').hover(
    function () {
      // Code to execute on mouseover
      $('#row-password i').removeClass('d-none');
    },
    function () {
      // Code to execute on mouseout
      $('#row-password i').addClass('d-none');
    }
  );

  $('#foto-perfil').hover(
    function () {
      // Code to execute on mouseover
      $('#img-hover').removeClass('d-none');
    },
    function () {
      // Code to execute on mouseout
      $('#img-hover').addClass('d-none');
    }
  );

  $('#nubank-eye').on('click', function () {
    if ($('#nubank-eye').hasClass('fa-eye')) {
      $('#nubank-eye').removeClass('fa-eye').addClass('fa-eye-slash');
      $('#cpf-profile').addClass('d-none');
      $('#password-profile').addClass('d-none');
      $('.info-ocult').removeClass('d-none');

    }
    else {
      $('#nubank-eye').removeClass('fa-eye-slash').addClass('fa-eye');
      $('#cpf-profile').removeClass('d-none');
      $('#password-profile').removeClass('d-none');
      $('.info-ocult').addClass('d-none');
    }
  });

  $('#foto-perfil').click(function () {
    $('#modal-edit-image').modal('show');
  });

  $('#name-profile').click(function () {
    $('#modal-edit-name').modal('show');
  });
  $('#cpf-profile').click(function () {
    $('#modal-edit-cpf').modal('show');
  });
  $('#cellphone-profile').click(function () {
    $('#modal-edit-cellphone').modal('show');
  });
  $('#email-profile').click(function () {
    $('#modal-edit-email').modal('show');
  });
  $('#password-profile').click(function () {
    $('#modal-edit-password').modal('show');
  });

  //Preview da foto
  $(document).ready(function () {
    $('#input-edit-image').on('change', function () {
      var file = this.files[0];
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      };
      reader.readAsDataURL(file);
    });
  });

  $('#input-edit-password').attr('maxlength', 12);
});

//mascarar telefone
$(document).ready(function() {
  var valorAnterior = '';
  var apagando = false;
  $('#input-edit-cellphone').on('keydown', function(e) {
    if (e.which === 8 || e.which === 46) {
      apagando = true;
    }
  });
  $('#input-edit-cellphone').on('input', function() {
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
});

//mascarar telefone
$(document).ready(function() {
  //Mascarar o campo CPF
  var valorAnterior = '';
  var apagando = false;
  $('#input-edit-cpf').on('keydown', function (e) {
    if (e.which === 8 || e.which === 46) {
      apagando = true;
    }
  });
  $('#input-edit-cpf').on('input', function () {
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
});

