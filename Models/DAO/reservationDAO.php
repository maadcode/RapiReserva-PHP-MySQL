<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/reservationDTO.php';

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
    }