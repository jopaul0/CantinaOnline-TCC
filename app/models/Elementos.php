<?php

namespace app\models;

class Elementos
{
    private $database;

    //Retorna um array
    public function getCarousel()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM carrossel";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    //Retorna um array
    public function getCards()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM cards";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    //Retorna um array
    public function getSobre()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM sobre";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    //Retorna um array
    public function getFAQ()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM faq";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }
    public function searchFAQ($parametro)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM faq WHERE pergunta LIKE '%$parametro%' OR resposta LIKE '%$parametro%'";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }
    public function notification($id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM notificacoes WHERE id_usuario = $id_usuario AND status='Não Vista'";
        $resultado = $this->database->select($comando);

        if (count($resultado) > 0) {
            $comando2 = "UPDATE notificacoes SET status='Visualizada' WHERE id=" . $resultado[0]['id'];
            $resultado2 = $this->database->insert($comando2);

            $response = array('notificacao' => 'Sim', 'mensagem' => $resultado[0]);
        } else {
            $response = array('notificacao' => 'Não');
        }

        $this->database->closeConnection();
        return $response;
    }

    public function getNotifications($id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT *, DATE_FORMAT(data, '%d/%m/%Y às %H:%i:%s') as data_notificacao FROM notificacoes WHERE id_usuario = $id_usuario;";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    public function editCarousel($imagem, $id)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE carrossel SET imagem = '$imagem' WHERE id = $id;";
        $resultado = $this->database->insert($comando);

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');

        $this->database->closeConnection();
        return $response;
    }

    public function editCard($id, $imagem, $titulo, $ancora, $texto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE cards SET imagem = '$imagem', titulo = '$titulo', ancora='$ancora',texto='$texto' WHERE id = $id;";
        $resultado = $this->database->insert($comando);

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');

        $this->database->closeConnection();
        return $response;
    }

    public function editSobre($id, $titulo, $texto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();
        $comando = "UPDATE sobre SET titulo = '$titulo', texto = '$texto' WHERE id = $id;";
        $resultado = $this->database->insert($comando);
        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');
        $this->database->closeConnection();
        return $response;
    }
    public function editFAQ($id, $titulo, $texto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();
        $comando = "UPDATE faq SET pergunta = '$titulo', resposta = '$texto' WHERE id = $id;";
        $resultado = $this->database->insert($comando);
        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');
        $this->database->closeConnection();
        return $response;
    }
}