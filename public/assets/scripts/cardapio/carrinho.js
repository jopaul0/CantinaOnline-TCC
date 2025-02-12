let atualizada = true;


function ligareventos() {
  setInterval(function () {
    var precos = $('.preco');
    var subtotal = 0;

    precos.each(function () {
      var precos = parseFloat($(this).text());
      subtotal += precos;
    });

    $('#subtotal').html(subtotal.toFixed(2));

  }, 1000);

  $(".product-quantity").on("input", function () {
    var valor = $(this).val();
    var regex = /^[1-9][0-9]*$/; // apenas números inteiros positivos
    if (!regex.test(valor)) {
      $(this).val(1); // limpar o campo se não for um número inteiro positivo
    }
  });

  $(".product-quantity").focus(function () {
    $(this).select();
  });
  $('.product-quantity').blur(function () {
    var valor = $(this).val();
    if (valor === '') {
      $(this).val(1); // Defina o valor padrão se o input estiver vazio
    }
  });

  $(".product-quantity").keydown(function (event) {
    if (event.keyCode === 8 || event.keyCode === 46) { // 8 = backspace, 46 = delete
      event.preventDefault();
    }
  });

  $('.product-quantity').on('change', function () {
    var idPreco = $(this).data('preco-id');
    var valor = $(this).val();
    var preco = parseFloat($(this).data('preco'));
    var precoNovo = preco * valor;

    $('#preco-' + idPreco).html(precoNovo.toFixed(2));
  });

  $('.product-quantity').on('change', function () {
    var idPreco = $(this).data('preco-id');
    var valor = $(this).val();

    var formData = new FormData();
    formData.append('id_preco', idPreco);
    formData.append('quantidade', valor);

    updateQuantidade(formData).done(function (data) {
      if(data.status=='error') alert();
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });

  $("#form-fazerpedido").submit(function (event) {
    event.preventDefault();

    var formData = new FormData();
    formData.append('id_formapagamento', $('#add-formapagamento').val());

    fazerPedido(formData).done(function (data) {
        var url = document.URL.toLowerCase().split('carrinho')[0];
        if (data.status == 'success') {

            $('#modal-fazerpedido').modal('hide');
            Swal.fire({
                title: data.message,
                icon: 'success', // add an error icon
                iconColor: '#312eec', // make the icon blue
                html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                footer: `
                  <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
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

            updateCarrinho().done(function (data) {
              $('#corpo-carrinho').empty();
              $('#corpo-carrinho').html(data.tabela);
              atualizada = false;
            }).fail(function (xhr, status, error) {
              alert(xhr.responseText);
            });
        }

        else
            Swal.fire({
                title: data.message,
                icon: 'error', // add an error icon
                iconColor: '#312eec', // make the icon blue
                html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
                footer: `
              <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
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

    }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
    });


});

  $('.btn-removeritem').on('click', function () {
    var idPreco = $(this).data('preco-id');

    var formData = new FormData();
    formData.append('id_preco', idPreco);

    removeritem(formData).done(function (data) {
      var url = document.URL.toLowerCase().split('carrinho')[0];
      if (data.status == 'success') {
        Swal.fire({
          title: data.message,
          icon: 'success', // add an error icon
          iconColor: '#312eec', // make the icon blue
          html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
          footer: `
              <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
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

        updateCarrinho().done(function (data) {
          $('#corpo-carrinho').empty();
          $('#corpo-carrinho').html(data.tabela);
          atualizada = false;
        }).fail(function (xhr, status, error) {
          alert(xhr.responseText);
        });
      }

      else
        Swal.fire({
          title: data.message,
          icon: 'error', // add an error icon
          iconColor: '#312eec', // make the icon blue
          html: '<img src="' + url + 'public/assets/style/basic/image/logos/logopng.png" class="logo-modal"></img>',
          footer: `
            <button class="swal-btn-azul fechar-btn-modal" onclick="Swal.close()">Fechar</button>
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

    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });


  });
}



$(document).ready(function () {
  ligareventos();
});

function removeritem(formData) {
  var url = document.URL.toLowerCase().split('carrinho')[0];
  var formAction = url + "Carrinho/removeritem";

  return $.ajax({
    type: "POST",
    url: formAction,
    data: formData,
    dataType: 'JSON',
    contentType: false,
    processData: false
  });
}

function updateCarrinho() {
  var url = document.URL.toLowerCase().split('carrinho')[0];
  var formAction = url + "Carrinho/atualizarcarrinho";

  return $.ajax({
    type: "POST",
    url: formAction,
    dataType: 'JSON',
    contentType: false,
    processData: false
  });
}
function updateQuantidade(formData) {
  var url = document.URL.toLowerCase().split('carrinho')[0];
  var formAction = url + "Carrinho/atualizarquantidade";

  return $.ajax({
    type: "POST",
    url: formAction,
    data: formData,
    dataType: 'JSON',
    contentType: false,
    processData: false
  });
}
function fazerPedido(formData) {
  var url = document.URL.toLowerCase().split('carrinho')[0];
  var formAction = url + "Carrinho/fazerpedido";

  return $.ajax({
    type: "POST",
    url: formAction,
    data: formData,
    dataType: 'JSON',
    contentType: false,
    processData: false
  });
}

function desligaeventos() {
  $('.product-quantity').off('keydown');
  $('.product-quantity').off('input');
  $('.product-quantity').off('focus');
  $('.product-quantity').off('blur');
  $('.product-quantity').off('change');
  $('.btn-removeritem').off('click');
}

$(document).ready(function () {
  setInterval(function () {
    if (!atualizada) {
      desligaeventos();
      ligareventos();
      atualizada = true;
    }
  }, 3000);
});
