<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/authDTO.php';

    class AuthDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function registerAuth($auth) {
            $sql = "INSERT INTO Auth (Token, CreationDate, User_Id) VALUES (?, ?, ?)";
            $statement = $this->connection->prepare($sql);
            $token = $auth->getToken();
            $date = $auth->getCreationDate();
            $userId = $auth->getUser();
            $statement->bind_param("ssi", $token, $date, $userId);
            $executed = $statement->execute() ? true : mysqli_errno($this->connection);
            $statement->close();
            return $executed;
        }

        public function validateToken($username, $password) {
            $users = array();
            $sql = "SELECT Id FROM Users WHERE Username = ? AND Password = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("ss", $username, $password);
            $statement->execute();
            $result = $statement->get_result();
            while ($user = $result->fetch_assoc()) {
                array_push($users, $user);
            }
            $statement->close();
            return $users;
        }
    }