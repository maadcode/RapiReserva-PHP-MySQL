<?php
    class SalesDTO {
        private $id;
        private $estate;
        private $urlAction;
        private $urlBanner;
        private $creationDate;
        private $creationUser;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getEstate() {
            return $this->estate;
        }

        public function setEstate($estate) {
            $this->estate = $estate;
        }

        public function getUrlAction() {
            return $this->urlAction;
        }

        public function setUrlAction($urlAction) {
            $this->urlAction = $urlAction;
        }

        public function getUrlBanner() {
            return $this->urlBanner;
        }

        public function setUrlBanner($urlBanner) {
            $this->urlBanner = $urlBanner;
        }

        public function getCreationDate() {
            return $this->creationDate;
        }

        public function setCreationDate($creationDate) {
            $this->creationDate = $creationDate;
        }

        public function getCreationUser() {
            return $this->creationUser;
        }

        public function setCreationUser($creationUser) {
            $this->creationUser = $creationUser;
        }
    }