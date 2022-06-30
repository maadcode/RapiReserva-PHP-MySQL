<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/paymentDTO.php';

    class PaymentDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function getListPaymentsByUserId($user) {
            $payments = array();
            $sql = "SELECT pa.Id, pa.LastNumbers, pa.NameCard, pa.Token, pa.TotalPrice, pa.ReservaPrice, pa.PaymentDate, pa.VoucherCode, pa.Reservations_Id, pa.TypeCard_Id 
                    FROM Payment pa
                    INNER JOIN Reservations re
                    ON pa.Reservations_Id = re.Id
                    WHERE re.Users_Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $user);
            $statement->execute();
            $response = $statement->get_result();
            while ($item = $response->fetch_assoc()) {
                $payment = new PaymentDTO();
                $payment->setId($item['Id']);
                $payment->setLastNumbers($item['LastNumbers']);
                $payment->setNameCard($item['NameCard']);
                $payment->setToken($item['Token']);
                $payment->setTotalPrice($item['TotalPrice']);
                $payment->setReservaPrice($item['ReservaPrice']);
                $payment->setPaymentDate($item['PaymentDate']);
                $payment->setVoucherCode($item['VoucherCode']);
                $payment->setReservation($item['Reservations_Id']);
                $payment->setTypeCard($item['TypeCard_Id']);
                array_push($payments, $payment);
            }
            $statement->close();
            return $payments;
        }
    }