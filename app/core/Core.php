<?php

namespace app\core;

class Core
{
    public function __construct()
    {
        //Bota para funcionar
        $this->run();
    }
    public function run()
    {

        //Declaração das variáveis padrão
        $dir = "\app\controllers\\HomeController";
        $classe = "Home";
        $metodo = "index";
        $input = "";

        //Pegando a URL
        if (isset($_GET["url"])) {
            $url = $_GET["url"];
            $urlExploded = explode("/", $url);

                if(isset($urlExploded[0]))
                $classe = $urlExploded[0];

                //Verificando se existe o arquivo
                if (!file_exists("./app/controllers/" . ucfirst($classe) . "Controller.php")) {
                    $classe = "Home";
                    $metodo = "index";
                }

                //Colocando o namespace da classe
                $dir = "\app\controllers\\" . $classe . "Controller";

                //instanciando a classe
                $pag = new $dir;

                //Pegando o método
                if (isset($urlExploded[1]) && method_exists($pag, $urlExploded[1])) {
                    $metodo = $urlExploded[1];
                    //detectando se tem parâmetros
                    $reflection = new \ReflectionMethod($dir, $metodo);
                    if ($reflection->getNumberOfParameters() > 0) {
                        if (isset($urlExploded[2])) {
                            $input = $urlExploded[2];
                            $pag->$metodo($input);

                        } else {
                            $metodo = "index";
                            $pag->$metodo();
                        }
                    } else {
                        $pag->$metodo();
                    }
                } else {
                    $pag->$metodo();
                }
        } else {
            $pag = new $dir;
            $pag->$metodo();
        }
    }
}
