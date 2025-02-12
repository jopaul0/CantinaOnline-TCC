let atualizada = true;


function ligareventos() {

  //Mascara o input
  $(".product-quantity").on("input", function () {
    var valor = $(this).val();
    var regex = /^[1-9][0-9]*$/; // apenas números inteiros positivos
    if (!regex.test(valor)) {
      $(this).val(1); // limpar o campo se não for um número inteiro positivo
    } else if (parseInt(valor) > 25) {
      $(this).val(25); // limitar o valor a 25
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




  //Altera a quantidade no banco 
  $('.product-quantity').on('change', function () {
    var idPreco = $(this).data('preco-id');
    var Preco = $(this).data('preco');
    var valor = $(this).val();

    var formData = new FormData();
    formData.append('id_preco', idPreco);
    formData.append('preco', Preco);
    formData.append('quantidade', valor);

    updateQuantidade(formData).done(function (data) {
      if (data.status == 'error') alert();
      else  updateCarrinho().done(function (data) {
        $('#corpo-carrinho').empty();
        $('#corpo-carrinho').html(data.tabela);
        atualizada = false;
      }).fail(function (xhr, status, error) {
        alert(xhr.responseText);
      });
    }).fail(function (xhr, status, error) {
      alert(xhr.responseText);
    });
  });



   //Botão de remover itens do carrinho 
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


//Faz os eventos ligarem (A tela é dinâmica)
$(document).ready(function () {
  ligareventos();
});


//Ajax e tals
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
