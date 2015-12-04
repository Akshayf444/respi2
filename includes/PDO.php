<?php

class DatabaseWrapper {

    private $connection;
    private static $instance;

    function __construct($DB_host, $DB_name, $DB_user, $DB_pass) {
        $this->connection = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insert($query, array $data) {
        $this->connection->prepare($query)->execute($data);
        return $this->connection->lastInsertId();
    }

    public function update($query, array $data) {
        $stmt = $this->executeQuery($query, $data);
        return $stmt->rowCount();
    }

    public function delete($query, array $data) {
        $stmt = $this->executeQuery($query, $data);
        return $stmt->rowCount();
    }

    public function findOne($query, array $data = null) {
        $stmt = $this->executeQuery($query, $data);
        return $stmt->fetchObject();
    }

    public function findMany($query, array $data = null) {
        $stmt = $this->executeQuery($query, $data);
        return($stmt->fetchAll(PDO::FETCH_OBJ));
    }

    public function executeQuery($query, $data = null) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($data);
        return $stmt;
    }

}
$database = new DatabaseWrapper('50.62.209.79','job_portal' ,'job_portal','job_portal@123$%^');