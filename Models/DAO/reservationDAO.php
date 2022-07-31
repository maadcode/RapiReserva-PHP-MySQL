<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/reservationDTO.php';
    require_once '../Models/DTO/serviceDTO.php';

    class ReservationDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function getListReservationsByUserId($user) {
            $reservations = array();
            $sql = "SELECT Id, StartDate, StatusReservations_Id FROM Reservations WHERE Users_Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $user);
            $statement->execute();
            $response = $statement->get_result();
            while ($item = $response->fetch_assoc()) {
                $reservation = new ReservationDTO();
                $reservation->setId($item['Id']);
                $reservation->setStartDate($item['StartDate']);
                $reservation->setStatus($item['StatusReservations_Id']);
                $reservation->setUser($user);
                array_push($reservations, $reservation);
            }
            $statement->close();
            return $reservations;
        }

        public function getLastReservationByUser($user) {
            $reservation = new ReservationDTO();
            $sql = "SELECT Id, StartDate, StatusReservations_Id FROM Reservations WHERE Users_Id = ? ORDER BY Id ASC";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $user);
            $statement->execute();
            $response = $statement->get_result();
            while ($item = $response->fetch_assoc()) {
                $reservation->setId($item['Id']);
                $reservation->setStartDate($item['StartDate']);
                $reservation->setStatus($item['StatusReservations_Id']);
                $reservation->setUser($user);
            }
            $statement->close();
            return $reservation;
        }

        public function getReservationById($id) {
            $reservation = new ReservationDTO();
            $sql = "SELECT Id, StartDate, Users_Id, StatusReservations_Id FROM Reservations WHERE Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            $statement->execute();
            $response = $statement->get_result();
            while ($data = $response->fetch_assoc()) {
                $reservation->setId($data["Id"]);
                $reservation->setStartDate($data["StartDate"]);
                $reservation->setUser($data["Users_Id"]);
                $reservation->setStatus($data["StatusReservations_Id"]);
            }
            $statement->close();
            return $reservation;
        }

        public function registerReservation($reservation) {
            $sql = "INSERT INTO Reservations (StartDate, Users_Id, StatusReservations_Id) VALUES (NOW(), ?, 1)";
            try {
                $statement = $this->connection->prepare($sql);
                $date = $reservation->getStartDate();
                $userId = $reservation->getUser();
                $statement->bind_param("i", $userId);
                $idInserted = $statement->execute() ? mysqli_insert_id($this->connection) : mysqli_errno($this->connection);
            } catch (Exception $e) {
                return 0;
            } finally {
                $statement->close();
            }
            return $idInserted;
        }

        public function registerReservationServices($service, $id) {
            $sql = "INSERT INTO ReservationsServices (Services_Id, Reservations_Id) VALUES (?, ?)";
            $statement = $this->connection->prepare($sql);
            $serviceId = $service->getId();
            $statement->bind_param("ii", $serviceId, $id);
            $executed = $statement->execute() ? true : mysqli_errno($this->connection);
            $statement->close();
        }
    }