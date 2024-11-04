<?php

class DatabaseConn {

    private $conn;

    public function __construct() {
        $this->dbOpen();
    }

    public function dbOpen() {
        try {
            $dbHost = 'localhost';
            $dbName = 'digarcia';
            $dbUsr = 'digarcia';
            $dbPass = 'feA4axh4j4Ay';

            // to establish a new PDO connection
            $this->conn = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUsr, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Database Connection Error: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
