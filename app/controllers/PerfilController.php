<?php

namespace app\controllers;

use app\core\Controller;

class PerfilController extends Controller
{

    public function index()
    {
        require './app/scripts/Protect.php';

        $pedido = new \app\models\Pedidos;
        $formapagamento = $pedido->getFormPay();
        $pedidos = $pedido->getUserRequests($_SESSION['id']);

        $elemento = new \app\models\Elementos;
        $notificacoes = $elemento->getNotifications($_SESSION['id']);

        $this->loadingTemplate('vw_perfil', array('formapagamento' => $formapagamento, 'pedidos' => $pedidos, 'notificacoes'=>$notificacoes));
    }

    public function getPerfil()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $response = array(
                'nome' => $_SESSION['nome'] . " " . $_SESSION['sobrenome'],
                'email' => $_SESSION['email'],
                'telefone' => $_SESSION['telefone'],
                'cpf' => $_SESSION['cpf'],
                'senha' => $_SESSION['senha'],
                'foto' => $_SESSION['imagem']
            );
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function editarimagem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['foto'])) {
                $imagem = $_FILES['foto'];

                if ($imagem['error'] == 0) {
                    // Salvar a imagem em um diretório
                    $dir = './media/profiles/'; // diretório onde a imagem será salva
                    $foto = uniqid() . '.' . pathinfo($imagem['name'], PATHINFO_EXTENSION);
                    $filePath = $dir . $foto;

                    if (!file_exists($dir)) {
                        mkdir($dir, 0777, true);
                    }

                    move_uploaded_file($imagem['tmp_name'], $filePath);

                    if ($_SESSION['imagem'] != 'default.jpg')
                        unlink($dir . $_SESSION['imagem']);
                } else {
                    $foto = $_SESSION['imagem'];
                }
            } else {
                $foto = $_SESSION['imagem'];
            }

            $usuario = new \app\models\Usuarios;
            $response = $usuario->setImage($foto, $_SESSION['id']);


            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function editarnome()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];

            $usuario = new \app\models\Usuarios;
            $response = $usuario->setName($nome, $sobrenome, $_SESSION['id']);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }


    public function editarcpf()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cpf = $_POST["cpf"];


            $usuario = new \app\models\Usuarios;
            $response = $usuario->setCPF($cpf, $_SESSION['id']);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function editaremail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST["email"];


            $usuario = new \app\models\Usuarios;
            $response = $usuario->setEmail($email, $_SESSION['id']);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function editartelefone()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $telefone = $_POST["telefone"];


            $usuario = new \app\models\Usuarios;
            $response = $usuario->setCellphone($telefone, $_SESSION['id']);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function editarsenha()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $senha = $_POST["senha"];


            $usuario = new \app\models\Usuarios;
            $response = $usuario->setPassword($senha, $_SESSION['id']);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function editarpreferencias()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tema = $_POST['modoescuro'];
            $notificacao = $_POST['notificacao'];
            $formapagamento = $_POST['formapagamento'];

            $usuario = new \app\models\Usuarios;
            $response = $usuario->editPreferences($_SESSION['id'], $formapagamento, $tema, $notificacao);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }

    public function atualizarsaldo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $usuario = new \app\models\Usuarios;
            $saldo = $usuario->getCash($_SESSION['id']);

            $_SESSION['saldo'] = $saldo;
            $response = array('status' => 'success', 'saldo' => $_SESSION['saldo']);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }
    public function atualizarfoto()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $usuario = new \app\models\Usuarios;
            $imagem = $usuario->getImage($_SESSION['id']);

            $_SESSION['imagem'] = $imagem;
            $response = $imagem;

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function cancelarpedido()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_pedido = $_POST['id_pedido'];

            $pedidos = new \app\models\Pedidos;
            $response = $pedidos->cancelRequest($id_pedido);

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function atualizartabelapedidos()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require './app/scripts/DirUrl.php';
            $pedido = new \app\models\Pedidos;
            $pedidos = $pedido->getUserRequests($_SESSION['id']);

            $response = '';

            if (count($pedidos['pedido']) > 0) {
                $response .= "<div class='d-flex justify-content-around'>
                
                <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>ID:</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>Valor:</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>Status:</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>Pagamento:</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
<span class='text-custom'>Feito:</span>
                            </div>
                            </div> ";
                for ($c = 0; count($pedidos['pedido']) > $c; $c++) {
                    $response .= "
                    <div id='profile-request-info-" . $pedidos['pedido'][$c]['id_pedido'] . "' data-bs-toggle='collapse' data-bs-target='#profile-request-items-" . $pedidos['pedido'][$c]['id_pedido'] . "' aria-expanded='false' aria-controls='profile-request-items' class='w-100 profile-request-info d-flex justify-content-around cursor-pointer rounded border'>
                            <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>" . $pedidos['pedido'][$c]['id_pedido'] . "</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>" . $pedidos['pedido'][$c]['total_pedido'] . "</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>" . $pedidos['pedido'][$c]['status_pedido'] . "</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
                                <span class='text-custom'>" . $pedidos['pedido'][$c]['status_pagamento'] . "</span>
                            </div>  
                            <div class='d-flex flex-column justify-content-center'>
<span class='text-custom'>" . $pedidos['pedido'][$c]['data_diapedido'] . "</span>
                            </div>  
                    </div>
                    <div id='profile-request-items-" . $pedidos['pedido'][$c]['id_pedido'] . "' class='collapse w-100 profile-request-items'>
                            ";
                    for ($d = 0; $d < count($pedidos['itens']); $d++) {
                        if ($pedidos['itens'][$d]['id_pedido'] != $pedidos['pedido'][$c]['id_pedido'])
                            continue;
                        else {
                            $response .= "
                                        <div class='product-item m-3 background'>
                                          <div class='product-info'>
                                             <h2 class='background text-custom'>" . $pedidos['itens'][$d]['nome_produto'] . "</h2>
                                            <p class='background text-custom'>" . $pedidos['itens'][$d]['nome_variedade'] . " - Tamanho: " . $pedidos['itens'][$d]['tamanho_produto'] . "</p>
                                            <div class='d-flex background'>
                                              <span class='product-price my-auto p-2 text-custom'>R$<span class='preco'>" . $pedidos['itens'][$d]['preco_produto'] . "</span></span>
                                              <span class='text-custom p-2'>Qtd: " . $pedidos['itens'][$d]['quantidade_produto'] . "</span>
                                            
                                            
                                          </div>
                                          
                                            </div>
                                         <img class='rounded img-primary-gerenciamento' src='$diretorio/media/products/" . $pedidos['itens'][$d]['imagem_produto'] . "'>
                                        </div>
                                        ";
                        }

                    }
                    if ($pedidos['pedido'][$c]['status_pedido'] == 'Pendente') {
                        $response .= "
                                <div class='d-flex m-2 justify-content-center'>
                                  <button type='button' class='rounded-circle text-light btn btn-danger btn-toggle-modal-request' data-bs-toggle='modal' data-bs-target='#modal-confirm-cancel-request' data-id-pedido='" . $pedidos['pedido'][$c]['id_pedido'] . "'><i class='fa fa-trash'></i></button>
                                            
                        </div>";
                    }
                    $response .= "</div>
                    
                ";
                }
            } else
                $response .= "
                <div class='d-flex flex-column justify-content-center h-100'>
                    <h1 class='text-center text-custom'>Esse usuário não</h1>
                    <h1 class='text-center text-custom'>possui pedidos!</h1>
               </div>
            ";

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }
}