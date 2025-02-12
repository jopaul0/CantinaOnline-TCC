<?php

namespace app\controllers;
use app\core\Controller;

class SuporteController extends Controller
{

    public function index()
    {
        $elementos = new \app\models\Elementos;
        $faq = $elementos->getFAQ();

        $this->loadingTemplate('vw_suporte', array('faq' => $faq));
    }

    public function atualizarfaq()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $parametro = $_POST['parametro'];

            $elementos = new \app\models\Elementos;
            $faq = $elementos->searchFAQ($parametro);

            $response = '';
            if (count($faq)>0) {
                for ($c = 0; $c < count($faq); $c++) {

                    $response .= "<div data-bs-toggle='collapse' data-bs-target='#" . $faq[$c]['id'] . "' aria-expanded='false' aria-controls='" . $faq[$c]['id'] . "' class= 'd-flex cursor-pointer justify-content-between align-items-center flex-row border-top border rounded p-4 w-100'><div class='pergunta'>" . $faq[$c]['pergunta'] . "</div>
            <i class='fa fa-angle-right mostrar-resposta' type='button'>
            </i>
            </div>
            <div class='collapse' id='" . $faq[$c]['id'] . "'>
            <div class='card card-body collapse-custom text-custom w-100 border-0'>
            " . $faq[$c]['resposta'] . "
            </div>
            </div>
            ";
                    //echo "ID: " . $faq[$c]['id'] . "\n";
                }
            } else {
                $response = "
                        <div class='w-100 text-custom d-flex justify-content-center'>
                            <h3>Nenhuma pergunta encontrada.</h3>
                        </div>
                    ";
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Perfil");
            exit;
        }
    }
}