<?php
require_once 'Db_conn.php';

class PdoMethods {
    private $sth;
    private $conn;

    public function __construct() {
        $db = new DatabaseConn();
        $this->conn = $db->dbOpen();
    }

    public function selectBinded($sql, $bindings) {
        try {
            $this->sth = $this->conn->prepare($sql);
            $this->createBinding($bindings);
            $this->sth->execute();
            return $this->sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 'error: ' . $e->getMessage();
        }
    }

    public function otherBinded($sql, $bindings) {
        try {
            $this->sth = $this->conn->prepare($sql);
            $this->createBinding($bindings);
            $this->sth->execute();
            return 'noerror';
        } catch (PDOException $e) {
            return 'error: ' . $e->getMessage();
        }
    }

    private function createBinding($bindings) {
        foreach ($bindings as $binding) {
            $this->sth->bindValue($binding[0], $binding[1], $binding[2] === 'int' ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
    }
}
