<?php
    class Database {
       function __construct() {
           $this->DB_HOST = $_ENV['DB_HOST'] ?: 'localhost';
           $this->DB_NAME = $_ENV['DB_NAME'] ?: 'website';
           $this->DB_USER = $_ENV['DB_USER'] ?: 'root';
           $this->DB_PASS = $_ENV['DB_PASS'] ?: '';
           $this->DB_CONN = NULL;
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

       // User functions. These should be moved to another class or stored procedure later
       function validateUser($name, $password) {
            
       }

       function createUser($name, $rawPwd) {   
            $hashedPwd = $this->hash($rawPwd);
            
            try {
                $conn = $this->getConn();
                $stmt = $conn->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":password", $hashedPwd);

                if ($stmt->execute()) {
                    return true;
                }

                return true;
            } catch(Exception $e) {}

            return false;
       }

       function hash($rawPwd) {
           // See: https://www.php.net/manual/en/function.password-hash.php
           return password_hash($pwd, PASSWORD_BCRYPT);
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
                return true;
            }
       }
    }
?>