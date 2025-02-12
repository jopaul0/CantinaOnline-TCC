<?php

namespace app\controllers;
use app\core\Controller;

class CarrinhoController extends Controller
{

    public function index()
    {
        require './app/scripts/Protect.php';
        $Carrinho = new \app\models\Carrinho;
        $carrinho = $Carrinho->getCart($_SESSION['id']);

        $this->loadingTemplate('vw_carrinho', array('carrinho' => $carrinho));
    }

    //Função que adiciona produtos ao carrinho
    public function adicionarproduto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_preco = $_POST['id_preco'];
            $preco = $_POST['preco'];

            $carrinho = new \app\models\Carrinho;
            $retorno = $carrinho->addToCart($_SESSION['id'], $id_preco, $preco);

            echo json_encode($retorno);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Carrinho");
            exit;
        }
    }

    //Função que atualiza a quantidade do produto no carrinho
    public function atualizarquantidade()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_preco = $_POST['id_preco'];
            $preco = $_POST['preco'];
            $quantidade = $_POST['quantidade'];
            $parcial = ($preco * $quantidade);

            $carrinho = new \app\models\Carrinho;
            $retorno = $carrinho->updateQuantity($_SESSION['id'], $id_preco, $quantidade, $parcial);

            echo json_encode($retorno);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Carrinho");
            exit;

        }
    }

    //Remove um item do carrinho
    public function removeritem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_preco = $_POST['id_preco'];

            $pedido = new \app\models\Carrinho;
            $retorno = $pedido->deleteToCart($_SESSION['id'], $id_preco);

            echo json_encode($retorno);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Carrinho");
            exit;
        }
    }

    //Atualiza o carrinho
    public function atualizarcarrinho()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';
            $Carrinho = new \app\models\Carrinho;
            $carrinho = $Carrinho->getCart($_SESSION['id']);

            $tabela = '';

            if (count($carrinho['carrinho']) > 0) {
                $tabela .= "<div id='itens-cart' class='overflow-y-auto' style='height:300px'>";
                $subtotal = 0;

                for ($c = 0; $c < count($carrinho['carrinho']); $c++) {
                    $linha = '';
                    $linha .= "
                  <div class='product-item m-3 background'>
                  <div class='product-info'>
                     <h2 class='background text-custom'>" . $carrinho['carrinho'][$c]['produto_nome'] . "</h2>
                    <p class='background text-custom'>" . $carrinho['carrinho'][$c]['variedade_nome'] . " - Tamanho: " . $carrinho['carrinho'][$c]['tamanho_nome'] . "</p>
                    <div class='d-flex background'>
                      <span class='product-price my-auto p-2 text-custom'>R$<span  id='preco-" . $carrinho['carrinho'][$c]['preco_id'] . "' class='preco'>" . $carrinho['carrinho'][$c]['parcial'] . "</span></span>
                    <input type='number' data-preco-id='" . $carrinho['carrinho'][$c]['preco_id'] . "' data-preco='" . $carrinho['carrinho'][$c]['preco'] . "' class='product-quantity text-custom background rounded' value='" . $carrinho['carrinho'][$c]['quantidade'] . "' min='1' max='25'>
                    <button class='btn btn-danger rounded-circle btn-removeritem' data-preco-id='" . $carrinho['carrinho'][$c]['preco_id'] . "'><i class='fa fa-trash'></i></button>
                  </div>
                  
                    </div>
                  <a href='$diretorio/Produtos/exibir/" . $carrinho['carrinho'][$c]['produto_id'] . "'><img class='rounded img-primary-gerenciamento' src='$diretorio/media/products/" . $carrinho['carrinho'][$c]['imagem_principal'] . "'></a>
                </div>";
                    $subtotal += $carrinho['carrinho'][$c]['parcial'];
                    $tabela .= $linha;
                }
                $tabela .= "</div> 
                
                <div class='summary h-100 w-100'>
  <h2 class='text-center text-custom'>Resumo</h2>
  <div class='subtotal text-center text-custom'>Subtotal: R$<span id='subtotal'>" . number_format($subtotal, 2) . "</span></div>
  <div class='d-flex justify-content-center'><a href='$diretorio/Pedir' class='btn btn-custom-blue'>Fazer Pedido</a></div>
</div>
                ";
            } else {
                $tabela .= "<div class='h-100 d-flex justify-content-center flex-column'>
      <div class='p-5'>
    <h2 class='text-center text-custom'>Seu carrinho está vazio!</h2>
    <div class='text-center p-3'><i id='cart-icon-cart' class='fa fa-shopping-cart'></i></div>
    <div class='d-flex justify-content-center'>
    <a href='$diretorio/Produtos/buscar/' class='btn btn-custom-blue'>Ver Produtos</a> 
    </div>
    </div>
    </div>";
            }


            $dados = array('tabela' => $tabela);

            echo json_encode($dados);



        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Carrinho");
            exit;
        }
    }
}

