<?php
    require_once '../Services/connectionDB.php';

    class StatusReservationDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function getStatusById($id) {
            $status = null;
            $sql = "SELECT Description FROM StatusReservations WHERE Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            $statement->execute();
            $response = $statement->get_result();
            while ($data = $response->fetch_assoc()) {
                $status = $data["Description"];
            }
            $statement->close();
            return $status;
        }
    }