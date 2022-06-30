<?php
    require_once "../Models/DAO/userDAO.php";
    require_once "../Models/DTO/userDTO.php";
    $dao = new UserDAO();
    $user = new UserDTO();
    $user->setId(3);
    $user->setFullname('Manu');
    $response = $dao->updateUser($user);
    $jsonstring = json_encode($response);
    echo $jsonstring;