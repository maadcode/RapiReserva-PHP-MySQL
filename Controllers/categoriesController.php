<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET['getCategories']) && isset($_GET['newReserve'])) {
            require_once "../Models/DAO/categoryDAO.php";
            $dao = new CategoryDAO();
            $response = $dao->getListCategories();
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }
    }
