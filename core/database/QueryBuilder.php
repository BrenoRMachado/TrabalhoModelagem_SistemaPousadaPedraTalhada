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
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die('Erro ao inserir: ' . $e->getMessage());
        }
    }

    public function selectWhere($table, $column, $value)
{
    $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$column} = :val");
    $statement->execute(['val' => $value]);
    return $statement->fetchAll(\PDO::FETCH_CLASS);
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

public function existeConflitoReserva($idQuarto, $dataEntrada, $dataSaida)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM reserva
        WHERE idQuarto = :idQuarto
          AND STATUS IN ('RESERVADA', 'HOSPEDADA')
          AND dataEntradaPrevista < :dataSaida
          AND dataSaidaPrevista > :dataEntrada
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'idQuarto'    => $idQuarto,
        'dataEntrada' => $dataEntrada,
        'dataSaida'   => $dataSaida
    ]);

    return $stmt->fetch(\PDO::FETCH_OBJ)->total > 0;
}

public function quartosDisponiveisPorPeriodo($dataEntrada, $dataSaida)
{
    $sql = "
        SELECT *
        FROM quarto
        WHERE STATUS = 'DISPONIVEL'
          AND numero NOT IN (
              SELECT idQuarto
              FROM reserva
              WHERE STATUS IN ('RESERVADA', 'HOSPEDADA')
                AND dataEntradaPrevista < :dataSaida
                AND dataSaidaPrevista > :dataEntrada
          )
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'dataEntrada' => $dataEntrada,
        'dataSaida'   => $dataSaida
    ]);

    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

public function selectWhereNot($table, $column, $value)
{
    $sql = "SELECT * FROM {$table} WHERE {$column} != :value";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['value' => $value]);

    return $stmt->fetchAll(PDO::FETCH_CLASS);
}

public function count($table)
{
    $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM {$table} WHERE STATUS != 'CANCELADA'");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ)->total;
}

public function selectPaginated($table, $limit, $offset)
{
    $sql = "
        SELECT *
        FROM {$table}
        WHERE STATUS != 'CANCELADA'
        ORDER BY dataEntradaPrevista DESC
        LIMIT :limit OFFSET :offset
    ";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS);
}



}