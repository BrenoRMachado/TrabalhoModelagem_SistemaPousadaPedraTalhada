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

    // AQUI ENTRA A NOVA FUNÇÃO INSERT QUE FALTAVA
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

    public function update($table, $parameters, $id)
    {
        
        $setPart = implode(', ', array_map(function ($param) {
            return "{$param} = :{$param}";
        }, array_keys($parameters)));

       
        $sql = "UPDATE {$table} SET {$setPart} WHERE id = :id";

       
        $parameters['id'] = $id;

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            die('Erro ao atualizar registro: ' . $e->getMessage());
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