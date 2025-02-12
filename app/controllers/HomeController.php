<?php

namespace app\controllers;
use app\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $elementos = new \app\models\Elementos;
        $carrossels = $elementos->getCarousel();
        $cards = $elementos->getCards();

        $this->loadingTemplate('vw_home', array('carrossel' => $carrossels, 'cards' => $cards));
    }
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json; charset=utf-8');
            $data = json_decode(file_get_contents('php://input'), true);
            $search = $data['query'];
        
            $produto = new \app\models\Produtos;
            $result = $produto->searchSuggestion($search);

            $response='';
            for($c=0;$c<count($result);$c++){
                $response .= "<div class='search-suggestions-items text-custom'>".$result[$c]['nome']."</div>";
            }
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }

    public function notificacao(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $notificacao = new \app\models\Elementos;
            $mensagem = $notificacao->notification($_SESSION['id']);

            if($mensagem['notificacao']=='Sim'){
                $response = array('status'=>'success', 'message' => $mensagem['mensagem']['titulo']);
            } else{
                $response = array('status'=>'error');
            }



            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        else{
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio");
            exit;
        }
    }
}