let atualizada = true;
function ligareventos() {

  //hover
  $('.edit-element').hover(
    function () {
      $(this).find('.edit-hover').fadeIn(200); // Mostra a faixa ao passar o mouse
    },
    function () {
      $(this).find('.edit-hover').fadeOut(200); // Oculta a faixa ao sair
    }
  );



  //PARA O CAROUSEL
  $('#carousel-inside').on('click', function () {
    $('#sidebar-elements').toggleClass('show');

    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/atualizarsidebarcarousel";

    $.ajax({
      type: "POST",
      url: formAction,
      dataType: 'JSON',
      contentType: false,
      processData: false
    }).done(function (data) {
      $('#sidebar-elements').html(data);
      atualizada = false;
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });


  $('.edit-banner').on('change', function () {
    var file = this.files[0];
    var reader = new FileReader();
    var id = $(this).data('id-banner');
    reader.onload = function (e) {
      $('#img-banner-' + id).attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  });



  $(".form-banner").submit(function (event) {
    event.preventDefault();

    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/editarbanner";
    var id = $(this).data('id-banner');
    console.log('#edit-banner-' + id);

    var formData = new FormData();
    formData.append('id_banner', id);
    formData.append('imagem', $('#edit-banner-' + id)[0].files[0]);

    $.ajax({
      type: "POST",
      url: formAction,
      data: formData,
      dataType: 'JSON',
      contentType: false,
      processData: false
    }).done(function (data) {
      if (data.status == 'success')
        Swal.fire({
          title: data.message,
          icon: 'success', // add an error icon
          iconColor: '#312eec', // make the icon blue
          html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
          footer: `
              <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
            `,
          showCancelButton: false, // remove the default "Cancel" button
          showConfirmButton: false, // remove the default "OK" button
          width: '40em', // adjust modal width
          background: '#fef66e', // yellow background
          customClass: {
            container: 'swal-modal-amarelo',
            icon: 'icon-modal-custom',
            footer: 'footer-modal-logar' // custom class for the modal
          }
        });
      else
        Swal.fire({
          title: data.message,
          icon: 'error', // add an error icon
          iconColor: '#312eec', // make the icon blue
          html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
          footer: `
          <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
        `,
          showCancelButton: false, // remove the default "Cancel" button
          showConfirmButton: false, // remove the default "OK" button
          width: '40em', // adjust modal width
          background: '#fef66e', // yellow background
          customClass: {
            container: 'swal-modal-amarelo',
            icon: 'icon-modal-custom',
            footer: 'footer-modal-logar' // custom class for the modal
          }
        });
      atualizarcarrossel();
      atualizada = false;
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });

  //PARA OS CARDS
  $('.card').on('click', function () {
    console.log('a');
    $('#sidebar-elements').toggleClass('show');


    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/atualizarsidebarcard";
    var id = $(this).data('card-id');
    var formData = new FormData();
    formData.append('id_card', id);


    $.ajax({
      type: "POST",
      url: formAction,
      data: formData,
      dataType: 'JSON',
      contentType: false,
      processData: false
    }).done(function (data) {
      $('#sidebar-elements').html(data);
      atualizada = false;
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });

  $('#edit-card-img').on('change', function () {
    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#sidebar-img-card').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  });


  $('#form-edit-card').submit(function (event) {
    event.preventDefault();

    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/editarcard";
    var id = $(this).data('card-id');

    var formData = new FormData();
    formData.append('card-id', id);
    formData.append('imagem', $('#edit-card-img')[0].files[0]);
    formData.append('titulo', $('#edit-card-title').val());
    formData.append('ancora', $('#edit-card-ancora').val());
    formData.append('texto', $('#edit-card-info').val());

    $.ajax({
      type: "POST",
      url: formAction,
      data: formData,
      dataType: 'JSON',
      contentType: false,
      processData: false
    }).done(function (data) {
      if (data.status == 'success')
        Swal.fire({
          title: data.message,
          icon: 'success', // add an error icon
          iconColor: '#312eec', // make the icon blue
          html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
          footer: `
                <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
              `,
          showCancelButton: false, // remove the default "Cancel" button
          showConfirmButton: false, // remove the default "OK" button
          width: '40em', // adjust modal width
          background: '#fef66e', // yellow background
          customClass: {
            container: 'swal-modal-amarelo',
            icon: 'icon-modal-custom',
            footer: 'footer-modal-logar' // custom class for the modal
          }
        });
      else
        Swal.fire({
          title: data.message,
          icon: 'error', // add an error icon
          iconColor: '#312eec', // make the icon blue
          html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
          footer: `
            <button class="swal-btn-azul fechar-btn-modal" onclick="swal.close()">Fechar</button>
          `,
          showCancelButton: false, // remove the default "Cancel" button
          showConfirmButton: false, // remove the default "OK" button
          width: '40em', // adjust modal width
          background: '#fef66e', // yellow background
          customClass: {
            container: 'swal-modal-amarelo',
            icon: 'icon-modal-custom',
            footer: 'footer-modal-logar' // custom class for the modal
          }
        });
      atualizarcards();
      atualizada = false;
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });




  //Fechar barra lateral
  $(document).on('click', function (event) {
    if ($(event.target).closest('#sidebar-elements').length === 0 && $(event.target).closest('.edit-element').length === 0) {
      $('#sidebar-elements').removeClass('show');
    }
  });





}



$(document).ready(function () {
  ligareventos();
});

function desligaeventos() {
  $('.edit-element').off('hover');
  $('#carousel-inside').off('click');
  $(document).off('click');
  $('.edit-banner').off('change');
  $('.form-banner').off('submit');
  $('#form-edit-card').off('submit');
  $('.card').off('click');
  $('#edit-card-img').off('change');

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

function atualizarcarrossel() {
  var url = document.URL.toLowerCase().split('admin')[0];
  var formAction = url + "admin/atualizarcarrossel";

  $.ajax({
    type: "POST",
    url: formAction,
    dataType: 'JSON',
    contentType: false,
    processData: false
  }).done(function (data) {
    $('.carousel-adm').html(data);

  }).fail(function (xhr, status, error) {
    alert(xhr.responseText);
  });
}

function atualizarcards() {
  var url = document.URL.toLowerCase().split('admin')[0];
  var formAction = url + "admin/atualizarcards";

  $.ajax({
    type: "POST",
    url: formAction,
    dataType: 'JSON',
    contentType: false,
    processData: false
  }).done(function (data) {
    $('#home-custom-cards').html(data);
    console.log('s');
  }).fail(function (xhr, status, error) {
    alert(xhr.responseText);
  });
}