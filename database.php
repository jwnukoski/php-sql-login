<?php
    class Database {
       function __construct() {
           $this->$DB_HOST = $_ENV['DB_HOST'] ?: 'localhost';
           $this->$DB_NAME = $_ENV['DB_NAME'] ?: 'website';
           $this->$DB_USER = $_ENV['DB_USER'] ?: 'root';
           $this->$DB_PASS = $_ENV['DB_PASS'] ?: '';
           $this->$DB_CONN = NULL;
       }

       function getConn() {
           if ($this->$DB_CONN == NULL) {
                $this->$DB_CONN = new PDO("mysql:host=" . $this->$DB_HOST . ";" . $this->$DB_NAME, $this->$DB_USER, $this->$DB_PASS);
                $this->$DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           
           return $this->$DB_CONN;
       }

       function closeConn() {
           if ($this->$DB_CONN != NULL) {
                try {
                    $this->DB_CONN->close();
                    $this->DB_CONN = NULL;
                    return true;
                } catch(Exception $e) {
                    return false;
                }
           }
           return false;
       }

       // User functions
       function validateUser($name, $password) {

       }

       function createUser($name, $password) {

       }

       function doesUserExist($name) {
            try {
                $conn = $this->getConn();
                $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
                $stmt->bindParam(":name", $name);
                
                if ($stmt->execute()) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if ($name == $row['name']) {
                            $this->closeConn();
                            return true;
                        }
                    }
                }

                return false;
            } catch(Exception $e) {
                echo('Error checking if ' . $name . ' exists.');
                return true;
            }
       }
    }
?>