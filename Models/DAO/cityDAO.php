<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/cityDTO.php';

    class CityDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function getListCities() {
            $cities = array();
            $sql = "SELECT Id, Name FROM Cities ORDER BY Name";
            $response = mysqli_query($this->connection, $sql);
            $data = mysqli_fetch_all($response, MYSQLI_ASSOC);
            foreach ($data as $key => $item) {
                $city = new CityDTO();
                $city->setId($item['Id']);
                $city->setName($item['Name']);
                array_push($cities, $city);
            }
            return $cities;
        }

        public function getCityById($id) {
            $city = new CityDTO();
            $sql = "SELECT Id, Name FROM Cities WHERE Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            $statement->execute();
            $response = $statement->get_result();
            while ($data = $response->fetch_assoc()) {
                $city->setId($data["Id"]);
                $city->setName($data["Name"]);
            }
            $statement->close();
            return $city;
        }
    }