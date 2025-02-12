<?php

namespace app\models;

class Database
{
    private $host = 'localhost';
    private $dbName = 'cantinaonline';
    private $username = 'root';
    private $password = '';
    private $conn = null;


    //retorna a conexão
    public function getConnection()
    {
        // Verifica se a conexão já foi estabelecida
        if ($this->conn == null) {
            try {

                $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch (\PDOException $exception) {
                echo "Erro de conexão: " . $exception->getMessage();
            }
        }
        return $this->conn;
    }

    public function insert($comando)
    {
        try {
            $sql = $this->conn->prepare($comando);
            $sql->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Erro ao inserir: " . $e->getMessage();
        }
        
    }

    public function select($comando)
    {
        try{
            $sql = $this->conn->prepare($comando);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e){
            return false;
            }
    }


    // Método para fechar a conexão com o banco de dados
    public function closeConnection()
    {
        $this->conn = null;
    }
}