<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function verificaLogin($login, $senha)
{
    // Busca direta na tabela 'usuario'
    $sql = "SELECT * FROM usuario WHERE login = :login";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':login', $login);
    $stmt->execute();

    $dadosUsuario = $stmt->fetch(\PDO::FETCH_OBJ);

    // Verifica se o usuário existe e se a senha bate
    // O banco de dados mostra a senha como texto puro ('123')
    if ($dadosUsuario && $dadosUsuario->senha == $senha) {
        return $dadosUsuario;
    }

    return false;
}

    public function selectAll($table)
    {
        $sql = "select * from {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}