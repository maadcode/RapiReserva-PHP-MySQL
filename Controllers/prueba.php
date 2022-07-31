<?php
    require_once "../Models/DAO/reservationDAO.php";
    require_once "../Models/DTO/reservationDTO.php";
    require_once "../Models/DTO/serviceDTO.php";
    // $dao = new ReservationDAO();

    // $service1 = new ServiceDTO();
    // $service1->setId(1);
    // $service2 = new ServiceDTO();
    // $service2->setId(8);

    // $services = array();
    // array_push($services, $service1);
    // array_push($services, $service2);
        
    // $reservation = new ReservationDTO();
    // $currentDate = new DateTime('now', new DateTimeZone('America/Lima'));
    // $date = $currentDate->format('Y-m-d H:i:s');
    // $reservation->setStartDate($date);
    // $reservation->setUser(1);
    // $response = $dao->registerReservation($reservation, $services);
    // if($response > 0) {
    //     foreach ($services as $key => $service) {
    //         $dao->registerReservationServices($service, $response);
    //     }
    // }
    $reserveDate = $_POST['date'];
    $reserveHour = $_POST['hour'];
    $stringDate = $reserveDate.' '.$reserveHour;
    $date = strtotime($stringDate);
    echo date('d/M/Y h:i:s', $date);
    // $jsonstring = json_encode($response);
    // echo $jsonstring;