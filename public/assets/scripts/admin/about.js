let atualizada = true;
function ligareventos() {

  $('.edit-info').on('click', function () {
    $('#sidebar-elements').toggleClass('show');

    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/atualizarsidebarsobre";

    var id = $(this).data('id-info');

    var formData = new FormData();
    formData.append('id', id);

    $.ajax({
      type: "POST",
      url: formAction,
      dataType: 'JSON',
      data: formData,
      contentType: false,
      processData: false
    }).done(function (data) {
      $('#sidebar-elements').html(data);
      atualizada = false;
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });

  $("#form-edit-sobre").submit(function (event) {
    event.preventDefault();

    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/editarsobre";
    var id = $(this).data('id-info');

    var formData = new FormData();
    formData.append('id', id);
    formData.append('titulo', $('#edit-title-info').val());
    formData.append('texto', $('#edit-texto-info').val());

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
      atualizarsobre();
      atualizada = false;
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });
}

$(document).ready(function () {
  ligareventos();
});

function desligaeventos() {
  $('.edit-info').off('click');
  $('#form-edit-sobre').off('submit');
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

function atualizarsobre(){
  var url = document.URL.toLowerCase().split('admin')[0];
  var formAction = url + "admin/atualizarsobre";

  $.ajax({
    type: "POST",
    url: formAction,
    dataType: 'JSON',
    contentType: false,
    processData: false
  }).done(function (data) {
    $('#content-sobre').html(data);

  }).fail(function (xhr, status, error) {
    alert(xhr.responseText);
  });
}