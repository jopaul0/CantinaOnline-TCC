$(document).ready(function () {
  $('.table-row-link').on('click', function () {
    window.location.href = $(this).data('href');
  });

  $('.table-row-link').hover(function () {
    $(this).find('td').css('background-color', '#f0f0f0'); /* muda a cor de fundo das células da linha */
  }, function () {
    $(this).find('td').css('background-color', ''); /* volta ao estilo original */
  });


  $('#copy-link-btn').on('click', function () {
    const link = window.location.href;
    const $temp = $("<input>");
    $("body").append($temp);
    $temp.val(link).select();
    document.execCommand("copy");
    $temp.remove();
    $('#feedback-text').text("Link copiado com sucesso!").fadeIn(500).delay(2000).fadeOut(500);
  });

  $('.img-product-preview').on('click', function () {
    var src = $(this).attr('src');
    $('#img-product').attr('src', src);
    $(this).addClass('img-selected').siblings().removeClass('img-selected');
  });
});

