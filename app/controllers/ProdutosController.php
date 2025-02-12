<?php

namespace app\controllers;

use app\core\Controller;

class ProdutosController extends Controller
{

    public function index()
    {
        require './app/scripts/DirUrl.php';
        header("Location: $diretorio/Categorias");
        exit;
    }

    //Função que abre a tela do produto
    public function exibir($id_produto)
    {
        require './app/scripts/Protect.php';
        $produtos = new \app\models\Produtos();
        $produto = $produtos->getProduto($id_produto);
        $favoritos = $produtos->readFavorites($_SESSION['id']);
        if ($produto == false) {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Categorias");
            exit;
        }
        else $this->loadingTemplate('vw_produto', array('produto' => $produto,'favoritos'=>$favoritos));

    }

    //Função que faz o search
    public function buscar($nome_produto){
        $produtos = new \app\models\Produtos();
        $nome_produto = trim(preg_replace('/\s+/',' ',str_replace("_", " ", $nome_produto)));
        $produto = $produtos->search($nome_produto);
     

        require './app/scripts/isSession.php';
        if ($session)
            $favoritos = $produtos->readFavorites($_SESSION['id']);
        else
            $favoritos = null;

        $this->loadingTemplate('vw_busca', array('resultado' => $produto, 'favoritos' => $favoritos));
    }

    public function adicionarfavorito(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_produto = $_POST['id_produto'];
            $id_usuario = $_SESSION['id'];

            $usuario = new \app\models\Usuarios;
            $response = $usuario->addFavorite($id_usuario,$id_produto);

            echo json_encode($response);
            exit;
        }
        else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Categorias");
            exit;
        }
    }
    public function deletarfavorito(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_produto = $_POST['id_produto'];
            $id_usuario = $_SESSION['id'];

            $usuario = new \app\models\Usuarios;
            $response = $usuario->deleteFavorite($id_usuario,$id_produto);

            echo json_encode($response);
            exit;
        }
        else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Categorias");
            exit;
        }
    }

}