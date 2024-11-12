<?php
/* THIS CLASS EXTENDS THE DATABASE CONNECTION CLASS AND BUILDS ON IT WITH PDO COMMANDS */
/* THE DATABASE CONNECTION CLASS IS STORED OUTSIDE OF THE EXAMPLE FILES SO YOU CANNOT SEE THE CONNECTION INFORMATION. ALSO, IT IS MORE SECURE */
require_once "Db_conn.php";

class PdoMethods extends DatabaseConn {

    private $sth;
    private $conn;
    private $db;
    private $error;

    /* THIS METHOD IS FOR ALL SELECT STATEMENTS THAT NEED TO HAVE A BINDING TO PROTECT THE DATA. 
       THE SCRIPT TAKES THE SQL STATEMENTS AND THE BINDING ARRAY AS ITS PARAMETERS AND PERFORMS THE QUERY.  
       IT WILL RUN THE QUERY AND RETURN THE RESULT AS AN ASSOCIATIVE ARRAY OR AN ERROR STRING. */
    public function selectBinded($sql, $bindings){
        $this->error = false;

        // I CREATE A TRY-CATCH BLOCK TO CATCH ANY ERRORS THAT MIGHT ARISE AND RETURN AN ERROR MESSAGE.
        /* IMPORTANT!!! IF YOU WANT THE FATAL ERROR TO DISPLAY ON THE WEBPAGE AND NOT THE ERROR MESSAGE THEN 
           COMMENT OUT THE TRY-CATCH PART AND JUST RUN THE STATEMENTS WITHIN THE TRY */
        try {
            $this->db_connection();
            $this->sth = $this->conn->prepare($sql);
            $this->createBinding($bindings);
            $this->sth->execute();
        } catch (PDOException $e) {
            // CAPTURE ERROR INSTEAD OF ECHOING IT DIRECTLY
            $this->error = 'error: ' . $e->getMessage();
            return 'error';
        }

        // THIS CLOSES THE DATABASE CONNECTION
        $this->conn = null;
        
        // THIS RETURNS A RECORD SET OR AN ERROR
        return $this->error ? 'error' : $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /* THIS FUNCTION DOES THE SAME AS THE ABOVE BUT DOES NOT NEED ANY BINDING PARAMETERS AS NONE ARE PASSED */
    public function selectNotBinded($sql){
        $this->error = false;

        // I CREATE A TRY-CATCH BLOCK TO CATCH ANY ERRORS THAT MIGHT ARISE AND RETURN AN ERROR MESSAGE.
        /* IMPORTANT!!! IF YOU WANT THE FATAL ERROR TO DISPLAY ON THE WEBPAGE AND NOT THE ERROR MESSAGE THEN 
           COMMENT OUT THE TRY-CATCH PART AND JUST RUN THE STATEMENTS WITHIN THE TRY */
        try {
            $this->db_connection();
            $this->sth = $this->conn->prepare($sql);
            $this->sth->execute();
        } catch (PDOException $e) {
            // CAPTURE ERROR INSTEAD OF ECHOING IT DIRECTLY
            $this->error = 'error: ' . $e->getMessage();
            return 'error';
        }

        // THIS CLOSES THE DATABASE CONNECTION
        $this->conn = null;
        
        // THIS RETURNS THE RECORD SET AS AN ARRAY OR AN ERROR
        return $this->error ? 'error' : $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /* THIS FUNCTION HANDLES CREATE, UPDATE, AND DELETE OPERATIONS (NON-SELECT STATEMENTS) WITH BINDING PARAMETERS */
    public function otherBinded($sql, $bindings){
        $this->error = false;

        // I CREATE A TRY-CATCH BLOCK TO CATCH ANY ERRORS THAT MIGHT ARISE AND RETURN AN ERROR MESSAGE.
        /* IMPORTANT!!! IF YOU WANT THE FATAL ERROR TO DISPLAY ON THE WEBPAGE AND NOT THE ERROR MESSAGE THEN 
           COMMENT OUT THE TRY-CATCH PART AND JUST RUN THE STATEMENTS WITHIN THE TRY */
        try {
            $this->db_connection();
            $this->sth = $this->conn->prepare($sql);
            $this->createBinding($bindings);
            $this->sth->execute();
        } catch (PDOException $e) {
            // CAPTURE ERROR INSTEAD OF ECHOING IT DIRECTLY
            $this->error = 'error: ' . $e->getMessage();
            return 'error';
        }

        // THIS CLOSES THE DATABASE CONNECTION
        $this->conn = null;

        // NO ERROR MEANS EVERYTHING WORKED
        return $this->error ? 'error' : 'noerror';
    }

    /* THIS FUNCTION HANDLES CREATE, UPDATE, AND DELETE OPERATIONS (NON-SELECT STATEMENTS) WITHOUT BINDING PARAMETERS */
    public function otherNotBinded($sql){
        $this->error = false;

        // I CREATE A TRY-CATCH BLOCK TO CATCH ANY ERRORS THAT MIGHT ARISE AND RETURN AN ERROR MESSAGE.
        /* IMPORTANT!!! IF YOU WANT THE FATAL ERROR TO DISPLAY ON THE WEBPAGE AND NOT THE ERROR MESSAGE THEN 
           COMMENT OUT THE TRY-CATCH PART AND JUST RUN THE STATEMENTS WITHIN THE TRY */
        try {
            $this->db_connection();
            $this->sth = $this->conn->prepare($sql);
            $this->sth->execute();
        } catch (PDOException $e) {
            // CAPTURE ERROR INSTEAD OF ECHOING IT DIRECTLY
            $this->error = 'error: ' . $e->getMessage();
            return 'error';
        }

        // THIS CLOSES THE DATABASE CONNECTION
        $this->conn = null;

        // NO ERROR MEANS EVERYTHING WORKED
        return $this->error ? 'error' : 'noerror';
    }

    /* CREATES A CONNECTION TO THE DATABASE */
    private function db_connection(){
        $this->db = new DatabaseConn();
        $this->conn = $this->db->dbOpen();
    }

    /* CREATES THE BINDINGS FOR PARAMETERIZED QUERIES */
    private function createBinding($bindings){
        foreach($bindings as $value) {
            switch($value[2]) {
                case "str":
                    $this->sth->bindParam($value[0], $value[1], PDO::PARAM_STR);
                    break;
                case "int":
                    $this->sth->bindParam($value[0], $value[1], PDO::PARAM_INT);
                    break;
            }
        }
    }
}
