<?php
    class UserDTO {
        public $id;
        public $username;
        public $email;
        public $password;
        public $fullname;
        public $dni;
        public $phone;
        public $address;
        public $urlAvatar;
        public $city;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function setUsername($username) {
            $this->username = $username;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getFullname() {
            return $this->fullname;
        }

        public function setFullname($fullname) {
            $this->fullname = $fullname;
        }

        public function getDni() {
            return $this->dni;
        }

        public function setDni($dni) {
            $this->dni = $dni;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->address = $address;
        }

        public function getUrlAvatar() {
            return $this->urlAvatar;
        }

        public function setUrlAvatar($urlAvatar) {
            $this->urlAvatar = $urlAvatar;
        }

        public function getCity() {
            return $this->city;
        }

        public function setCity($city) {
            $this->city = $city;
        }
    }