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
            $sql = "SELECT Password, Id, Username, UrlAvatar FROM Users WHERE Username = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("s", $username);
            $statement->execute();
            $result = $statement->get_result();
            while ($user = $result->fetch_assoc()) {
                if(password_verify($password, $user['Password'])) {
                    $userLoged['Valid'] = true;
                    $userLoged['Id'] = $user['Id'];
                    $userLoged['Username'] = $user['Username'];
                    $userLoged['UrlAvatar'] = $user['UrlAvatar'];
                }
            }
            $statement->close();
            return $userLoged;
        }

        public function getUserById($id) {
            $user = new UserDTO();
            $sql = "SELECT Id, Username, Email, Fullname, DNI, Phone, Address, UrlAvatar, Cities_Id FROM Users WHERE Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            $statement->execute();
            $response = $statement->get_result();
            while ($data = $response->fetch_assoc()) {
                $user->setId($data["Id"]);
                $user->setUsername($data["Username"]);
                $user->setEmail($data["Email"]);
                $user->setFullname($data["Fullname"]);
                $user->setDni($data["DNI"]);
                $user->setPhone($data["Phone"]);
                $user->setAddress($data["Address"]);
                $user->setUrlAvatar($data["UrlAvatar"]);
                $user->setCity($data["Cities_Id"]);
            }
            $statement->close();
            return $user;
        }

        public function updateUser($user) {
            $sql = "UPDATE Users SET Fullname = ?, 
                        DNI = ?, 
                        Phone = ?, 
                        Address = ?, 
                        UrlAvatar = ?, 
                        Cities_Id = ? 
                    WHERE Id = ?";
            $statement = $this->connection->prepare($sql);
            $fullname = $user->getFullname();
            $dni = $user->getDni();
            $phone = $user->getPhone();
            $address = $user->getAddress();
            $urlAvatar = $user->getUrlAvatar();
            $city = $user->getCity();
            $id = $user->getId() ?? 0;
            $statement->bind_param("sssssii", $fullname, $dni, $phone, $address, $urlAvatar, $city, $id);
            $executed = $statement->execute() ? true : mysqli_errno($this->connection);
            $statement->close();
            return $executed;
        }
    }