<?php

namespace app\controllers;

use app\core\Controller;

class PedirController extends Controller
{
    public function index()
    {
        require './app/scripts/Protect.php';
        $Carrinho = new \app\models\Carrinho;
        $carrinho = $Carrinho->getCart($_SESSION['id']);
        $Formapagamento = new \app\models\Pedidos;
        $formapagamento = $Formapagamento->getFormPay();

        if (count($carrinho['carrinho']) < 1) {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Carrinho");
            exit;
        } else {
            $this->loadingTemplate('vw_pedir', array('carrinho' => $carrinho, 'formapagamento' => $formapagamento));
        }
    }

    public function pagamento()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formapagamento = $_POST['formapagamento'];
            $Carrinho = new \app\models\Carrinho;
            $carrinho = $Carrinho->getCart($_SESSION['id']);

            $preco = 0;
            for ($c = 0; $c < count($carrinho['carrinho']); $c++) {
                $preco += $carrinho['carrinho'][$c]['parcial'];
            }

            switch ($formapagamento) {
                case '1':
                    $response = "
                    
                        <div class='d-flex flex-column justify-content-center m-4'>
                            <p class='text-custom text-center'>Este pedido deverá ser pago presencialmente com a utilização de cédulas ou moedas de reais.</p>
                        </div>
                    
                    <div class='d-flex justify-content-center'>
                        <button type='submit' class='btn btn-custom-blue' data-bs-toggle='modal' data-bs-target='#modal-confirm-request'>Enviar Pedido</button>
                    </div>
                    ";
                    break;
                case '2':
                    if ($preco > $_SESSION['saldo']) {
                        $response = "
                        <div class='d-flex flex-column justify-content-center m-4'>
                            <p class='text-custom text-center'>Seu saldo é insuficiente para a efetuação desse pedido. Tente recarregar sua conta ou escolher outra forma de pagamento.</p>
                        </div>
                        ";
                    } else {
                        $response = "
                        <div class='d-flex flex-column justify-content-center m-4'>
                            <p class='text-custom text-center'>Seu pedido será pago via saldo, portanto sua conta passará de R$".$_SESSION['saldo']." para R$".number_format($_SESSION['saldo']-$preco,2).".</p>
                        </div>
                    
                    <div class='d-flex justify-content-center'>
                        <button type='submit' class='btn btn-custom-blue' data-bs-toggle='modal' data-bs-target='#modal-confirm-request'>Enviar Pedido</button>
                    </div>
                        ";
                    }
                    break;
                default:
                    require './app/scripts/DirUrl.php';
                    header("Location: $diretorio/Categorias");
                    break;
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Pedir");
            exit;
        }
    }

    public function enviarpedido(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formapagamento = $_POST['formapagamento'];
            $observacoes = $_POST['observacoes'];

            $request = new \app\models\Pedidos;
            $response = $request->addRequest($_SESSION['id'],$observacoes,$formapagamento);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        else{
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Pedir");
            exit;
        }
    }
}