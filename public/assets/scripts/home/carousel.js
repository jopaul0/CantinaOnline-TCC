$(document).ready(function () {
    //Variáveis que comandam o carrossel
    let currentImageIndex = 0;
    const $images = $('#carousel img');
    const $indicators = $('#carousel-indicators input');
    const totalImages = $images.length;

    //função que exibe a imagem
    function showImage(index) {
        const translateX = -index * 100;
        $('#carousel-inside').css('transform', `translateX(${translateX}vw)`);
        $indicators.prop('checked', false).eq(index).prop('checked', true);
    }

    //função que volta para a imagem anterior
    function prevImage() {
        currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : totalImages - 1;
        showImage(currentImageIndex);
    }

    //função que passa para a próxima imagem
    function nextImage() {
        currentImageIndex = (currentImageIndex < totalImages - 1) ? currentImageIndex + 1 : 0;
        showImage(currentImageIndex);
    }

    //aplicação das funções
    $('#before').click(prevImage);
    $('#next').click(nextImage);
    $indicators.click(function () {
        currentImageIndex = $(this).data('index');
        showImage(currentImageIndex);
    });

    // Muda a imagem automaticamente a cada 5 segundos
    setInterval(nextImage, 10000);

    // Adiciona funcionalidade de arrastar ao carrossel
    let isDragging = false;
    let startPosX = 0;
    let currentTranslate = 0;

    $("#carousel").on("mousedown touchstart", function (e) {
        isDragging = true;
        startPosX = e.type === "touchstart" ? e.touches[0].clientX : e.clientX;
        currentTranslate = 0;
    });
    $("#carousel").on("mousemove touchmove", function (e) {
        if (!isDragging) return;
        let currentPosX = e.type === "touchmove" ? e.touches[0].clientX : e.clientX;
        let diff = currentPosX - startPosX;
        currentTranslate = diff;
    });
    $("#carousel").on("mouseup touchend", function () {
        if (!isDragging) return;
        isDragging = false;
        if (currentTranslate < -50) {
            nextImage();
        } else if (currentTranslate > 50) {
            prevImage();
        }
    });
    $("#carousel").on("mouseleave", function () {
        isDragging = false;
    });
});