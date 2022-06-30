<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/salesDTO.php';

    class SalesDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function getListSales() {
            $sales = array();
            $sql = "SELECT Id, UrlAction, UrlBanner FROM Sales WHERE Estate = 1";
            $response = mysqli_query($this->connection, $sql);
            $data = mysqli_fetch_all($response, MYSQLI_ASSOC);
            foreach ($data as $key => $item) {
                $sale = new SalesDTO();
                $sale->setId($item['Id']);
                $sale->setUrlAction($item['UrlAction']);
                $sale->setUrlBanner($item['UrlBanner']);
                array_push($sales, $sale);
            }
            return $sales;
        }
    }