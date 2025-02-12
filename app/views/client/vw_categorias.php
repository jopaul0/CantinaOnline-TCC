<?php
require './app/scripts/DirUrl.php';
?>

<div class="container-categorias background p-2 shadow-lg">
    <div class="row text-center p-2">
        <h1 id="categoria-title">
            Categorias
        </h1>
    </div>
    <a href="<?php echo $diretorio . "/categorias/listar/1" ?>"><img
            src=" <?php echo $diretorio . " /public/assets/style/cardapio/image/salgados.jpg" ?>"
            class="rounded img-categories"></a>
    <a href="<?php echo $diretorio . "/categorias/listar/2" ?>"><img
            src="<?php echo $diretorio . " /public/assets/style/cardapio/image/bebidas.jpg" ?>"
            class="rounded img-categories"></a>
    <a href="<?php echo $diretorio . "/categorias/listar/3" ?>"><img
            src="<?php echo $diretorio . " /public/assets/style/cardapio/image/sorvetes.jpg" ?>"
            class="rounded img-categories"></a>
    <a href="<?php echo $diretorio . "/categorias/listar/4" ?>"><img
            src="<?php echo $diretorio . " /public/assets/style/cardapio/image/sobremesas.jpg" ?>"
            class="rounded img-categories"></a>
    <a href="<?php echo $diretorio . "/categorias/listar/5" ?>"><img
            src="<?php echo $diretorio . " /public/assets/style/cardapio/image/guloseimas.jpg" ?>"
            class="rounded img-categories"></a>


</div>