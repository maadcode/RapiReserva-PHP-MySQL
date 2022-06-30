<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET['getSales']) && $_GET['getSales'] == 'All') {
            require_once "../Models/DAO/salesDAO.php";
            $dao = new SalesDAO();
            $response = $dao->getListSales();
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }
    }
