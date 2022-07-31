<?php
    require_once '../vendor/autoload.php';
    // DAO
    require_once '../Models/DAO/paymentDAO.php';
    require_once '../Models/DAO/reservationDAO.php';
    require_once '../Models/DAO/serviceDAO.php';
    require_once '../Models/DAO/userDAO.php';
    // DTO
    require_once '../Models/DTO/paymentDTO.php';
    require_once '../Models/DTO/reservationDTO.php';
    require_once '../Models/DTO/serviceDTO.php';
    require_once '../Models/DTO/userDTO.php';
    use Spipu\Html2Pdf\Html2Pdf;

    class ServicePDF {

        public function __construct() {
        }

        public function createPDF($paymentId) {
            // Get Logo
            $logoBase64 = $this->getLogoInBase64();

            // Get data
            $paymentDAO = new PaymentDAO();
            $payment = $paymentDAO->getPaymentById($paymentId ?? 0);
            $reservationDAO = new ReservationDAO();
            $reservation = $reservationDAO->getReservationById($payment->getReservation() ?? 0);
            $serviceDAO = new ServiceDAO();
            $services = $serviceDAO->getServiceByReservationId($payment->getReservation() ?? 0);
            $userDAO = new UserDAO();
            $user = $userDAO->getUserById($reservation->getUser() ?? 0);
            ob_start();
            require_once '../Helpers/templateComprobantePDF.php';
            $html = ob_get_clean();
            $html2pdf = new Html2Pdf('p', 'A4', 'es', 'true', 'UTF-8');
            $html2pdf->writeHTML($html);
            $html2pdf->output('Comprobante-JQueens-'.$payment->getVoucherCode().'.pdf'); 
        }

        private function getLogoInBase64() {
            $path = '../Views/Assets/logo-jqueens.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }
    }
