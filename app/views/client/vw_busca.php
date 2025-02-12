<?php
require './app/scripts/DirUrl.php';
require './app/scripts/isSession.php';
?>

<div style="margin-top:100px;">
    <div class='m-1 p-2' style="min-height:20%;">

        <!--Modo de visualização-->
        <div class="small d-flex justify-content-end mx-5 p-1 nav nav-pills " id="pills-tab" role="tablist">
            <div class="d-flex border rounded-pill">
                <button class="nav-link btn-custom-view active" id="pills-card-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-card" type="button" role="tab" aria-controls="pills-card"
                    aria-selected="true"><i class="fa fa-table"></i></button>
                <button class="nav-link btn-custom-view" id="pills-table-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-table" type="button" role="tab" aria-controls="pills-table"
                    aria-selected="false"><i class="fa fa-bars"></i></button>
            </div>
        </div>


        <div class="tab-content overflow-x-auto" id="pills-tabContent">
            <!--Modo Cards-->
            <div class="tab-pane fade show active" id="pills-card" role="tabpanel" aria-labelledby="pills-card-tab">
                <div class="row">
                    <?php
                    if (isset($resultado[0]['id'])) {

                        if ($session) {
                            for ($c = 0; $c < count($favoritos); $c++) {
                                echo " <div class='p-3 col-md-4'>
                      <a href='" . $diretorio . "/produtos/exibir/" . $favoritos[$c]['id'] . "' class='text-decoration-none card h-100 card-listar'>
                        <img src='" . $diretorio . "/media/products/" . $favoritos[$c]['imagem'] . "' class='card-img-top card-cover-image'>
                        <div class='card-body m-2 d-flex flex-column justify-content-between '>
                          <h5 class='card-title'>" . $favoritos[$c]['nome'] . "</h5>  <!-- Nome do produto -->
                          <p class='card-text'>" . substr($favoritos[$c]['descricao'], 0, 70) . "..." . "</p>  <!-- Descrição do produto -->
                          <div class='d-flex justify-content-between'>
                            <p class='card-text'>
                            <strong>A partir de:</strong> " . $favoritos[$c]['preco'] . "  <!-- Preço do produto -->
                          </p>
                          <button class='heart-favorite border-0 btn m-1' data-idproduto='" . $favoritos[$c]['id'] . "'>
                        <i class='fa fa-heart'></i>
                            </button>
                          </div>
                        </div> 
                      </a>
                      
                    </div>
                    ";
                            }
                            for ($c = 0; $c < count($resultado); $c++) {
                                $existe = false;
                                for ($d = 0; $d < count($favoritos); $d++) {
                                    if ($resultado[$c]['id'] == $favoritos[$d]['id'])
                                        $existe = true;
                                }
                                if ($existe)
                                    continue;
                                echo " <div class='p-3 col-md-4'>
                      <a href='" . $diretorio . "/produtos/exibir/" . $resultado[$c]['id'] . "' class='text-decoration-none card h-100 card-listar'>
                        <img src='" . $diretorio . "/media/products/" . $resultado[$c]['imagem'] . "' class='card-img-top card-cover-image'>
                        <div class='card-body m-2 d-flex flex-column justify-content-between '>
                          <h5 class='card-title'>" . $resultado[$c]['nome'] . "</h5>  <!-- Nome do produto -->
                          <p class='card-text'>" . substr($resultado[$c]['descricao'], 0, 70) . "..." . "</p>  <!-- Descrição do produto -->
                          <div class='d-flex justify-content-between'>
                            <p class='card-text'>
                            <strong>A partir de:</strong> " . $resultado[$c]['preco'] . "  <!-- Preço do produto -->
                          </p>
                          <button class='heart border-0 btn m-1' data-idproduto='" . $resultado[$c]['id'] . "'>
                        <i class='fa fa-heart'></i>
                            </button>
                          </div>
                        </div> 
                      </a>
                      
                    </div>
                    ";
                            }
                        } else {
                            for ($c = 0; $c < count($resultado); $c++) {

                                echo " <div class='p-3 col-md-4'>
                      <a href='" . $diretorio . "/produtos/exibir/" . $resultado[$c]['id'] . "' class='text-decoration-none card h-100 card-listar'>
                        <img src='" . $diretorio . "/media/products/" . $resultado[$c]['imagem'] . "' class='card-img-top card-cover-image'>
                        <div class='card-body m-2 d-flex flex-column justify-content-between '>
                          <h5 class='card-title'>" . $resultado[$c]['nome'] . "</h5>  <!-- Nome do produto -->
                          <p class='card-text'>" . substr($resultado[$c]['descricao'], 0, 70) . "..." . "</p>  <!-- Descrição do produto -->
                          <div class='d-flex justify-content-between'>
                            <p class='card-text'>
                            <strong>A partir de:</strong> " . $resultado[$c]['preco'] . "  <!-- Preço do produto -->
                          </p>
                          </div>
                        </div> 
                      </a>
                      
                    </div>
                    ";

                            }
                        }
                    } else
                        echo "<div class='d-flex justify-content-center' style='height:300px'>
                <h1 class='text-center'>Nenhum produto encontrado</h1>
                </div>'";

                    ?>
                </div>
            </div>

            <!--Modo Table-->
            <div class="tab-pane fade" id="pills-table" role="tabpanel" aria-labelledby="pills-table-tab">

                <?php

                if (isset($resultado[0]['id'])) {
                    echo "
                            <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col' class='background text-custom'>Id</th>
                            <th scope='col' class='background text-custom'>Nome</th>
                            <th scope='col' class='background text-custom'>Preço</th>
                            <th scope='col' class='background text-custom'>Descrição</th>
                            <th scope='col' class='background text-custom'>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                            ";
                    for ($c = 0; $c < count($resultado); $c++) {
                        echo "
                <tr data-href='" . $diretorio . "/produtos/exibir/" . $resultado[$c]['id'] . "' class='table-row-link'> 
                  <td class='background text-custom'>" . $resultado[$c]['id'] . "</td>
                  <td class='background text-custom'>" . $resultado[$c]['nome'] . "</td>
                  <td class='background text-custom'>" . $resultado[$c]['preco'] . "</td>
                  <td class='background text-custom'>" . substr($resultado[$c]['descricao'], 0, 70) . "..." . "</td>
                  <td class='background text-custom'><img src='" . $diretorio . "/media/products/" . $resultado[$c]['imagem'] . "' class='rounded' style='width:70px;height:50px;'></td>
                  </tr>
                  
                    ";
                    }
                    echo " </tbody>
                </table> ";

                } else
                    echo "<div class='d-flex justify-content-center' style='height:300px'>
                <h1 class='text-center'>Nenhum produto encontrado</h1>
                </div>'";


                ?>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo $diretorio . "/public/assets/scripts/cardapio/view.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/cardapio/addfavorito.js" ?>"></script>