<?php
    class Database {
       function __construct() {
           $this->DB_HOST = $_ENV['DB_HOST'] ?: 'localhost';
           $this->DB_NAME = $_ENV['DB_NAME'] ?: 'website';
           $this->DB_USER = $_ENV['DB_USER'] ?: 'root';
           $this->DB_PASS = $_ENV['DB_PASS'] ?: '';
           $this->DB_CONN = NULL;
       }

       private function getConn() {
           if ($this->DB_CONN == NULL) {
                $this->DB_CONN = new PDO("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
                $this->DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           
           return $this->DB_CONN;
       }

       private function closeConn() {
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

       // TODO: Create users class
       public function validateUser($name, $rawPwd) {
           try {
               $conn = $this->getConn();
               $stmt = $conn->prepare("SELECT password FROM users WHERE name = :name");
               $stmt->bindParam(":name", $name);
               
                $dbHash = '';
                if ($stmt->execute()) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $dbHash = $row(['password']);
                    }
                }

                //$this->closeConn();

                echo($inputHash);
                echo('<br/>');
                echo($dbHash);
                echo('<br/>');
                if ($this->verifyHash($rawPwd, $dbHash)) {
                    return true;
                }
            } catch(Exception $e) {}

            return false;
        }

        public function createUser($name, $rawPwd) {   
            if ($this->doesUserExist($name)) {
                return false;
            }
            
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

        private function verifyHash($rawPwd, $hashedPwd) {
            return password_verify($rawPwd, $hashedPwd);
        }

        private function hash($rawPwd) {
            return password_hash($pwd, PASSWORD_DEFAULT);
        }

        private function doesUserExist($name) {
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