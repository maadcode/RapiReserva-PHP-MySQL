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

        if(isset($_GET['getServices']) && isset($_GET['reservationId'])) {
            require_once "../Models/DAO/serviceDAO.php";
            require_once "../Models/DAO/categoryDAO.php";
            $dao = new ServiceDAO();
            $daoCategory = new CategoryDAO();
            $response = $dao->getServiceByReservationId($_GET['reservationId']);
            foreach ($response as $key => $item) {
                $category = $daoCategory->getCategoryBydId($item->getCategory() ?? 0);
                if($category != null) {
                    $item->setCategory($category);
                }
            }
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }

        if(isset($_GET['getServices']) && isset($_GET['newReserve'])) {
            require_once "../Models/DAO/serviceDAO.php";
            $dao = new ServiceDAO();
            $response = $dao->getListServices();
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['registerReservation'])) {
            require_once "../Models/DTO/serviceDTO.php";
            require_once "../Models/DTO/reservationDTO.php";
            require_once "../Models/DTO/paymentDTO.php";
            require_once "../Models/DAO/reservationDAO.php";
            require_once "../Models/DAO/paymentDAO.php";

            $json = array();            
            try {
                $userId = $_POST['userId'] ?? 0;
                $token = $_POST['token'] ?? '';

                $services = array();
                $servicesJson = json_decode($_POST['services']);
                foreach ($servicesJson as $key => $serviceJson) {
                    $service = new ServiceDTO();
                    $service->setId($serviceJson->id);
                    array_push($services, $service);
                }

                $reserveDate = $_POST['date'];
                $reserveHour = $_POST['hour'];
                $stringDate = str_replace('/', '-', $reserveDate).' '.$reserveHour;
                $currentDate = new DateTime(strtotime($stringDate));
                $date = $currentDate->format('Y-m-d H:i:s');
                
                $reservation = new ReservationDTO();
                $reservation->setUser($userId);
                $reservation->setStartDate($date);
                $dao = new ReservationDAO();
                $reserveId = $dao->registerReservation($reservation);
                if($reserveId > 0) {
                    foreach ($services as $key => $service) {
                        $dao->registerReservationServices($service, $reserveId);
                    }
                }
                
                // $paymentJson = json_decode($_POST['payment']);
                // $payDao = new PaymentDAO();
                // $payment = new PaymentDTO();
                // $payment->setLastNumbers();
                // $payment->setNameCard();
                // $payment->setToken();
                // $payment->setTotalPrice();
                // $payment->setReservaPrice();
                // $payment->setVoucherCode();
                // $response = $payDao->registerPayment($payment);
                
                $json['success'] = true;
            } catch (Exception $e) {
                $json['success'] = false;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }