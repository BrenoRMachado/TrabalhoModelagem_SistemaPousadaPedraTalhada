<?php

namespace App\Core\Database;

use PDO;
use Exception;

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function verificaLogin($login, $senha)
    {

    $sql = "SELECT * FROM usuario WHERE login = :login";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':login', $login);
    $stmt->execute();

    $dadosUsuario = $stmt->fetch(\PDO::FETCH_OBJ);

    if ($dadosUsuario && $dadosUsuario->senha == $senha) {
        return $dadosUsuario;
    }

    return false;
}


    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            die('Erro ao inserir: ' . $e->getMessage());
        }
    }

    public function update($table, $parameters, $identifierColumn, $identifierValue)
    {
    $setClause = implode(', ', array_map(function ($column) {
        return "{$column} = :{$column}";
    }, array_keys($parameters)));

    $sql = sprintf(
        'update %s set %s where %s = :id_val',
        $table,
        $setClause,
        $identifierColumn
    );

    try {
        $statement = $this->pdo->prepare($sql);
        $parameters['id_val'] = $identifierValue;
        $statement->execute($parameters);
    } catch (Exception $e) {
        die($e->getMessage());
    }
    }

    public function delete($table, $id)
{
    $sql = "DELETE FROM {$table} WHERE id = :id";

    try {
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
    } catch (Exception $e) {
        die('Erro ao excluir: ' . $e->getMessage());
    }
}
}