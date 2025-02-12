let atualizada = true;
function ligareventos() {
    $('#input-search-suport').on('input', function () {
        atualizartabela();
        atualizada = false;
    });

    //hover
  $('.edit-element').hover(
    function () {
      $(this).find('.background').fadeIn(200); // Mostra a faixa ao passar o mouse
    },
    function () {
      $(this).find('.background').fadeOut(200); // Oculta a faixa ao sair
    }
  );

  $('.edit-element').on('click', function () {
    $('#sidebar-elements').toggleClass('show');

    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/atualizarsidebarfaq";

    var id = $(this).data('id-faq');

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

  $("#form-edit-faq").submit(function (event) {
    event.preventDefault();

    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/editarfaq";
    var id = $(this).data('id-faq');

    var formData = new FormData();
    formData.append('id', id);
    formData.append('titulo', $('#edit-quest-info').val());
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
      atualizartabela();
      atualizada = false;
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });
}

function atualizartabela(){
    var url = document.URL.toLowerCase().split('admin')[0];
    var formAction = url + "admin/atualizarfaq";

    var formData = new FormData();
    formData.append('parametro', $('#input-search-suport').val());

    $.ajax({
        type: "POST",
        url: formAction,
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false
    }).done(function (data) {
        $('#faq').html(data);
    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });
}

$(document).ready(function () {
    ligareventos();
});
function desligaeventos() {
    $('#input-search-suport').off('input');
    $('.edit-element').off('hover');
    $('.edit-element').off('click');

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