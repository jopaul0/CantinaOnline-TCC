
//Função de trocar para a tela de cadastro
$(document).ready(function () {
  $("#cadastro").click(function () {
    $("#transition-custom").addClass('ative-custom');
    setTimeout(function () {
      $("#card-cadastro").removeClass("cadastro");
      $("#card-login").addClass("cadastro");
    }, 200);
    setTimeout(function () {
      $("#transition-custom").removeClass('ative-custom');
    }, 1000);
    $("#logo").addClass("cadastro");
  });

//Função de trocar para a tela de login
  $("#login").click(function () {
    $("#transition-custom").addClass('ative-custom');
    setTimeout(function () {
      $("#card-login").removeClass("cadastro");
      $("#card-cadastro").addClass("cadastro");
    }, 200);
    setTimeout(function () {
      $("#transition-custom").removeClass('ative-custom');
    }, 1000);
    $("#logo").removeClass("cadastro");
  });


//Ver senha
  $("#showPassword-cadastro").click(function () {
    if ($("#senha-cadastro").attr("type") === "password") {
      $("#senha-cadastro").attr("type", "text");
      $(this).removeClass("glyphicon-eye-open");
      $(this).addClass("glyphicon-eye-close");
    } else {
      $("#senha-cadastro").attr("type", "password");
      $(this).removeClass("glyphicon-eye-close");
      $(this).addClass("glyphicon-eye-open");
    }
  });


//Ver senha
  $("#showPassword-login").click(function () {
    if ($("#senha-logar").attr("type") === "password") {
      $("#senha-logar").attr("type", "text");
      $(this).removeClass("glyphicon-eye-open");
      $(this).addClass("glyphicon-eye-close");
    } else {
      $("#senha-logar").attr("type", "password");
      $(this).removeClass("glyphicon-eye-close");
      $(this).addClass("glyphicon-eye-open");
    }
  });


//Campos de input
//Mascarar o campo CPF
  var valorAnterior = '';
  var apagando = false;
  $('#cpf-cadastro').on('keydown', function (e) {
    if (e.which === 8 || e.which === 46) {
      apagando = true;
    }
  });
  $('#cpf-cadastro').on('input', function () {
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


//mascarar campo telefone

  $('#telefone-cadastro').on('keydown', function (e) {
    if (e.which === 8 || e.which === 46) {
      apagando = true;
    }
  });
  $('#telefone-cadastro').on('input', function () {
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


//Função para limitar o tamanho da senha
  $('#senha-cadastro').attr('maxlength', 12);

  $('#senha-logar').attr('maxlength', 12);
});

