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

        public function validateToken($token, $userId) {
            $isValid = false;
            $sql = "SELECT CreationDate FROM Auth WHERE Token = ? AND User_Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("si", $token, $userId);
            $statement->execute();
            $result = $statement->get_result();
            while ($auth = $result->fetch_assoc()) {
                $currentDate = new DateTime('now', new DateTimeZone('America/Lima'));
                $fromBase = new DateTime($auth['CreationDate'], new DateTimeZone('America/Lima'));
                $diff = $currentDate->diff($fromBase);
                $hours = $diff->h;
                $hours = $hours + ($diff->days*24);
                $inRange = $hours < 24;
                if($inRange) {
                    $isValid = true;
                }  
            }
            $statement->close();
            return $isValid;
        }
    }