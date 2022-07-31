<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/serviceDTO.php';

    class ServiceDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function getServiceByReservationId($reservation) {
            $services = array();
            $sql = "SELECT se.Id, se.Description, se.Price, se.Duration, se.Categories_Id, se.UrlImage 
                    FROM Services se
                    INNER JOIN ReservationsServices res
                    ON se.Id = res.Services_Id
                    WHERE res.Reservations_Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $reservation);
            $statement->execute();
            $response = $statement->get_result();
            while ($item = $response->fetch_assoc()) {
                $service = new ServiceDTO();
                $service->setId($item['Id']);
                $service->setDescription($item['Description']);
                $service->setPrice($item['Price']);
                $service->setDuration($item['Duration']);
                $service->setCategory($item['Categories_Id']);
                $service->setUrlImage($item['UrlImage']);
                array_push($services, $service);
            }
            $statement->close();
            return $services;
        }

        public function getListServices() {
            $services = array();
            $sql = "SELECT Id, Description, Price, Duration, Categories_Id, UrlImage FROM Services";
            $response = mysqli_query($this->connection, $sql);
            $data = mysqli_fetch_all($response, MYSQLI_ASSOC);
            foreach ($data as $key => $item) {
                $service = new ServiceDTO();
                $service->setId($item['Id']);
                $service->setDescription($item['Description']);
                $service->setPrice($item['Price']);
                $service->setDuration($item['Duration']);
                $service->setCategory($item['Categories_Id']);
                $service->setUrlImage($item['UrlImage']);
                array_push($services, $service);
            }
            return $services;
        }
    }