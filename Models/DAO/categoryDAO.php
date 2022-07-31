<?php
    require_once '../Services/connectionDB.php';
    require_once '../Models/DTO/categoryDTO.php';

    class CategoryDAO {
        private $connection = null;

        public function __construct() {
            $this->connection = (ConnectionDB::getInstanceConnection())->getConnection();
        }

        public function getListCategories() {
            $categories = array();
            $sql = "SELECT Id, Description FROM Categories";
            $response = mysqli_query($this->connection, $sql);
            $data = mysqli_fetch_all($response, MYSQLI_ASSOC);
            foreach ($data as $key => $item) {
                $category = new CategoryDTO();
                $category->setId($item['Id']);
                $category->setDescription($item['Description']);
                array_push($categories, $category);
            }
            return $categories;
        }

        public function getCategoryBydId($id) {
            $category = null;
            $sql = "SELECT Id, Description FROM Categories WHERE Id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->bind_param("i", $id);
            $statement->execute();
            $response = $statement->get_result();
            while ($data = $response->fetch_assoc()) {
                $category = $data["Description"];
            }
            $statement->close();
            return $category;
        }
    }