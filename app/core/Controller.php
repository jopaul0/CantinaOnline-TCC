<?php

namespace app\core;

class Controller
{

    //Declara a variável dos dados
    public $dados;

    //Função que renderiza o template do site
    public function loadingTemplate($nameView, $dadosModel = array())
    {
        $this->dados = $dadosModel;
        require './app/views/client/template.php';
    }

    //função que renderiza as views do site
    public function loadingView($nameView, $dadosModel = array())
    {
        extract($dadosModel);
        require './app/views/client/'.$nameView.'.php';
    }

    //Função que renderiza o template do site do ADM
    public function loadingTemplateADM($nameView, $dadosModel = array())
    {
        $this->dados = $dadosModel;
        require './app/views/admin/template.php';
    }

    //função que renderiza as views do site
    public function loadingViewADM($nameView, $dadosModel = array())
    {
        extract($dadosModel);
        require './app/views/admin/'.$nameView.'.php';
    }

    //Função que retorna os dados
    public function getDados(){
        return $this->dados;
    }

}