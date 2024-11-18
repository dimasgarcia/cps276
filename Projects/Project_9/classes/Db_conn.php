<?php

class DatabaseConn {
    private $conn;

    public function dbOpen() {
        try {
            $dbHost = 'localhost';
            $dbName = 'digarcia';
            $dbUsr = 'digarcia';
            $dbPass = 'feA4axh4j4Ay';

            $this->conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsr, $dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Database Connection Error: ' . $e->getMessage();
            exit;
        }
        return $this->conn;
    }
}
