<?php

namespace app\controllers;

use app\core\Controller;

class CategoriasController extends Controller
{

    public function index()
    {
        $this->loadingTemplate('vw_categorias');
    }

    //Função que abre o cardapio de tal categoria
    public function listar($categoria)
    {

        $produtos = new \app\models\Produtos();
        
        require './app/scripts/isSession.php';
        if ($session)
            $favoritos = $produtos->readFavorites($_SESSION['id']);
        else
            $favoritos = null;

        switch ($categoria) {
            case '1':
                $resultado = $produtos->readCategory($categoria);
                $this->loadingTemplate('vw_cardapio', array('resultado' => $resultado, 'favoritos' => $favoritos));
                break;
            case '2':
                $resultado = $produtos->readCategory($categoria);
                $this->loadingTemplate('vw_cardapio', array('resultado' => $resultado, 'favoritos' => $favoritos));
                break;
            case '3':
                $resultado = $produtos->readCategory($categoria);
                $this->loadingTemplate('vw_cardapio', array('resultado' => $resultado, 'favoritos' => $favoritos));
                break;
            case '4':
                $resultado = $produtos->readCategory($categoria);
                $this->loadingTemplate('vw_cardapio', array('resultado' => $resultado, 'favoritos' => $favoritos));
                break;
            case '5':
                $resultado = $produtos->readCategory($categoria);
                $this->loadingTemplate('vw_cardapio', array('resultado' => $resultado, 'favoritos' => $favoritos));
                break;
            default:
                require './app/scripts/DirUrl.php';
                header("Location: $diretorio/Categorias");
                break;
        }
    }

    public function favoritos()
    {
        $produtos = new \app\models\Produtos();
        $resultado = $produtos->readFavorites($_SESSION['id']);

        $this->loadingTemplate('vw_cardapio', array('resultado' => $resultado));
    }


}
