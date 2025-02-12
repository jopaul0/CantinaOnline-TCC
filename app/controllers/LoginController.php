<?php

namespace app\controllers;

use app\core\Controller;

class LoginController extends Controller
{

    public function index()
    {
        session_destroy();
        session_unset();
        require './app/views/client/vw_login.php';
    }

    //Metodo para registrar o usuário
    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json; charset=utf-8');
            $data = json_decode(file_get_contents('php://input'), true);


            $cpf = $data["cpf"];
            $nome = $data["nome"];
            $sobrenome = $data["sobrenome"];
            $email = $data["email"];
            $telefone = $data["telefone"];
            $senha = $data["senha"];

            $usuario = new \app\models\Usuarios;
            $retorno = $usuario->register($cpf, $nome, $sobrenome, $telefone, $senha, $email);

            echo json_encode($retorno);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Login");
            exit;
        }
    }

    //Metodo para entrar na conta
    public function logar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $usuario = $_POST["usuario"];
            $senha = $_POST["senha"];

            $usuarios = new \app\models\Usuarios;
            $retorno = $usuarios->login($usuario,$senha);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($retorno);
            exit;
        } else {
            require './app/scripts/DirUrl.php';
            header("Location: $diretorio/Login");
            exit;
        }
    }

    //Metodo para sair da conta
    public function logout()
    {
        session_destroy();
        session_unset();
        require './app/scripts/DirUrl.php';
        header("Location: $diretorio");
        exit;
    }


}