<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET['getPerfil']) && isset($_GET['userId'])) {
            require_once "../Models/DAO/userDAO.php";
            $dao = new UserDAO();
            $response = $dao->getUserById($_GET['userId']);
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['updatePerfil']) && isset($_POST['userId'])) {
            require_once "../Models/DAO/userDAO.php";
            require_once "../Models/DTO/userDTO.php";
            $dao = new UserDAO();
            $user = new UserDTO();
            $user->setId($_POST['userId']);
            $user->setFullname($_POST['fullnamePerfil']);
            $user->SetDni($_POST['dniPerfil']);
            $user->setPhone($_POST['phonePerfil']);
            $user->setCity($_POST['addressPerfil']);
            $user->setCity($_POST['cityPerfil']);
            $response = $dao->updateUser($user);
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }
    }
