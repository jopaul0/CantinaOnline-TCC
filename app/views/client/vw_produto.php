<?php
require './app/scripts/DirUrl.php';
$imagens = explode(", ", $produto['tabela1']['imagens']);
?>

<!--Modal que adiciona o produto ao carrinho-->
<div class="modal fade" id="modal-addcarrinho" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <div class="modal-header">
                <h5 class="modal-title text-custom" id="modal-label">Adicionar ao Carrinho</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-carrinho" method="post">
                    <div class="mb-3">
                        <label for="input-carrinho" class="form-label text-custom">Variedade</label>
                        <select class="form-select text-custom background" id="input-carrinho" name="id_preco">
                            <?php

                            for ($ca = 0; $ca < count($produto['tabela2']); $ca++) {
                                echo '<option data-preco="' . $produto['tabela2'][$ca]['preco'] . '" value="' . $produto['tabela2'][$ca]['id_preco'] . '">' . $produto['tabela2'][$ca]['variedade_nome'] . ' (' . $produto['tabela2'][$ca]['tamanho_nome'] . ') - R$' . $produto['tabela2'][$ca]['preco'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-custom-blue" form="form-carrinho">Adicionar</button>
            </div>
        </div>
    </div>
</div>

<div class="m-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 d-flex flex-column justify-content-between">
                <!--Imagem-->
                <img src="<?php echo $diretorio . "/media/products/" . $imagens[0] ?>" id="img-product"
                    class="border rounded ">
                <div class="d-flex justify-content-center overflow-x-auto">
                    <?php
                    for ($c = 0; $c < count($imagens); $c++) {
                        echo '<img src="' . $diretorio . '/media/products/' . $imagens[$c] . '"';
                        if ($c == 0) {
                            echo ' class="mx-2 my-2 img-product-preview border rounded img-selected">';
                        } else {
                            echo ' class="mx-2 my-2 img-product-preview border rounded">';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 mt-2 ">
                <!--Dados do produto-->
                <div class="d-flex justify-content-between">
                    <h1 class="display-5 text-custom"><?php echo $produto['tabela1']['nome'] ?></h1>

                    <?php
                    $existe = false;
                    for ($c = 0; $c < count($favoritos); $c++) {
                        if ($produto['tabela1']['id'] == $favoritos[$c]['id'])
                            $existe = true;
                    }
                    ;

                    if ($existe) {
                        echo "<button class='heart-favorite border-0 btn m-1' data-idproduto='" . $produto['tabela1']['id'] . "'>
                        <i class='fa fa-heart'></i>
                            </button>";
                    } else {
                        echo "<button class='heart border-0 btn m-1' data-idproduto='" . $produto['tabela1']['id'] . "'>
                        <i class='fa fa-heart'></i>
                            </button>";
                    }
                    ?>
                </div>
                <p class="text-muted text-custom">Categoria: <?php echo $produto['tabela1']['nome_categoria'] ?></p>
                <!--Ações-->
                <div class="d-grid gap-2">
                    <button class="btn btn-custom-blue btn-lg" data-bs-toggle="modal"
                        data-bs-target="#modal-addcarrinho">Adicionar ao carrinho</button>
                    <button class="btn btn-outline-secondary btn-lg backgroundCompartilhar text-custom"
                        id="copy-link-btn">Compartilhar</button>
                    <div class="d-flex justify-content-center" id="feedback"><span id="feedback-text"
                            class="small"></span></div>

                </div>
            </div>
        </div>
        <!--Desccrição do produto-->
        <div class="row flex-wrap mt-4">
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <h2 class="h5 text-custom">Descrição do produto</h2>
                <p class="text-custom"><?php echo $produto['tabela1']['descricao'] ?></p>
            </div>
            <div class="col-12 col-md-6">
                <table class="table rounded shadow-sm">
                    <thead>
                        <tr>
                            <th scope="col" class="background text-custom">Variação</th>
                            <th scope="col" class="background text-custom">Tamanho</th>
                            <th scope="col" class="background text-custom">Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($produto['tabela2'] == null) {
                            echo '<tr><td colspan="3">Nenhuma variação disponível</td></tr>';
                        } else {
                            foreach ($produto['tabela2'] as $variedade) {
                                echo "
            <tr>
              <td class='background text-custom'>{$variedade['variedade_nome']}</td>
              <td class='background text-custom'>{$variedade['tamanho_nome']}</td>
              <td class='background text-custom'>{$variedade['preco']}</td>
            </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/cardapio/addcarrinho.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/cardapio/view.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/cardapio/addfavorito.js" ?>"></script>