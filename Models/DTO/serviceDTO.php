<?php
    class ServiceDTO {
        private $id;
        private $description;
        private $price;
        private $duration;
        private $category;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;
        }

        public function getDuration() {
            return $this->duration;
        }

        public function setDuration($duration) {
            $this->duration = $duration;
        }

        public function getCategory() {
            return $this->category;
        }

        public function setCategory($category) {
            $this->category = $category;
        }
    }