<?php
require './app/scripts/DirUrl.php';
?>

<!--Modal de fazer pedido-->
<div class="modal fade" id="modal-confirm-request">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content background">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-custom">Confirmar Pedido</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-custom">Deseja confirmar seu pedido?</span>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-custom-blue" form="form-request">Confirmar</button>
            </div>
        </div>
    </div>
</div>





<div class="container-fluid" style="margin-top:100px; margin-bottom:100px">
    <div id="request-content" class="d-flex">
        <div id="request-left-content" class="d-flex align-items-center justify-content-center">
            <div id="container-cart" class="shadow rounded background m-2">
                <h3 class="text-custom text-center p-2 shadow-sm">Carrinho</h3>
                <div class="overflow-y-auto h-75 w-100">
                    <?php
                    for ($c = 0; $c < count($carrinho['carrinho']); $c++) {
                        echo "
                        <div class='product-item m-3 background'>
                          <div class='product-info'>
                             <h2 class='background text-custom'>" . $carrinho['carrinho'][$c]['produto_nome'] . "</h2>
                            <p class='background text-custom'>" . $carrinho['carrinho'][$c]['variedade_nome'] . " - Tamanho: " . $carrinho['carrinho'][$c]['tamanho_nome'] . "</p>
                            <div class='d-flex background'>
                              <span class='product-price my-auto p-2 text-custom'>R$<span  id='preco-" . $carrinho['carrinho'][$c]['preco_id'] . "' class='preco'>" . $carrinho['carrinho'][$c]['parcial'] . "</span></span>                          
                              <span class='product-price my-auto p-2 text-custom'>Quantidade: " . $carrinho['carrinho'][$c]['quantidade'] . "</span>                          
                          </div>
                          
                            </div>
                          <a href='$diretorio/Produtos/exibir/" . $carrinho['carrinho'][$c]['produto_id'] . "'><img class='rounded img-primary-gerenciamento' src='$diretorio/media/products/" . $carrinho['carrinho'][$c]['imagem_principal'] . "'></a>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <div id="request-right-content" class="d-flex flex-column align-items-center justify-content-between">
            <div id="container-request-pay" class="shadow rounded background">
                <h3 class="text-custom text-center p-2 shadow-sm">Resumo</h3>
                <div class="d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-between m-2">
                        <strong class='text-custom'>Quantidade de itens:</strong>
                        <span class="text-custom">
                            <?php
                            $quantidade = 0;
                            for ($c = 0; $c < count($carrinho['carrinho']); $c++) {
                                $quantidade += $carrinho['carrinho'][$c]['quantidade'];
                            }
                            echo $quantidade;
                            ?>
                        </span>
                    </div>
                    <div class="product-item d-flex justify-content-between m-2">
                        <strong class='text-custom'>Preço total:</strong>
                        <span class="text-custom">R$
                            <?php
                            $preco = 0;
                            for ($c = 0; $c < count($carrinho['carrinho']); $c++) {
                                $preco += $carrinho['carrinho'][$c]['parcial'];
                            }
                            echo number_format($preco, 2);
                            ?>
                        </span>
                    </div>
                </div>
            </div>

            <div id="container-request-info" class="shadow rounded background d-flex">
                <div class="w-50 border-end">
                    <form method="POST" id='form-request' class="m-3">
                        <div class="mb-3">
                            <label for="request-input-pay" class="form-label text-custom">Forma de Pagamento</label>
                            <select class="form-select background text-custom" id="request-input-pay">
                                <?php
                                for ($c = 0; $c < count($formapagamento); $c++) {
                                    if ($formapagamento[$c]['id'] == $_SESSION['formapagamento'])
                                        echo "<option selected value='" . $formapagamento[$c]['id'] . "'>" . $formapagamento[$c]['nome'] . "</option>";
                                    else
                                        echo "<option value='" . $formapagamento[$c]['id'] . "'>" . $formapagamento[$c]['nome'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="request-input-obs" class="form-label text-custom">Observações</label>
                            <textarea class="form-control background text-custom" id="request-input-obs" maxlength="200"
                                rows="5" placeholder="Digite suas observações aqui..." style="resize:none;"></textarea>
                            <div id="counter" class='text-custom d-flex justify-content-center'>200 caracteres restantes
                            </div>
                        </div>
                    </form>
                </div>
                <div id="request-info-pay" class="w-50 d-flex flex-column justify-content-around">

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/pedidos/pedir.js" ?>"></script>