<?php

namespace app\models;

class Carrinho
{
    private $database;

    //Função pega os itens do carrinho
    //Retorna um array
    public function getCart($id)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT 
                        ic.id_usuario,
                        ic.parcial,
                        ic.quantidade,
                        p.nome AS produto_nome,
                        p.id AS produto_id,
                        vp.nome AS variedade_nome,
                        pp.preco,
                        pp.id AS preco_id,
                        tp.nome AS tamanho_nome,
                        ip.imagem AS imagem_principal
                    FROM 
                        carrinho c
                        INNER JOIN itens_carrinho ic ON c.id_usuario = ic.id_usuario
                        INNER JOIN precos_produtos pp ON ic.id_preco = pp.id
                        INNER JOIN variedades_produtos vp ON pp.id_variedade = vp.id
                        INNER JOIN produtos p ON vp.id_produto = p.id
                        INNER JOIN imagens_produtos ip ON p.id = ip.id_produto AND ip.status = 'Principal'
                        INNER JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
                    WHERE 
                        c.id_usuario = $id;";
        $resultado = $this->database->select($comando);

        $resposta = array(
            "carrinho" => $resultado
        );

        $this->database->closeConnection();
        return $resposta;

    }


    //Adiciona produtos ao carrinho
    //Retorna um JSON
    public function addToCart($id_usuario, $id_preco, $preco)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM itens_carrinho WHERE id_usuario = $id_usuario and id_preco = $id_preco";
        $resultado = $this->database->select($comando);
        if (count($resultado) == 0) {
            $comando2 = "INSERT INTO itens_carrinho (id_usuario, id_preco, quantidade, parcial) VALUES ($id_usuario,$id_preco,1, $preco)";
            $resultado2 = $this->database->insert($comando2);

            if ($resultado2)
                $response = array('status' => 'success', 'message' => 'Adicionado com sucesso!');
            else
                $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');
        } else {
            $response = array('status' => 'error', 'message' => 'Esse produto já foi adicionado!');
        }

        $this->database->closeConnection();
        return $response;
    }


    //Atualiza quantidade de itens no carrinho
    //Retorna um JSON
    public function updateQuantity($id, $id_preco, $quantidade, $parcial)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE itens_carrinho SET quantidade = $quantidade, parcial = $parcial WHERE id_usuario = $id and id_preco = $id_preco";
        $resultado = $this->database->insert($comando);

        if ($resultado)
            $resposta = array('status' => 'success');
        else
            $resposta = array('status' => 'error');

        $this->database->closeConnection();
        return $resposta;
    }

    //Deleta item do carrinho
    //Retorna um JSON
    public function deleteToCart($id, $id_preco)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "DELETE FROM itens_carrinho WHERE id_usuario=$id AND id_preco=$id_preco";
        $resultado = $this->database->insert($comando);
        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Removido com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao remover!');

        $this->database->closeConnection();
        return $response;
    }
}