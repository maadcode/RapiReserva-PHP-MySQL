<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET['getPayments']) && isset($_GET['userId'])) {
            require_once "../Models/DAO/paymentDAO.php";
            $dao = new PaymentDAO();
            $response = $dao->getListPaymentsByUserId($_GET['userId']);
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }

        if(isset($_GET['getPaymentPdf']) && isset($_GET['paymentId'])) {
            require_once "../Services/servicePDF.php";
            $servicePdf = new ServicePDF();
            $response = $servicePdf->createPDF($_GET['paymentId']);
        }
    }
