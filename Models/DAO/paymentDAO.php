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

        public function getPaymentById($id) {
            $payment = new PaymentDTO();
            $sql = "SELECT Id, LastNumbers, NameCard, Token, TotalPrice, ReservaPrice, PaymentDate, VoucherCode, Reservations_Id, TypeCard_Id 
            FROM Payment
            WHERE Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            $statement->execute();
            $response = $statement->get_result();
            while ($data = $response->fetch_assoc()) {
                $payment->setId($data["Id"]);
                $payment->setLastNumbers($data["LastNumbers"]);
                $payment->setNameCard($data["NameCard"]);
                $payment->setToken($data["Token"]);
                $payment->setTotalPrice($data["TotalPrice"]);
                $payment->setReservaPrice($data["ReservaPrice"]);
                $payment->setPaymentDate($data["PaymentDate"]);
                $payment->setVoucherCode($data["VoucherCode"]);
                $payment->setReservation($data["Reservations_Id"]);
                $payment->setTypeCard($data["TypeCard_Id"]);
            }
            $statement->close();
            return $payment;
        }

        public function registerPayment($payment) {
            $sql = "INSERT INTO Payments (LastNumbers, NameCard, Token, TotalPrice, ReservaPrice, PaymentDate, VoucherCode, Reservations_Id, TypeCard_Id) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?)";
            try {
                $statement = $this->connection->prepare($sql);
                $lastNumbers = $payment->getLastNumbers();
                $nameCard = $payment->getNameCard();
                $token = $payment->getToken();
                $totalPrice = $payment->getTotalPrice();
                $reservaPrice = $payment->getReservaPrice();
                $ovucherCode = $payment->getVoucherCode();
                $typeCard = $payment->getTypeCard();
                $statement->bind_param("sssddsii", $lastNumbers, $nameCard, $token, $totalPrice, $reservaPrice, $voucherCode, $typeCard);
                $isSuccess = $statement->execute() ? true : mysqli_errno($this->connection);
            } catch (Exception $e) {
                return 0;
            } finally {
                $statement->close();
            }
            return $isSuccess;
        }
    }