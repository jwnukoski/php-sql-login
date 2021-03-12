<?php
    class Users {
        function __construct($db) {
            $this->db = $db;
        }

        function validateUser($name, $rawPwd) {
                $hashedInput = $this->db->hash($rawPwd);

                try {
                    $conn = $this->db->getConn();
                    $stmt = $conn->prepare("SELECT id FROM users WHERE name = :name AND password = :password");
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":password", $hashedInput);

                    if ($stmt->execute()) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            return true;
                        }
                    }
                } catch(Exception $e) {}

                return false;
        }

        function createUser($name, $rawPwd) {   
                $hashedPwd = $this->db->hash($rawPwd);
                
                try {
                    $conn = $this->db->getConn();
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
            return password_hash($pwd, PASSWORD_BCRYPT);
        }

        function doesUserExist($name) {
            try {
                $conn = $this->db->getConn();
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