<?php
    class ReservationDTO {
        private $id;
        private $startDate;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getStartDate() {
            return $this->startDate;
        }

        public function setStartDate($startDate) {
            $this->startDate = $startDate;
        }
    }