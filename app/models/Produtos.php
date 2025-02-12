<?php

namespace app\models;

class Produtos
{
    private $database;

    //Lê todos os produtos de uma categoria
    //Retorna o array dos produtos
    public function readCategory($categoria)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT p.id, p.nome, p.descricao, p.status, c.nome AS nome_categoria, i.imagem AS imagem, MIN(pp.preco) AS preco FROM  produtos p INNER JOIN categorias_produtos c ON p.id_categoria = c.id INNER JOIN imagens_produtos i ON p.id = i.id_produto AND i.status = 'Principal' INNER JOIN variedades_produtos vp ON p.id = vp.id_produto INNER JOIN precos_produtos pp ON vp.id = pp.id_variedade WHERE  p.status = 'Disponível' AND p.id_categoria = $categoria GROUP BY p.id, p.nome, p.descricao, p.status, c.nome, i.imagem";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();

        return $resultado;


    }

    public function readFavorites($id_usuario){
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT p.id, p.nome, p.descricao, p.status, c.nome AS nome_categoria, i.imagem AS imagem, MIN(pp.preco) AS preco FROM  produtos p INNER JOIN categorias_produtos c ON p.id_categoria = c.id INNER JOIN imagens_produtos i ON p.id = i.id_produto AND i.status = 'Principal' INNER JOIN variedades_produtos vp ON p.id = vp.id_produto INNER JOIN precos_produtos pp ON vp.id = pp.id_variedade INNER JOIN favoritos_usuarios fu ON p.id = fu.id_produto WHERE  p.status = 'Disponível' AND fu.id_usuario = $id_usuario GROUP BY p.id, p.nome, p.descricao, p.status, c.nome, i.imagem";
        $resultado = $this->database->select($comando);
        $this->database->closeConnection();

        return $resultado;
    }

    //Pega todos os dados de um produto
    //retorna um array ou false
    public function getProduto($id_produto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT produtos.*, categorias_produtos.nome as nome_categoria, GROUP_CONCAT(DISTINCT imagens_produtos.imagem SEPARATOR ', ') AS imagens FROM produtos INNER JOIN categorias_produtos ON produtos.id_categoria = categorias_produtos.id INNER JOIN imagens_produtos ON produtos.id = imagens_produtos.id_produto  WHERE produtos.id = $id_produto and produtos.status = 'Disponível' ";
        $resultado = $this->database->select($comando);



        if (count($resultado) == 0) {

            $this->database->closeConnection();
            return false;
        } else {
            $comando2 = "SELECT  pp.id as id_preco,  vp.nome AS variedade_nome,  tp.nome AS tamanho_nome,  pp.preco FROM  variedades_produtos vp INNER JOIN precos_produtos pp ON vp.id = pp.id_variedade INNER JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id WHERE  vp.id_produto = $id_produto and vp.status = 'Disponível'";
            $resultado2 = $this->database->select($comando2);

            $this->database->closeConnection();
            if ($resultado2) {
                $produtos = array(
                    "tabela1" => $resultado[0],
                    "tabela2" => $resultado2
                );
            } else {
                $produtos = array(
                    "tabela1" => $resultado[0],
                    "tabela2" => null
                );
            }
            return $produtos;

        }

    }

    //Faz a busca de produtos
    //Retorna o array dos produtos
    public function search($nome_produto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT p.id, p.nome, cp.nome AS categoria_nome, p.descricao, ip.imagem, pp.preco AS preco FROM produtos p INNER JOIN categorias_produtos cp ON p.id_categoria = cp.id INNER JOIN imagens_produtos ip ON p.id = ip.id_produto AND ip.status = 'Principal' INNER JOIN ( SELECT vp.id_produto, MIN(pp.preco) AS preco FROM variedades_produtos vp INNER JOIN precos_produtos pp ON vp.id = pp.id_variedade GROUP BY vp.id_produto ) AS pp ON p.id = pp.id_produto WHERE p.status = 'Disponível' AND LOWER(p.nome) LIKE '%$nome_produto%' ORDER BY p.id_categoria ASC, p.nome ASC;";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }
    public function searchSuggestion($nome_produto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT nome from produtos where status = 'Disponível' AND LOWER(nome) LIKE '%$nome_produto%'";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    public function readAll()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando1 = "SELECT p.id, p.nome, p.descricao, p.status, c.nome AS categoria_nome, i.imagem, i.status AS imagem_status FROM produtos p LEFT JOIN categorias_produtos c ON p.id_categoria = c.id LEFT JOIN imagens_produtos i ON p.id = i.id_produto ORDER BY p.id, i.status;";

        $comando2 = "SELECT  p.id, v.nome AS variedade_nome, v.id as variedade_id, v.status as variedade_status, tp.nome AS tamanho_nome, pr.preco, pr.id as preco_id FROM produtos p LEFT JOIN variedades_produtos v ON p.id = v.id_produto LEFT JOIN precos_produtos pr ON v.id = pr.id_variedade LEFT JOIN tamanhos_produtos tp ON pr.id_tamanho = tp.id";

        $comando3 = "SELECT * FROM categorias_produtos";

        $comando4 = "SELECT * FROM tamanhos_produtos";

        $resultado1 = $this->database->select($comando1);
        $resultado2 = $this->database->select($comando2);
        $resultado3 = $this->database->select($comando3);
        $resultado4 = $this->database->select($comando4);

        $this->database->closeConnection();


        $tabela1 = array_reduce($resultado1, function ($carry, $item) {
            $id = $item['id'];
            $index = array_search($id, array_column($carry, 'id'));
            if ($index === false) {
                $carry[] = array(
                    'id' => $id,
                    'nome' => $item['nome'],
                    'descricao' => $item['descricao'],
                    'status' => $item['status'],
                    'categoria_nome' => $item['categoria_nome'],
                    'imagens' => array(),
                );
                $index = count($carry) - 1;
            }
            $imagens = &$carry[$index]['imagens'];
            $imagens[] = array(
                'imagem' => $item['imagem'],
                'imagem_status' => $item['imagem_status'],
                'principal' => $item['imagem_status'] == 'Principal',
            );
            return $carry;
        }, array());

        $tabela2 = $resultado2;

        $resposta = array(
            'tabela1' => $tabela1,
            'tabela2' => $tabela2,
            'categorias' => $resultado3,
            'tamanhos' => $resultado4
        );

        return $resposta;
    }

    public function readAllSearch($chave, $parametro)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        if ($chave == 'categoria') {
            $comando1 = "SELECT p.id, p.nome, p.descricao, p.status, c.nome AS categoria_nome, i.imagem, i.status AS imagem_status FROM produtos p LEFT JOIN categorias_produtos c ON p.id_categoria = c.id LEFT JOIN imagens_produtos i ON p.id = i.id_produto WHERE c.nome LIKE '%$parametro%' ORDER BY p.id, i.status;";

            $comando2 = "SELECT  p.id, v.nome AS variedade_nome, v.id as variedade_id, v.status as variedade_status, tp.nome AS tamanho_nome, pr.preco, pr.id as preco_id FROM produtos p LEFT JOIN variedades_produtos v ON p.id = v.id_produto LEFT JOIN precos_produtos pr ON v.id = pr.id_variedade LEFT JOIN tamanhos_produtos tp ON pr.id_tamanho = tp.id WHERE c.nome LIKE '%$parametro%'";
        } else {
            $comando1 = "SELECT p.id, p.nome, p.descricao, p.status, c.nome AS categoria_nome, i.imagem, i.status AS imagem_status FROM produtos p LEFT JOIN categorias_produtos c ON p.id_categoria = c.id LEFT JOIN imagens_produtos i ON p.id = i.id_produto WHERE p.$chave LIKE '%$parametro%' ORDER BY p.id, i.status;";

            $comando2 = "SELECT  p.id, v.nome AS variedade_nome, v.id as variedade_id, v.status as variedade_status, tp.nome AS tamanho_nome, pr.preco, pr.id as preco_id FROM produtos p LEFT JOIN variedades_produtos v ON p.id = v.id_produto LEFT JOIN precos_produtos pr ON v.id = pr.id_variedade LEFT JOIN tamanhos_produtos tp ON pr.id_tamanho = tp.id WHERE p.$chave LIKE '%$parametro%'";
        }


        $comando3 = "SELECT * FROM categorias_produtos";

        $comando4 = "SELECT * FROM tamanhos_produtos";

        $resultado1 = $this->database->select($comando1);
        $resultado2 = $this->database->select($comando2);
        $resultado3 = $this->database->select($comando3);
        $resultado4 = $this->database->select($comando4);

        $this->database->closeConnection();


        $tabela1 = array_reduce($resultado1, function ($carry, $item) {
            $id = $item['id'];
            $index = array_search($id, array_column($carry, 'id'));
            if ($index === false) {
                $carry[] = array(
                    'id' => $id,
                    'nome' => $item['nome'],
                    'descricao' => $item['descricao'],
                    'status' => $item['status'],
                    'categoria_nome' => $item['categoria_nome'],
                    'imagens' => array(),
                );
                $index = count($carry) - 1;
            }
            $imagens = &$carry[$index]['imagens'];
            $imagens[] = array(
                'imagem' => $item['imagem'],
                'imagem_status' => $item['imagem_status'],
                'principal' => $item['imagem_status'] == 'Principal',
            );
            return $carry;
        }, array());

        $tabela2 = $resultado2;

        $resposta = array(
            'tabela1' => $tabela1,
            'tabela2' => $tabela2,
            'categorias' => $resultado3,
            'tamanhos' => $resultado4
        );

        return $resposta;
    }

    public function getAllFromProduct($id_produto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando1 = "SELECT p.id, p.nome, p.descricao, p.status, c.nome AS categoria_nome, i.imagem, i.status AS imagem_status FROM produtos p LEFT JOIN categorias_produtos c ON p.id_categoria = c.id LEFT JOIN imagens_produtos i ON p.id = i.id_produto WHERE p.id=$id_produto ORDER BY p.id, i.status;";

        $comando2 = "SELECT  p.id, v.nome AS variedade_nome, v.id as variedade_id, v.status as variedade_status, tp.nome AS tamanho_nome, pr.preco, pr.id as preco_id FROM produtos p LEFT JOIN variedades_produtos v ON p.id = v.id_produto LEFT JOIN precos_produtos pr ON v.id = pr.id_variedade LEFT JOIN tamanhos_produtos tp ON pr.id_tamanho = tp.id WHERE p.id=$id_produto";

        $comando3 = "SELECT * FROM categorias_produtos";

        $comando4 = "SELECT * FROM tamanhos_produtos";

        $resultado1 = $this->database->select($comando1);
        $resultado2 = $this->database->select($comando2);
        $resultado3 = $this->database->select($comando3);
        $resultado4 = $this->database->select($comando4);

        $this->database->closeConnection();


        $tabela1 = array_reduce($resultado1, function ($carry, $item) {
            $id = $item['id'];
            $index = array_search($id, array_column($carry, 'id'));
            if ($index === false) {
                $carry[] = array(
                    'id' => $id,
                    'nome' => $item['nome'],
                    'descricao' => $item['descricao'],
                    'status' => $item['status'],
                    'categoria_nome' => $item['categoria_nome'],
                    'imagens' => array(),
                );
                $index = count($carry) - 1;
            }
            $imagens = &$carry[$index]['imagens'];
            $imagens[] = array(
                'imagem' => $item['imagem'],
                'imagem_status' => $item['imagem_status'],
                'principal' => $item['imagem_status'] == 'Principal',
            );
            return $carry;
        }, array());

        $tabela2 = $resultado2;

        $resposta = array(
            'tabela1' => $tabela1,
            'tabela2' => $tabela2,
            'categorias' => $resultado3,
            'tamanhos' => $resultado4
        );

        return $resposta;

    }

    public function addProduct($foto, $nome, $categoria, $descricao, $status, $preco)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = " INSERT INTO produtos (nome, id_categoria, descricao, status) VALUES ('$nome', $categoria,'$descricao','$status');

        SET @produto_id = LAST_INSERT_ID();

        INSERT INTO imagens_produtos (id_produto,imagem,status) VALUES (@produto_id, '$foto', 'Principal');
        INSERT INTO variedades_produtos (id_produto, nome, status) VALUES (@produto_id, 'Tradicional', 'Disponível');

        SET @variedade_id = LAST_INSERT_ID();

        INSERT INTO precos_produtos (id_variedade, id_tamanho, preco) VALUES (@variedade_id, 4, $preco); ";

        $resultado = $this->database->insert($comando);

        $this->database->closeConnection();

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Adicionado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');

        return $response;


    }

    public function deleteProduct($id_produto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "DELETE p, ip, vp, pp FROM produtos p LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto LEFT JOIN variedades_produtos vp ON p.id = vp.id_produto LEFT JOIN precos_produtos pp ON vp.id = pp.id_variedade WHERE p.id = $id_produto;";

        $resultado = $this->database->insert($comando);

        $this->database->closeConnection();
        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Deletado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao deletar!');

        return $response;

    }

    public function toUpImage($id_produto, $imagem)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT id FROM imagens_produtos WHERE id_produto = $id_produto and status = 'Principal'";
        $resultado = $this->database->select($comando);

        if (count($resultado) > 0) {
            $comando2 = "UPDATE imagens_produtos SET status = 'Secundaria' WHERE id = " . $resultado[0]['id'];
            $resultado2 = $this->database->insert($comando2);
            if ($resultado2) {
                $comando3 = "UPDATE imagens_produtos SET status = 'Principal' WHERE id_produto = $id_produto and imagem = '$imagem'";
                $resultado3 = $this->database->insert($comando3);

                if ($resultado3)
                    $response = array('status' => 'success', 'message' => 'Nova imagem principal!');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao definir!');
            } else
                $response = array('status' => 'error', 'message' => 'Erro ao definir secundária');
        } else {
            $comando3 = "UPDATE imagens_produtos SET status = 'Principal' WHERE id_produto = $id_produto and imagem = '$imagem'";
            $resultado3 = $this->database->insert($comando3);

            if ($resultado3)
                $response = array('status' => 'success', 'message' => 'Nova imagem principal!');
            else
                $response = array('status' => 'error', 'message' => 'Erro ao definir!');
        }

        $this->database->closeConnection();
        return $response;
    }

    public function deleteImage($id_produto, $imagem)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT status FROM imagens_produtos WHERE id_produto = $id_produto and imagem = '$imagem'";
        $resultado = $this->database->select($comando);

        if ($resultado[0]['status'] == 'Principal') {
            $response = array('status' => 'error', 'message' => 'Essa é a imagem principal!');
        } else {
            $comando2 = "DELETE FROM imagens_produtos WHERE id_produto = $id_produto and imagem = '$imagem'";
            $resultado2 = $this->database->insert($comando2);


            if ($resultado2)
                $response = array('status' => 'success', 'message' => 'Deletado com sucesso!');
            else
                $response = array('status' => 'error', 'message' => 'Erro ao deletar!');
        }

        $this->database->closeConnection();
        return $response;
    }

    public function addImage($id_produto, $imagem)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "INSERT INTO imagens_produtos (id_produto, imagem) VALUES ($id_produto, '$imagem');";
        $resultado = $this->database->insert($comando);


        $this->database->closeConnection();
        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Adicionado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');

        return $response;
    }

    public function updateProduct($id_produto, $nome, $descricao, $status, $categoria)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();
        $comando = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', status = '$status', id_categoria = $categoria WHERE id = $id_produto";
        $resultado = $this->database->insert($comando);
        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');
        $this->database->closeConnection();
        return $response;
    }

    public function addVariety($id_produto, $nome)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM variedades_produtos WHERE id_produto = $id_produto";
        $resultado = $this->database->select($comando);

        if ($resultado[0]['nome'] == 'Tradicional') {
            $comando2 = "UPDATE variedades_produtos SET nome = '$nome' WHERE id=" . $resultado[0]['id'];
            $resultado2 = $this->database->insert($comando2);
            if ($resultado2)
                $response = array('status' => 'success', 'message' => 'Adicionado com sucesso!');
            else
                $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');
        } else {
            $comando2 = "INSERT INTO variedades_produtos (id_produto, nome) VALUES ($id_produto,'$nome');";
            $resultado2 = $this->database->insert($comando2);
            if ($resultado2) {
                $comando3 = "SELECT preco FROM precos_produtos WHERE id_variedade =" . $resultado[0]['id'];
                $resultado3 = $this->database->select($comando3);

                $comando4 = "INSERT INTO precos_produtos (id_variedade, id_tamanho, preco) VALUES (LAST_INSERT_ID(), 4," . $resultado3[0]['preco'] . ")";
                $resultado4 = $this->database->insert($comando4);

                if ($resultado2)
                    $response = array('status' => 'success', 'message' => 'Adicionado com sucesso!');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');
            } else
                $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');
        }

        $this->database->closeConnection();
        return $response;
    }

    public function deleteVariety($id_variedade)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM variedades_produtos WHERE id = $id_variedade";
        $resultado = $this->database->select($comando);
        if (count($resultado) > 0) {
            $comando2 = "SELECT * FROM variedades_produtos WHERE id_produto  = " . $resultado[0]['id_produto'];
            $resultado2 = $this->database->select($comando2);
            if (count($resultado2) == 1) {
                $comando3 = "UPDATE variedades_produtos SET nome='Tradicional' WHERE id=$id_variedade";
                $resultado3 = $this->database->insert($comando3);
                if ($resultado3)
                    $response = array('status' => 'success', 'message' => 'Transformado em tradicional!');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao deletar!');
            } else {
                $comando3 = "DELETE FROM variedades_produtos WHERE id = $id_variedade";
                $resultado3 = $this->database->insert($comando3);
                if ($resultado3)
                    $response = array('status' => 'success', 'message' => 'Deletado com sucesso!');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao deletar!');
            }

        } else {
            $response = array('status' => 'error', 'message' => 'Variedade não encontrada!');
        }

        $this->database->closeConnection();
        return $response;

    }

    public function editVariety($id, $nome, $status)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE variedades_produtos SET nome = '$nome', status = '$status' WHERE id=$id";
        $resultado = $this->database->insert($comando);
        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Editado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao editar');

        $this->database->closeConnection();
        return $response;

    }

    public function addPrice($id_variedade, $preco, $id_tamanho)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM precos_produtos WHERE id_variedade = $id_variedade AND id_tamanho = $id_tamanho";
        $resultado = $this->database->select($comando);

        if (count($resultado) > 0) {
            $response = array('status' => 'error', 'message' => 'Já existe um preço para isso!');
        } else {
            $comando2 = "SELECT * FROM precos_produtos WHERE id_variedade = $id_variedade AND id_tamanho = 4";
            $resultado2 = $this->database->select($comando2);
            if (count($resultado2) > 0) {
                $comando3 = "UPDATE precos_produtos SET id_tamanho = $id_tamanho, preco = $preco WHERE id=" . $resultado2[0]['id'];
                $resultado3 = $this->database->insert($comando3);
                if ($resultado3)
                    $response = array('status' => 'success', 'message' => 'Adicionado com sucesso!');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');


            } else {
                $comando3 = "INSERT INTO precos_produtos (id_variedade, preco, id_tamanho) VALUES ($id_variedade,$preco,$id_tamanho)";
                $resultado3 = $this->database->insert($comando3);
                if ($resultado3)
                    $response = array('status' => 'success', 'message' => 'Adicionado com sucesso!');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao adicionar!');
            }

        }

        $this->database->closeConnection();
        return $response;

    }

    public function deletePrice($id)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM precos_produtos WHERE id=$id";
        $resultado = $this->database->select($comando);
        if (count($resultado) > 0) {
            $comando2 = "SELECT * FROM precos_produtos WHERE id_variedade = " . $resultado[0]['id_variedade'];
            $resultado2 = $this->database->select($comando2);
            if (count($resultado2) == 1) {
                $response = array('status' => 'error', 'message' => 'Variedade não fica sem preço!');
            } else {
                $comando3 = "DELETE FROM precos_produtos WHERE id=$id";
                $resultado3 = $this->database->insert($comando3);
                if ($resultado3)
                    $response = array('status' => 'success', 'message' => 'Deletado com sucesso');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao deletar');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Não existe esse preço');
        }

        $this->database->closeConnection();
        return $response;
    }
}