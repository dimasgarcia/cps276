<?php

ini_set('memory_limit', '256M'); // to increase memory limit to 256 MB if needed

require_once 'db_conn.php';

class PdoMethods {

    private $conn;
    private $sth;
    private $error;

    public function __construct() {
        $database = new DatabaseConn();
        $this->conn = $database->getConnection();
    }

    public function selectBinded($sql, $bindings) {
        $this->error = false;

        try {
            $this->sth = $this->conn->prepare($sql);
            $this->createBinding($bindings);
            $this->sth->execute();
            return $this->sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Query Error: ' . $e->getMessage();
            return 'error';
        }
    }

    public function selectNotBinded($sql) {
        $this->error = false;

        try {
            $this->sth = $this->conn->prepare($sql);
            $this->sth->execute();
            return $this->sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Query Error: ' . $e->getMessage();
            return 'error';
        }
    }

    public function otherBinded($sql, $bindings) {
        $this->error = false;

        try {
            $this->sth = $this->conn->prepare($sql);
            $this->createBinding($bindings);
            $this->sth->execute();
            return 'noerror';
        } catch (PDOException $e) {
            echo 'Query Error: ' . $e->getMessage();
            return 'error';
        }
    }

    public function otherNotBinded($sql) {
        $this->error = false;

        try {
            $this->sth = $this->conn->prepare($sql);
            $this->sth->execute();
            return 'noerror';
        } catch (PDOException $e) {
            echo 'Query Error: ' . $e->getMessage();
            return 'error';
        }
    }

    private function createBinding($bindings) {
        foreach ($bindings as $value) {
            if ($value[2] == 'int') {
                $this->sth->bindParam($value[0], $value[1], PDO::PARAM_INT);
            } else {
                $this->sth->bindParam($value[0], $value[1], PDO::PARAM_STR);
            }
        }
    }
}
