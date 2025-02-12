<?php

namespace app\models;

class Pedidos
{
    private $database;

    public function addRequest($id_usuario, $observacoes, $formapagamento)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        //Seleciona os itens do carrinho, quantidade e o preço
        $comando = "SELECT ic.id_preco, ic.quantidade, pp.preco
                    FROM itens_carrinho ic
                    JOIN precos_produtos pp ON ic.id_preco = pp.id
                    WHERE ic.id_usuario = $id_usuario;";
        $resultado = $this->database->select($comando);

        if (count($resultado) > 0) {
            //Faz a soma total do pedido
            $comando2 = "SELECT SUM(ic.quantidade * pp.preco) AS total
                        FROM itens_carrinho ic
                        JOIN precos_produtos pp ON ic.id_preco = pp.id
                        WHERE ic.id_usuario = $id_usuario;";
            $resultado2 = $this->database->select($comando2);

            //Insere o pedido no banco
            $comando3 = "INSERT INTO pedidos (data, total, status, id_usuario, observacoes)
                        VALUES (NOW(), " . $resultado2[0]['total'] . ", 'Pendente', $id_usuario, '$observacoes');
                        SET @id_pedido = LAST_INSERT_ID();";
            $resultado3 = $this->database->insert($comando3);

            if ($resultado3) {
                //Insere os itens do pedido no banco
                $comando4 = "INSERT INTO detalhes_pedidos (id_pedido, id_preco, quantidade, preco_unitario, subtotal)
                            SELECT @id_pedido, ic.id_preco, ic.quantidade, pp.preco, ic.quantidade * pp.preco
                            FROM itens_carrinho ic
                            JOIN precos_produtos pp ON ic.id_preco = pp.id
                            WHERE ic.id_usuario = $id_usuario;";
                $resultado4 = $this->database->insert($comando4);

                if ($resultado4) {
                    //Insere o pagamento no banco
                    switch ($formapagamento) {
                        case '1':
                            $comando5 = "INSERT INTO pagamentos (id_pedido, id_forma, valor, status) VALUES (@id_pedido, $formapagamento, " . $resultado2[0]['total'] . ", 'Não Pago');";
                            break;
                        case '2':
                            $comando5 = "INSERT INTO pagamentos (id_pedido, id_forma, valor, data, status) VALUES (@id_pedido, $formapagamento, " . $resultado2[0]['total'] . ", NOW() , 'Pago');
                                        UPDATE usuarios SET saldo = " . ($_SESSION['saldo'] - $resultado2[0]['total']) . " WHERE id=$id_usuario;";
                            break;
                        default:
                            $comando5 = "INSERT INTO pagamentos (id_pedido, id_forma, valor, status) VALUES (@id_pedido, $formapagamento, " . $resultado2[0]['total'] . ", 'Não Pago');";
                            break;
                    }
                    $resultado5 = $this->database->insert($comando5);
                    if ($resultado5) {
                        $response = array('status' => 'success', 'message' => 'Pedido feito com sucesso!');


                        $comando6 = "DELETE FROM carrinho WHERE id_usuario=$id_usuario;";
                        $resultado6 = $this->database->insert($comando6);

                        $comando7 = "INSERT INTO carrinho(id_usuario) VALUES($id_usuario)";
                        $resultado7 = $this->database->insert($comando7);
                    } else {
                        $response = array('status' => 'error', 'message' => 'Erro ao fazer pedido! 3');
                        $comando5 = "DELETE FROM pedidos WHERE id=@id_pedido;";
                        $resultado5 = $this->database->insert($comando5);
                    }
                } else {
                    $response = array('status' => 'error', 'message' => 'Erro ao fazer pedido! 2');
                    $comando5 = "DELETE FROM pedidos WHERE id=@id_pedido;";
                    $resultado5 = $this->database->insert($comando5);
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Erro ao fazer pedido! 1');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Não há produtos no carrinho!');
        }

        $this->database->closeConnection();
        return $response;
    }
    public function readAll()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT
    p.id AS id_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y às %H:%i:%s') AS data_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y') AS data_diapedido,
    p.total AS total_pedido,
    p.status AS status_pedido,
    p.id_usuario,
    p.observacoes AS observacoes_pedido,
    DATE_FORMAT(pg.data, '%d/%m/%Y às %H:%i:%s') AS data_pagamento,
    pg.status AS status_pagamento,
    fp.nome AS nome_formapagamento,
    u.nome AS nome_usuario,
    u.sobrenome AS sobrenome_usuario,
    u.imagem AS imagem_usuario
FROM
    pedidos p
    LEFT JOIN pagamentos pg ON p.id = pg.id_pedido
    LEFT JOIN formas_pagamentos fp ON pg.id_forma = fp.id
    LEFT JOIN usuarios u ON p.id_usuario = u.id;";

        $comando2 = "SELECT  
    dp.id AS id_detalhes,
    dp.id_pedido,
    dp.quantidade AS quantidade_produto,
    dp.preco_unitario AS preco_produto,
    dp.subtotal AS preco_item,
    tp.nome AS tamanho_produto,
    vp.nome AS nome_variedade,
    p.nome AS nome_produto,
    ip.imagem AS imagem_produto
FROM 
    detalhes_pedidos dp
    LEFT JOIN precos_produtos pp ON dp.id_preco = pp.id
    LEFT JOIN variedades_produtos vp ON pp.id_variedade = vp.id
    LEFT JOIN produtos p ON p.id = vp.id_produto
    LEFT JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
    LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto
WHERE 
    ip.status = 'Principal';";

        $resultado = $this->database->select($comando);
        $resultado2 = $this->database->select($comando2);

        $response = array(
            'pedido' => $resultado,
            'itens' => $resultado2
        );

        $this->database->closeConnection();
        return $response;
    }

    public function readAllSearch($chave, $parametro)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        switch ($chave) {
            case 'nome':
                $comando = "SELECT
    p.id AS id_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y às %H:%i:%s') AS data_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y') AS data_diapedido,
    p.total AS total_pedido,
    p.status AS status_pedido,
    p.id_usuario,
    p.observacoes AS observacoes_pedido,
    DATE_FORMAT(pg.data, '%d/%m/%Y às %H:%i:%s') AS data_pagamento,
    pg.status AS status_pagamento,
    fp.nome AS nome_formapagamento,
    u.nome AS nome_usuario,
    u.sobrenome AS sobrenome_usuario,
    u.imagem AS imagem_usuario
FROM
    pedidos p
    LEFT JOIN pagamentos pg ON p.id = pg.id_pedido
    LEFT JOIN formas_pagamentos fp ON pg.id_forma = fp.id
    LEFT JOIN usuarios u ON p.id_usuario = u.id
    WHERE u.nome LIKE '%$parametro%';";
                $comando2 = "SELECT  
    dp.id AS id_detalhes,
    dp.id_pedido,
    dp.quantidade AS quantidade_produto,
    dp.preco_unitario AS preco_produto,
    dp.subtotal AS preco_item,
    tp.nome AS tamanho_produto,
    vp.nome AS nome_variedade,
    p.nome AS nome_produto,
    ip.imagem AS imagem_produto
FROM 
    detalhes_pedidos dp
    LEFT JOIN precos_produtos pp ON dp.id_preco = pp.id
    LEFT JOIN variedades_produtos vp ON pp.id_variedade = vp.id
    LEFT JOIN produtos p ON p.id = vp.id_produto
    LEFT JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
    LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto
    LEFT JOIN pedidos ON dp.id_pedido=pedidos.id
    LEFT JOIN usuarios u ON u.id = pedidos.id_usuario
WHERE 
    ip.status = 'Principal'
    and u.nome LIKE '%$parametro%';";
                break;

            case 'status':
                $comando = "SELECT
    p.id AS id_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y às %H:%i:%s') AS data_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y') AS data_diapedido,
    p.total AS total_pedido,
    p.status AS status_pedido,
    p.id_usuario,
    p.observacoes AS observacoes_pedido,
    DATE_FORMAT(pg.data, '%d/%m/%Y às %H:%i:%s') AS data_pagamento,
    pg.status AS status_pagamento,
    fp.nome AS nome_formapagamento,
    u.nome AS nome_usuario,
    u.sobrenome AS sobrenome_usuario,
    u.imagem AS imagem_usuario
FROM
    pedidos p
    LEFT JOIN pagamentos pg ON p.id = pg.id_pedido
    LEFT JOIN formas_pagamentos fp ON pg.id_forma = fp.id
    LEFT JOIN usuarios u ON p.id_usuario = u.id
    WHERE p.status LIKE '%$parametro%';";
                $comando2 = "SELECT  
     dp.id AS id_detalhes,
     dp.id_pedido,
     dp.quantidade AS quantidade_produto,
     dp.preco_unitario AS preco_produto,
     dp.subtotal AS preco_item,
     tp.nome AS tamanho_produto,
     vp.nome AS nome_variedade,
     p.nome AS nome_produto,
     ip.imagem AS imagem_produto
 FROM 
     detalhes_pedidos dp
     LEFT JOIN precos_produtos pp ON dp.id_preco = pp.id
     LEFT JOIN variedades_produtos vp ON pp.id_variedade = vp.id
     LEFT JOIN produtos p ON p.id = vp.id_produto
     LEFT JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
     LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto
     LEFT JOIN pedidos ON dp.id_pedido=pedidos.id
     LEFT JOIN usuarios u ON u.id = pedidos.id_usuario
 WHERE 
     ip.status = 'Principal'
     and pedidos.status LIKE '%$parametro%';";
                break;

            case 'pagamento':
                $comando = "SELECT
    p.id AS id_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y às %H:%i:%s') AS data_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y') AS data_diapedido,
    p.total AS total_pedido,
    p.status AS status_pedido,
    p.id_usuario,
    p.observacoes AS observacoes_pedido,
    DATE_FORMAT(pg.data, '%d/%m/%Y às %H:%i:%s') AS data_pagamento,
    pg.status AS status_pagamento,
    fp.nome AS nome_formapagamento,
    u.nome AS nome_usuario,
    u.sobrenome AS sobrenome_usuario,
    u.imagem AS imagem_usuario
FROM
    pedidos p
    LEFT JOIN pagamentos pg ON p.id = pg.id_pedido
    LEFT JOIN formas_pagamentos fp ON pg.id_forma = fp.id
    LEFT JOIN usuarios u ON p.id_usuario = u.id
    WHERE pg.status LIKE '%$parametro%';";
                $comando2 = "SELECT  
    dp.id AS id_detalhes,
    dp.id_pedido,
    dp.quantidade AS quantidade_produto,
    dp.preco_unitario AS preco_produto,
    dp.subtotal AS preco_item,
    tp.nome AS tamanho_produto,
    vp.nome AS nome_variedade,
    p.nome AS nome_produto,
    ip.imagem AS imagem_produto
FROM 
    detalhes_pedidos dp
    LEFT JOIN precos_produtos pp ON dp.id_preco = pp.id
    LEFT JOIN variedades_produtos vp ON pp.id_variedade = vp.id
    LEFT JOIN produtos p ON p.id = vp.id_produto
    LEFT JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
    LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto
    LEFT JOIN pedidos ON dp.id_pedido=pedidos.id
    LEFT JOIN usuarios u ON u.id = pedidos.id_usuario
    LEFT JOIN pagamentos ON pagamentos.id_pedido=pedidos.id
WHERE 
    ip.status = 'Principal'
    and pagamentos.status LIKE '%$parametro%';";
                break;
            default:
                $comando = "SELECT
    p.id AS id_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y às %H:%i:%s') AS data_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y') AS data_diapedido,
    p.total AS total_pedido,
    p.status AS status_pedido,
    p.id_usuario,
    p.observacoes AS observacoes_pedido,
    DATE_FORMAT(pg.data, '%d/%m/%Y às %H:%i:%s') AS data_pagamento,
    pg.status AS status_pagamento,
    fp.nome AS nome_formapagamento,
    u.nome AS nome_usuario,
    u.sobrenome AS sobrenome_usuario,
    u.imagem AS imagem_usuario
FROM
    pedidos p
    LEFT JOIN pagamentos pg ON p.id = pg.id_pedido
    LEFT JOIN formas_pagamentos fp ON pg.id_forma = fp.id
    LEFT JOIN usuarios u ON p.id_usuario = u.id;";

                $comando2 = "SELECT  
    dp.id AS id_detalhes,
    dp.id_pedido,
    dp.quantidade AS quantidade_produto,
    dp.preco_unitario AS preco_produto,
    dp.subtotal AS preco_item,
    tp.nome AS tamanho_produto,
    vp.nome AS nome_variedade,
    p.nome AS nome_produto,
    ip.imagem AS imagem_produto
FROM 
    detalhes_pedidos dp
    LEFT JOIN precos_produtos pp ON dp.id_preco = pp.id
    LEFT JOIN variedades_produtos vp ON pp.id_variedade = vp.id
    LEFT JOIN produtos p ON p.id = vp.id_produto
    LEFT JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
    LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto
WHERE 
    ip.status = 'Principal';";

        }
        $resultado = $this->database->select($comando);
        $resultado2 = $this->database->select($comando2);

        $response = array(
            'pedido' => $resultado,
            'itens' => $resultado2
        );

        $this->database->closeConnection();
        return $response;
    }

    public function readAllFromRequest($id_pedido)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT
    p.id AS id_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y às %H:%i:%s') AS data_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y') AS data_diapedido,
    p.total AS total_pedido,
    p.status AS status_pedido,
    p.id_usuario,
    p.observacoes AS observacoes_pedido,
    DATE_FORMAT(pg.data, '%d/%m/%Y às %H:%i:%s') AS data_pagamento,
    pg.status AS status_pagamento,
    fp.nome AS nome_formapagamento,
    u.nome AS nome_usuario,
    u.sobrenome AS sobrenome_usuario,
    u.imagem AS imagem_usuario
FROM
    pedidos p
    LEFT JOIN pagamentos pg ON p.id = pg.id_pedido
    LEFT JOIN formas_pagamentos fp ON pg.id_forma = fp.id
    LEFT JOIN usuarios u ON p.id_usuario = u.id
    WHERE p.id=$id_pedido;";

        $comando2 = "SELECT  
    dp.id AS id_detalhes,
    dp.id_pedido,
    dp.quantidade AS quantidade_produto,
    dp.preco_unitario AS preco_produto,
    dp.subtotal AS preco_item,
    tp.nome AS tamanho_produto,
    vp.nome AS nome_variedade,
    p.nome AS nome_produto,
    ip.imagem AS imagem_produto
FROM 
    detalhes_pedidos dp
    LEFT JOIN precos_produtos pp ON dp.id_preco = pp.id
    LEFT JOIN variedades_produtos vp ON pp.id_variedade = vp.id
    LEFT JOIN produtos p ON p.id = vp.id_produto
    LEFT JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
    LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto
WHERE 
    ip.status = 'Principal' and
    dp.id_pedido=$id_pedido;";

        $comando3 = "SELECT id, nome FROM formas_pagamentos";

        $resultado = $this->database->select($comando);
        $resultado2 = $this->database->select($comando2);
        $resultado3 = $this->database->select($comando3);

        $response = array(
            'pedido' => $resultado,
            'itens' => $resultado2,
            'formapagamento' => $resultado3
        );

        $this->database->closeConnection();
        return $response;
    }

    public function getFormPay()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = 'SELECT * FROM formas_pagamentos';
        $resultado = $this->database->select($comando);


        $this->database->closeConnection();
        return $resultado;
    }

    public function editStatusRequest($id_pedido, $status)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando="SELECT u.id FROM usuarios u LEFT JOIN pedidos p ON u.id=p.id_usuario WHERE p.id=$id_pedido;";
        $resultado = $this->database->select($comando);

        $comando2 = "UPDATE pedidos SET status='$status' WHERE id = $id_pedido;
        INSERT INTO notificacoes(id_usuario, data, titulo, texto) VALUES (".$resultado[0]['id'].", NOW(), 'Seu pedido foi atualizado!', 'A situação do seu pedido foi alterado para $status! Verifique-o na aba de pedidos!');";
        $resultado2 = $this->database->insert($comando2);

        if ($resultado2)
            $response = array('status' => 'success', 'message' => 'Atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');

        $this->database->closeConnection();
        return $response;
    }
    public function addPayday($id_pedido)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando="SELECT u.id FROM usuarios u LEFT JOIN pedidos p ON u.id=p.id_usuario WHERE p.id=$id_pedido;";
        $resultado = $this->database->select($comando);

        $comando2 = "UPDATE pagamentos SET status='Pago', data = NOW()  WHERE id_pedido = $id_pedido;
        INSERT INTO notificacoes(id_usuario, data, titulo, texto) VALUES (".$resultado[0]['id'].", NOW(), 'O pagamento de seu pedido foi atualizado!', 'A situação do pagamento do seu pedido foi alterado para Pago! Verifique-o na aba de pedidos!');";
        $resultado2 = $this->database->insert($comando2);

        if ($resultado2)
            $response = array('status' => 'success', 'message' => 'Atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');

        $this->database->closeConnection();
        return $response;
    }

    public function getUserRequests($id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT
    p.id AS id_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y às %H:%i:%s') AS data_pedido,
    DATE_FORMAT(p.data, '%d/%m/%Y') AS data_diapedido,
    p.total AS total_pedido,
    p.status AS status_pedido,
    p.id_usuario,
    p.observacoes AS observacoes_pedido,
    DATE_FORMAT(pg.data, '%d/%m/%Y às %H:%i:%s') AS data_pagamento,
    pg.status AS status_pagamento,
    fp.nome AS nome_formapagamento,
    u.nome AS nome_usuario,
    u.sobrenome AS sobrenome_usuario,
    u.imagem AS imagem_usuario
FROM
    pedidos p
    LEFT JOIN pagamentos pg ON p.id = pg.id_pedido
    LEFT JOIN formas_pagamentos fp ON pg.id_forma = fp.id
    LEFT JOIN usuarios u ON p.id_usuario = u.id
    WHERE u.id=$id_usuario
    order by p.id DESC;";

        $comando2 = "SELECT  
dp.id AS id_detalhes,
dp.id_pedido,
dp.quantidade AS quantidade_produto,
dp.preco_unitario AS preco_produto,
dp.subtotal AS preco_item,
tp.nome AS tamanho_produto,
vp.nome AS nome_variedade,
p.nome AS nome_produto,
ip.imagem AS imagem_produto
FROM 
detalhes_pedidos dp
LEFT JOIN precos_produtos pp ON dp.id_preco = pp.id
LEFT JOIN variedades_produtos vp ON pp.id_variedade = vp.id
LEFT JOIN produtos p ON p.id = vp.id_produto
LEFT JOIN tamanhos_produtos tp ON pp.id_tamanho = tp.id
LEFT JOIN imagens_produtos ip ON p.id = ip.id_produto
LEFT JOIN pedidos ON dp.id_pedido=pedidos.id
LEFT JOIN usuarios u ON u.id = pedidos.id_usuario
WHERE 
ip.status = 'Principal'
and u.id = $id_usuario;";

        $resultado = $this->database->select($comando);
        $resultado2 = $this->database->select($comando2);

        $response = array(
            'pedido' => $resultado,
            'itens' => $resultado2
        );

        $this->database->closeConnection();
        return $response;
    }

    public function cancelRequest($id_pedido)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE pedidos SET status='Cancelado' WHERE id=$id_pedido";
        $resultado = $this->database->insert($comando);

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Cancelado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar!');

        $this->database->closeConnection();
        return $response;
    }
}