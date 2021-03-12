<?php
    require_once(__DIR__ . 'users.php');

    class Database {
       function __construct() {
           $this->DB_HOST = $_ENV['DB_HOST'] ?: 'localhost';
           $this->DB_NAME = $_ENV['DB_NAME'] ?: 'website';
           $this->DB_USER = $_ENV['DB_USER'] ?: 'root';
           $this->DB_PASS = $_ENV['DB_PASS'] ?: '';
           $this->DB_CONN = NULL;
           $this->USERS = new Users($this);
       }

       function getConn() {
           if ($this->DB_CONN == NULL) {
                $this->DB_CONN = new PDO("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
                $this->DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           
           return $this->DB_CONN;
       }

       function closeConn() {
           // PDO doesn't require .close()
           if ($this->DB_CONN != NULL) {
               try {
                    $this->DB_CONN = NULL;
                    return true;
                } catch(Exception $e) {
                    return false;
                }
           }

           return false;
       }
    }
?>