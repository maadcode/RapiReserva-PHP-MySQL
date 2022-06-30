<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET['getReservations']) && isset($_GET['userId'])) {
            require_once "../Models/DAO/reservationDAO.php";
            require_once "../Models/DAO/statusReservationDAO.php";
            $dao = new ReservationDAO();
            $daoStatus = new StatusReservationDAO();
            $response = $dao->getListReservationsByUserId($_GET['userId']);
            foreach ($response as $key => $item) {
                $statusResponse = $daoStatus->getStatusById($item->getStatus() ?? 0);
                if($statusResponse != null) {
                    $item->setStatus($statusResponse);
                }
            }
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }

        if(isset($_GET['getLastReservation']) && isset($_GET['userId'])) {
            require_once "../Models/DAO/reservationDAO.php";
            require_once "../Models/DAO/statusReservationDAO.php";
            $dao = new ReservationDAO();
            $daoStatus = new StatusReservationDAO();
            $response = $dao->getLastReservationByUser($_GET['userId']);
            $statusResponse = $daoStatus->getStatusById($response->getStatus() ?? 0);
            if($statusResponse != null) {
                $response->setStatus($statusResponse);
            }
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }
    }
