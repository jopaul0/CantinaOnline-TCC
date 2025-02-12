<?php
require './app/scripts/DirUrl.php';
?>

<h1 class="text-center text-custom p-1" style="margin-top:100px;">Carrinho</h1>
<div class="container rounded shadow-sm p-2 background" style="margin-bottom:100px; height:500px">
  <div id="corpo-carrinho" class="background h-100">
    <?php
    if (count($carrinho['carrinho']) > 0) {
      echo "
         <div id='itens-cart' class='overflow-y-auto' style='height:250px'>
              ";
      $subtotal = 0;
      for ($c = 0; $c < count($carrinho['carrinho']); $c++) {
        echo "
                <div class='product-item m-3 background'>
                  <div class='product-info'>
                     <h2 class='background text-custom'>" . $carrinho['carrinho'][$c]['produto_nome'] . "</h2>
                    <p class='background text-custom'>" . $carrinho['carrinho'][$c]['variedade_nome'] . " - Tamanho: " . $carrinho['carrinho'][$c]['tamanho_nome'] . "</p>
                    <div class='d-flex background'>
                      <span class='product-price my-auto p-2 text-custom'>R$<span  id='preco-" . $carrinho['carrinho'][$c]['preco_id'] . "' class='preco'>" . $carrinho['carrinho'][$c]['parcial'] . "</span></span>
                    <input type='number' data-preco-id='" . $carrinho['carrinho'][$c]['preco_id'] . "' data-preco='" . $carrinho['carrinho'][$c]['preco'] . "' class='product-quantity text-custom background rounded' value='".$carrinho['carrinho'][$c]['quantidade']."' min='1' max='25'>
                    <button class='btn btn-danger rounded-circle btn-removeritem' data-preco-id='" . $carrinho['carrinho'][$c]['preco_id'] . "'><i class='fa fa-trash'></i></button>
                  </div>
                  
                    </div>
                  <a href='$diretorio/Produtos/exibir/" . $carrinho['carrinho'][$c]['produto_id'] . "'><img class='rounded img-primary-gerenciamento' src='$diretorio/media/products/" . $carrinho['carrinho'][$c]['imagem_principal'] . "'></a>
                </div>";
        $subtotal += $carrinho['carrinho'][$c]['parcial'];
      }
      echo "
                </div> 
                
                <div class='summary h-100 w-100'>
  <h2 class='text-center text-custom'>Resumo</h2>
  <div class='subtotal text-center text-custom'>Subtotal: R$<span id='subtotal'>" . number_format($subtotal, 2) . "</span></div>
  <div class='d-flex justify-content-center'><a href='$diretorio/Pedir' class='btn btn-custom-blue'>Fazer Pedido</a></div>
</div>
                ";


    } else {
      echo "<div class='h-100 d-flex justify-content-center flex-column'>
      <div class='p-5'>
    <h2 class='text-center text-custom'>Seu carrinho está vazio!</h2>
    <div class='text-center p-3'><i id='cart-icon-cart' class='fa fa-shopping-cart'></i></div>
    <div class='d-flex justify-content-center'>
    <a href='$diretorio/Produtos/buscar/' class='btn btn-custom-blue'>Ver Produtos</a> 
    </div>
    </div>
    </div>";
    }

    ?>
  </div>



</div>

<script src="<?php echo $diretorio . "/public/assets/scripts/carrinho/carrinho.js" ?>"></script>
<script src="<?php echo $diretorio . "/public/assets/scripts/carrinho/pedido.js" ?>"></script>