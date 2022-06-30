<?php
    class PaymentDTO {
        public $id;
        public $typeCard;
        public $lastNumbers;
        public $nameCard;
        public $token;
        public $totalPrice;
        public $reservaPrice;
        public $paymentDate;
        public $voucherCode;
        public $reservation;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getTypeCard() {
            return $this->typeCard;
        }

        public function setTypeCard($typeCard) {
            $this->typeCard = $typeCard;
        }

        public function getLastNumbers() {
            return $this->lastNumbers;
        }

        public function setLastNumbers($lastNumbers) {
            $this->lastNumbers = $lastNumbers;
        }

        public function getNameCard() {
            return $this->nameCard;
        }

        public function setNameCard($nameCard) {
            $this->nameCard = $nameCard;
        }

        public function getToken() {
            return $this->token;
        }

        public function setToken($token) {
            $this->token = $token;
        }

        public function getTotalPrice() {
            return $this->totalPrice;
        }

        public function setTotalPrice($totalPrice) {
            $this->totalPrice = $totalPrice;
        }

        public function getReservaPrice() {
            return $this->reservaPrice;
        }

        public function setReservaPrice($reservaPrice) {
            $this->reservaPrice = $reservaPrice;
        }

        public function getPaymentDate() {
            return $this->paymentDate;
        }

        public function setPaymentDate($paymentDate) {
            $this->paymentDate = $paymentDate;
        }

        public function getVoucherCode() {
            return $this->voucherCode;
        }

        public function setVoucherCode($voucherCode) {
            $this->voucherCode = $voucherCode;
        }

        public function getReservation() {
            return $this->reservation;
        }

        public function setReservation($reservation) {
            $this->reservation = $reservation;
        }
    }