<?php
    class AuthDTO {
        private $token;
        private $creationDate;
        private $user;

        public function getToken() {
            return $this->token;
        }

        public function setToken($token) {
            $this->token = $token;
        }

        public function getCreationDate() {
            return $this->creationDate;
        }

        public function setCreationDate($creationDate) {
            $this->creationDate = $creationDate;
        }

        public function getUser() {
            return $this->user;
        }

        public function setUser($user) {
            $this->user = $user;
        }
    }