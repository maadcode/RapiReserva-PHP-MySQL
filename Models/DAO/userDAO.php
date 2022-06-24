<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/userDTO.php';

    class UserDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function registerUser($user) {
            $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $username = $user->getUsername();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $statement->bind_param("sss", $username, $email, $password);
            $executed = $statement->execute() ? true : mysqli_errno($this->connection);
            $statement->close();
            return $executed;
        }

        public function validateLogin($username, $password) {
            $userLoged = array('Valid'=>false, 'Id'=>0);
            $sql = "SELECT Password, Id FROM Users WHERE Username = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("s", $username);
            $statement->execute();
            $result = $statement->get_result();
            while ($user = $result->fetch_assoc()) {
                if(password_verify($password, $user['Password'])) {
                    $userLoged['Valid'] = true;
                    $userLoged['Id'] = $user['Id'];
                }
            }
            $statement->close();
            return $userLoged;
        }
    }