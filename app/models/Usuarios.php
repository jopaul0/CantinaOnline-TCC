<?php

namespace app\models;


class Usuarios
{
    private $database;

    // Método para registrar um novo usuário
    //Retorna JSON
    public function register($cpf, $nome, $sobrenome, $telefone, $senha, $email)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * from usuarios WHERE cpf = '$cpf'";
        $resultado = $this->database->select($comando);
        if (count($resultado) > 0) {
            $response = array('status' => 'error', 'message' => 'CPF já cadastrado!');
        } else {
            $comando = "SELECT * from usuarios WHERE email = '$email'";
            $resultado = $this->database->select($comando);
            if (count($resultado) > 0) {
                $response = array('status' => 'error', 'message' => 'E-mail já cadastrado!');
            } else {
                $comando = "SELECT * from usuarios where telefone = '$telefone'";
                $resultado = $this->database->select($comando);
                if (count($resultado) > 0) {
                    $response = array('status' => 'error', 'message' => 'Telefone já cadastrado!');
                } else {
                    $comando = "INSERT INTO usuarios (nome, sobrenome, cpf, telefone, email, senha, imagem) VALUES ('$nome','$sobrenome','$cpf','$telefone','$email','$senha','default.jpg');
                    SET @ultimo_id = LAST_INSERT_ID();
                    INSERT INTO preferencias_usuarios (id_usuario, id_forma) VALUES (@ultimo_id, 1);
                    INSERT INTO status_usuarios (id_usuario) VALUES (@ultimo_id);
                    INSERT INTO carrinho(id_usuario) VALUES (@ultimo_id);
                    INSERT INTO notificacoes(id_usuario, data, titulo, texto) VALUES (@ultimo_id, NOW(), 'Seja bem-vindo ao CantinaOnline+', 'Você realizou um cadastro na plataforma CantinaOnline+! Aproveite nossos produtos!')";
                    $resultado = $this->database->insert($comando);

                    if ($resultado)
                        $response = array('status' => 'success', 'message' => 'Sucesso ao registrar!');
                    else
                        $response = array('status' => 'error', 'message' => 'Erro ao inserir dados!');
                }
            }
        }
        $this->database->closeConnection();
        return $response;
    }

    //Método para logar
    //Retorna JSON
    public function login($usuario, $senha)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT usuarios.*, status_usuarios.status, preferencias_usuarios.tema, preferencias_usuarios.notificacoes, preferencias_usuarios.id_forma as formapagamento
                    FROM usuarios
                    INNER JOIN status_usuarios  ON usuarios.id = status_usuarios.id_usuario
                    INNER JOIN preferencias_usuarios ON usuarios.id = preferencias_usuarios.id_usuario
                   
                    WHERE email='$usuario' AND senha='$senha';";
        $resultado = $this->database->select($comando);

        if (count($resultado) == 1) {
            if (!isset($_SESSION))
                session_start();

            $_SESSION['id'] = $resultado[0]['id'];
            $_SESSION['nome'] = $resultado[0]['nome'];
            $_SESSION['sobrenome'] = $resultado[0]['sobrenome'];
            $_SESSION['telefone'] = $resultado[0]['telefone'];
            $_SESSION['imagem'] = $resultado[0]['imagem'];
            $_SESSION['email'] = $resultado[0]['email'];
            $_SESSION['cpf'] = $resultado[0]['cpf'];
            $_SESSION['senha'] = $resultado[0]['senha'];
            $_SESSION['saldo'] = $resultado[0]['saldo'];
            $_SESSION['data_cadastro'] = $resultado[0]['data_cadastro'];
            $_SESSION['status'] = $resultado[0]['status'];
            $_SESSION['tema'] = $resultado[0]['tema'];
            $_SESSION['notificacoes'] = $resultado[0]['notificacoes'];
            $_SESSION['formapagamento'] = $resultado[0]['formapagamento'];

            if ($_SESSION['status'] == 'Inativo' || $_SESSION['status'] == 'Suspenso') {
                session_destroy();
                session_unset();
                $response = array('status' => 'error', 'message' => 'Não tens permissão!');
            } else
                $response = array('status' => 'success');
        } else {
            $comando = "SELECT usuarios.*, status_usuarios.status, preferencias_usuarios.tema, preferencias_usuarios.notificacoes, preferencias_usuarios.id_forma as formapagamento
                    FROM usuarios
                    INNER JOIN status_usuarios  ON usuarios.id = status_usuarios.id_usuario
                    INNER JOIN preferencias_usuarios ON usuarios.id = preferencias_usuarios.id_usuario
                   
                    WHERE cpf='$usuario' AND senha='$senha';";
            $resultado = $this->database->select($comando);

            if (count($resultado) == 1) {
                if (!isset($_SESSION))
                    session_start();

                $_SESSION['id'] = $resultado[0]['id'];
                $_SESSION['nome'] = $resultado[0]['nome'];
                $_SESSION['sobrenome'] = $resultado[0]['sobrenome'];
                $_SESSION['telefone'] = $resultado[0]['telefone'];
                $_SESSION['imagem'] = $resultado[0]['imagem'];
                $_SESSION['email'] = $resultado[0]['email'];
                $_SESSION['cpf'] = $resultado[0]['cpf'];
                $_SESSION['senha'] = $resultado[0]['senha'];
                $_SESSION['saldo'] = $resultado[0]['saldo'];
                $_SESSION['data_cadastro'] = $resultado[0]['data_cadastro'];
                $_SESSION['status'] = $resultado[0]['status'];
                $_SESSION['tema'] = $resultado[0]['tema'];
                $_SESSION['notificacoes'] = $resultado[0]['notificacoes'];
                $_SESSION['formapagamento'] = $resultado[0]['formapagamento'];

                if ($_SESSION['status'] == 'Inativo' || $_SESSION['status'] == 'Suspenso') {
                    session_destroy();
                    session_unset();
                    $response = array('status' => 'error', 'message' => 'Não tens permissão!');
                } else
                    $response = array('status' => 'success');
            } else {
                $response = array('status' => 'error', 'message' => 'Credenciais inválidas!');
            }
        }

        $this->database->closeConnection();
        return $response;
    }


    //Método para editar a foto
    //Retorna JSON
    public function setImage($image, $id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE usuarios set imagem = '$image' where id= $id_usuario";
        $resultado = $this->database->insert($comando);

        if ($resultado) {
            $_SESSION['imagem'] = $image;
            $response = array('status' => 'success', 'message' => 'Imagem atualizada com sucesso!');
        } else {
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar a imagem!');
        }
        $this->database->closeConnection();
        return $response;
    }

    //Método para editar o nome
    //Retorna JSON
    public function setName($name, $lastname, $id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE usuarios set nome = '$name', sobrenome = '$lastname' where id= $id_usuario";
        $resultado = $this->database->insert($comando);

        if ($resultado) {
            $_SESSION['nome'] = $name;
            $_SESSION['sobrenome'] = $lastname;
            $response = array('status' => 'success', 'message' => 'Nome atualizado com sucesso!');
        } else {
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar o nome!');
        }
        $this->database->closeConnection();
        return $response;
    }

    //Método para editar o cpf
    //Retorna JSON
    public function setCPF($cpf, $id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM usuarios where cpf = '$cpf';";
        $resultado = $this->database->select($comando);
        if (count($resultado) > 0) {
            $response = array('status' => 'error', 'message' => 'CPF já cadastrado!');
        } else {
            $comando = "UPDATE usuarios set cpf = '$cpf' where id= $id_usuario";
            $resultado = $this->database->insert($comando);

            if ($resultado) {
                $_SESSION['cpf'] = $cpf;
                $response = array('status' => 'success', 'message' => 'CPF atualizado com sucesso!');
            } else {
                $response = array('status' => 'error', 'message' => 'Erro ao atualizar o CPF!');
            }
        }
        $this->database->closeConnection();
        return $response;
    }


    //Método para editar o email
    //Retorna JSON
    public function setEmail($email, $id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM usuarios where email = '$email';";
        $resultado = $this->database->select($comando);
        if (count($resultado) > 0) {
            $response = array('status' => 'error', 'message' => 'Email já cadastrado!');
        } else {
            $comando = "UPDATE usuarios set email = '$email' where id= $id_usuario";
            $resultado = $this->database->insert($comando);

            if ($resultado) {
                $_SESSION['email'] = $email;
                $response = array('status' => 'success', 'message' => 'Email atualizado com sucesso!');
            } else {
                $response = array('status' => 'error', 'message' => 'Erro ao atualizar o Email!');
            }
        }
        $this->database->closeConnection();
        return $response;
    }

    //Método para editar o telefone
    //Retorna JSON
    public function setCellphone($telefone, $id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT * FROM usuarios where telefone = '$telefone';";
        $resultado = $this->database->select($comando);
        if (count($resultado) > 0) {
            $response = array('status' => 'error', 'message' => 'Telefone já cadastrado!');
        } else {
            $comando = "UPDATE usuarios set telefone = '$telefone' where id= $id_usuario";
            $resultado = $this->database->insert($comando);

            if ($resultado) {
                $_SESSION['telefone'] = $telefone;
                $response = array('status' => 'success', 'message' => 'Telefone atualizado com sucesso!');
            } else {
                $response = array('status' => 'error', 'message' => 'Erro ao atualizar o Telefone!');
            }
        }
        $this->database->closeConnection();
        return $response;
    }

    //Método para editar a senha
    //Retorna JSON
    public function setPassword($senha, $id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE usuarios set senha = '$senha' where id= $id_usuario";
        $resultado = $this->database->insert($comando);

        if ($resultado) {
            $_SESSION['senha'] = $senha;
            $response = array('status' => 'success', 'message' => 'Senha atualizada com sucesso!');
        } else {
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar a senha!');
        }
        $this->database->closeConnection();
        return $response;
    }

    //Método para editar as preferencias
    //Retorna JSON
    public function editPreferences($id_usuario, $formapagamento, $tema, $notificacao)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "UPDATE preferencias_usuarios set tema = '$tema', notificacoes = '$notificacao', id_forma = $formapagamento where id_usuario = $id_usuario";
        $resultado = $this->database->insert($comando);

        if ($resultado) {
            $_SESSION['tema'] = $tema;
            $_SESSION['notificacoes'] = $notificacao;
            $_SESSION['formapagamento'] = $formapagamento;
            $response = array('status' => 'success', 'message' => 'Preferencias atualizadas com sucesso!');
        } else {
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar as preferências!');
        }
        $this->database->closeConnection();
        return $response;
    }

    public function getCash($id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT saldo FROM usuarios WHERE id=$id_usuario";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado[0]['saldo'];
    }

    public function getimage($id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT imagem FROM usuarios WHERE id=$id_usuario";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado[0]['imagem'];
    }

    public function readAll()
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT u.*, su.status as status_usuario FROM usuarios u LEFT JOIN status_usuarios su ON u.id = su.id_usuario";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    public function getAllFromUser($id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT u.*, DATE_FORMAT(u.data_cadastro, '%d/%m/%Y às %H:%i:%s') AS data_formatada, su.status as status_usuario FROM usuarios u LEFT JOIN status_usuarios su ON u.id = su.id_usuario WHERE u.id = $id_usuario";
        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    public function readAllSearch($chave, $parametro)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        if ($chave == 'status')
            $comando = "SELECT u.*, su.status as status_usuario FROM usuarios u LEFT JOIN status_usuarios su ON u.id = su.id_usuario where su.$chave LIKE '%$parametro%'";
        else
            $comando = "SELECT u.*, su.status as status_usuario FROM usuarios u LEFT JOIN status_usuarios su ON u.id = su.id_usuario where u.$chave LIKE '%$parametro%'";

        $resultado = $this->database->select($comando);

        $this->database->closeConnection();
        return $resultado;
    }

    public function deleteImage($id_usuario)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "SELECT imagem FROM usuarios WHERE id=$id_usuario";
        $resultado = $this->database->select($comando);

        if (count($resultado) > 0) {
            if ($resultado[0]['imagem'] == 'default.jpg')
                $response = array('status' => 'error', 'message' => 'Esse usuário não possui foto!');
            else {
                $comando = "UPDATE usuarios SET imagem='default.jpg' WHERE id=$id_usuario;
                INSERT INTO notificacoes(id_usuario, data, titulo, texto) VALUES ($id_usuario, NOW(), 'Sua foto foi removida.', 'Sua imagem de perfil foi removida por algum de nossos administradores. Verifique-a e caso algum equívoco fale conosco!')";
                $resultado2 = $this->database->insert($comando);

                if ($resultado2)
                    $response = array('status' => 'success', 'message' => 'Imagem removida com sucesso!');
                else
                    $response = array('status' => 'error', 'message' => 'Erro ao remover a imagem!');

            }
        } else {
            $response = array('status' => 'error', 'message' => 'Esse usuário não existe!');
        }

        $this->database->closeConnection();
        return $response;
    }

    public function editUser($id_usuario, $nome, $sobrenome, $cpf, $telefone, $email, $senha, $status, $saldo, $foto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        if ($foto == 'default.jpg')
            $comando = "UPDATE usuarios SET nome='$nome', sobrenome = '$sobrenome', cpf='$cpf', telefone = '$telefone', email = '$email', senha = '$senha', saldo = $saldo WHERE id = $id_usuario;
        UPDATE status_usuarios SET status = '$status' WHERE id_usuario = $id_usuario;
        INSERT INTO notificacoes(id_usuario, data, titulo, texto) VALUES ($id_usuario, NOW(), 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!');";
        else
            $comando = "UPDATE usuarios SET nome='$nome', sobrenome = '$sobrenome', cpf='$cpf', telefone = '$telefone', email = '$email', senha = '$senha', saldo = $saldo, imagem='$foto' WHERE id = $id_usuario;
        UPDATE status_usuarios SET status = '$status' WHERE id_usuario = $id_usuario;
        INSERT INTO notificacoes(id_usuario, data, titulo, texto) VALUES ($id_usuario, NOW(), 'Seu perfil foi atualizado.', 'Alguns dados do seu perfil foram alterados. Verifique-os e caso algum equívoco fale conosco!');";

        $resultado = $this->database->insert($comando);

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Usuário atualizado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao atualizar usuário!');

        $this->database->closeConnection();
        return $response;
    }

    public function addFavorite($id_usuario, $id_produto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "INSERT INTO favoritos_usuarios(id_usuario,id_produto) VALUES($id_usuario, $id_produto);";
        $resultado = $this->database->insert($comando);

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Favoritado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao favoritar usuário!');


        $this->database->closeConnection();
        return $response;
    }

    public function deleteFavorite($id_usuario, $id_produto)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "DELETE FROM favoritos_usuarios WHERE id_usuario = $id_usuario and id_produto = $id_produto;";
        $resultado = $this->database->insert($comando);

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Desfavoritado com sucesso!');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao desfavoritar usuário!');


        $this->database->closeConnection();
        return $response;
    }

    public function sendMessage($id_usuario, $title, $message)
    {
        $this->database = new \app\models\Database;
        $this->database->getConnection();

        $comando = "INSERT INTO notificacoes(id_usuario,titulo,texto) VALUES($id_usuario,'$title','$message');";
        $resultado = $this->database->insert($comando);

        if ($resultado)
            $response = array('status' => 'success', 'message' => 'Mensagem enviada com sucesso');
        else
            $response = array('status' => 'error', 'message' => 'Erro ao enviar a mensagem');

        $this->database->closeConnection();
        return $response;
    }

}
