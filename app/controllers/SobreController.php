<?php

namespace app\controllers;
use app\core\Controller;

class SobreController extends Controller
{

    public function index()
    {
        $elementos = new \app\models\Elementos;
        $sobre = $elementos->getSobre();
        $this->loadingTemplate('vw_sobre', array('sobre' => $sobre));
    }
}