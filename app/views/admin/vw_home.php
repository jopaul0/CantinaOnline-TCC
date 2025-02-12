<?php
//Aquivo que detecta a rota do projeto
require './app/scripts/DirUrl.php';
?>

<div id="sidebar-elements"
    class="shadow background overflow-y-auto d-flex flex-column justify-content-start gap-4 sidebar-control">

</div>


<h1 class="text-custom text-center p-3 m-3">Área do Admin</h1>

<div class="carousel-adm m-auto">
    <!--Carrossel-->
    <div id="carousel" class="rounded cursor-pointer edit-element">
        <!--Imagens do Carrossel-->
        <div id="carousel-inside">
            <?php
            for ($c = 0; $c < count($carrossel); $c++) {
                if ($carrossel[$c]['id'] == 1) {
                    echo "<img src='$diretorio/media/carousel/" . $carrossel[$c]['imagem'] . "' alt='Imagem " . $carrossel[$c]['id'] . "'
                class='active'>";
                } else {
                    echo "<img src='$diretorio/media/carousel/" . $carrossel[$c]['imagem'] . "' alt='Imagem " . $carrossel[$c]['id'] . "'
                >";
                }
            }
            ?>
        </div>

        <!--Setas-->
        <div id="carousel-arrow">
            <span id="before">&#9664;</span> <!-- Seta para a esquerda -->
            <span id="next">&#9654;</span> <!-- Seta para a direita -->
        </div>

        <!--Radios-->
        <div id="carousel-indicators">
            <div id="carousel-background-indicators">
                <?php
                for ($c = 0; $c < count($carrossel); $c++) {
                    if ($c == 0) {
                        echo "
                        <input type='radio' name='carousel-indicators' id='carousel-indicator-1' data-index='0' checked>
                        <label for='carousel-indicator-1'></label>
                        ";
                    } else {
                        echo "
                    <input type='radio' name='carousel-indicators' id='carousel-indicator-" . ($c + 1) . "' data-index='$c'>
                    <label for='carousel-indicator-" . ($c + 1) . "'></label>
                    ";
                    }
                }
                ?>
            </div>
        </div>
        <div class="edit-hover text-custom">
            <i class="fa fa-pencil"></i> Editar
        </div>
    </div>


</div>



<!--Cards-->
<div class="d-flex justify-content-around my-2" id="home-custom-cards">

    <?php
    for ($c = 0; $c < count($cards); $c++) {
        echo "
        <div class='card home-card edit-element cursor-pointer' data-card-id='" . $cards[$c]['id'] . "'>
        <img class='card-img-top card-cover-image' src='$diretorio/media/cards/" . $cards[$c]['imagem'] . "'>
        <div class='card-body'>
        <h5 class='card-title'>" . $cards[$c]['titulo'] . "</h5>
        <p class='card-text'>" . $cards[$c]['texto'] . "</p>
        </div>
        <div class='card-footer border-0'>
        <a href='$diretorio" . $cards[$c]['ancora'] . "' class='btn btn-custom-blue'>Ir até lá</a>
        </div> 
        <div class='edit-hover text-custom'>
            <i class='fa fa-pencil'></i> Editar
        </div>
        </div>
        ";
    }
    ?>
</div>


<script src="<?php echo $diretorio . "/public/assets/scripts/home/carousel.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/admin/home.js" ?>"></script>