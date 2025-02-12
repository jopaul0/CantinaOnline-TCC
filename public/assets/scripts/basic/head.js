$(document).ready(function () {

  //Menu
  //Rolagem do menu
  $(window).on("scroll", function () {
    var header = $('#desktop-header');
    if ($(this).scrollTop() > 0) {
      header.addClass('scroll-action');
    } else {
      header.removeClass('scroll-action');
    }
  });

  //Dropdown do cardapio

  $('#desktop-nav-categories').on('click', function (event) {
    event.preventDefault();
    $('#desktop-subnav-categories').toggleClass('show');
  });

  //barra de pesquisa normal
  $('#desktop-form-search').submit(function (event) {
    event.preventDefault();
    var formData = $('#desktop-input-search').val().replace(/ /g, "_");
    var url = document.URL.toLowerCase().split('cantinaonline+')[0] + 'CantinaOnline+';
    var formAction = url + "/Produtos/Buscar/" + formData;

    window.location.href = formAction;
  });



  //dropdown do perfil
  $('#desktop-profile-icon').on('click', function (event) {
    event.preventDefault();
    $('#desktop-profile-menu').toggleClass('show');
  });

  // Fecha o menu se o usuário clicar fora dele
  window.onclick = function (event) {
    if (!event.target.matches('.nav-link-custom')) {
      var dropdowns = document.getElementsByClassName('menu-nav-categories');
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  };
  window.addEventListener('click', function (event) {
    if (!event.target.matches('.profile-icon')) {
      var dropdowns = document.getElementsByClassName('profile-menu');
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  });

  //dropdown do perfil

  $('#cellphone-profile-icon').on('click', function (event) {
    event.preventDefault();
    $('#cellphone-profile-menu').toggleClass('show');
  });

  //dropdown do menu
  $('#arrow-down-menu').on('click', function (event) {
    $('#arrow-down-menu').toggleClass('rotate');
    if ($('#cellphone-nav-links').hasClass('show')) {
      $('#cellphone-nav-links').css({ 'display': 'flex !important' });
      setTimeout(function () {
        $('#cellphone-nav-links').removeClass('show');
      }, 10);
      setTimeout(function () {
        $('#cellphone-nav-links').css({ 'display': 'none' });
      }, 100);

    } else {
      $('#cellphone-nav-links').css({ 'display': 'flex' });
      setTimeout(function () {
        $('#cellphone-nav-links').addClass('show');
      }, 10);
    }
  });

  //dropdown do cardapio
  $('#cellphone-nav-categories').on('click', function (event) {
    $('#arrow-down-categories').toggleClass('rotate');
    if ($('#cellphone-subnav-categories').hasClass('show')) {
      $('#cellphone-subnav-categories').css({ 'display': 'flex !important' });
      setTimeout(function () {
        $('#cellphone-subnav-categories').removeClass('show');
      }, 10);
      setTimeout(function () {
        $('#cellphone-subnav-categories').css({ 'display': 'none' });
      }, 100);

    } else {
      $('#cellphone-subnav-categories').css({ 'display': 'flex' });
      setTimeout(function () {
        $('#cellphone-subnav-categories').addClass('show');
      }, 10);
    }
  });

  //barra de pesquisa
  $('#cellphone-form-search').submit(function (event) {
    event.preventDefault();
    var formData = $('#cellphone-input-search').val().replace(/ /g, "_");
    var url = document.URL.toLowerCase().split('cantinaonline+')[0] + 'CantinaOnline+';
    var formAction = url + "/Produtos/Buscar/" + formData;

    window.location.href = formAction;
  });

 









  //Responsivo Tablet
  //rolagem menu responsivo
  $(window).on("scroll", function () {
    var header_resopnsivo = $('#mediumscreen-header');
    if ($(this).scrollTop() > 0) {
      header_resopnsivo.addClass('scroll-action');
    } else {
      header_resopnsivo.removeClass('scroll-action');
    }
  });

  //barra de pesquisa responsiva
  $('#mediumscreen-form-search').submit(function (event) {
    event.preventDefault();
    var formData = $('#mediumscreen-input-search').val().replace(/ /g, "_");
    var url = document.URL.toLowerCase().split('cantinaonline+')[0] + 'CantinaOnline+';
    var formAction = url + "/Produtos/Buscar/" + formData;

    window.location.href = formAction;
  });

  //Dropdown do cardapio
  $('#mediumscreen-nav-categories').on('click', function (event) {
    event.preventDefault();
    $('#mediumscreen-subnav-categories').toggleClass('show');
  });

  //dropdown do perfil responsivo
  $('#mediumscreen-profile-icon').on('click', function (event) {
    event.preventDefault();
    $('#mediumscreen-profile-menu').toggleClass('show');
  });

});






