<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['btnSignin'])) {
            require_once "../Models/DAO/userDAO.php";
            $json = array();
            if(!isset($_POST['usernameSignin'])) {
                array_push($json, array('usernameSignin' => 'error'));
            }
            if(!isset($_POST['passwordSignin'])) {
                array_push($json, array('passwordSignin' => 'error'));
            }

            foreach ($json as $key => $object) {
                foreach ($object as $index => $value) {
                    if($value == 'error') {
                        $jsonstring = json_encode($json);
                        echo $jsonstring;
                    }
                }
            }
            
            $username = $_POST['usernameSignin'];
            $password = $_POST['passwordSignin'];
            
            $dao = new UserDAO();
            $response = $dao->validateLogin($username, $password);
            $jsonstring = json_encode($response);
            echo $jsonstring;
        }

        if(isset($_POST['btnSignup']) && $_POST['btnSignup']) {
            require_once "../Models/DAO/userDAO.php";
            require_once "../Models/DTO/userDTO.php";
            $json = array();
            if(!isset($_POST['usernameSignup']) || $_POST['usernameSignup'] == "") {
                array_push($json, array('usernameSignup' => 'error'));
            }
            if(!isset($_POST['emailSignup']) || $_POST['emailSignup'] == "") {
                array_push($json, array('emailSignup' => 'error'));
            }
            if(!isset($_POST['passwordSignup']) || $_POST['passwordSignup'] == "") {
                array_push($json, array('passwordSignup' => 'error'));
            }
            
            foreach ($json as $key => $object) {
                foreach ($object as $index => $value) {
                    if($value == 'error') {
                        $jsonstring = json_encode($json);
                        echo $jsonstring;
                    }
                }
            }

            $user = new UserDTO();
            $user->setUsername($_POST['usernameSignup']);
            $user->setEmail($_POST['emailSignup']);

            $passwordHash = password_hash($_POST['passwordSignup'], PASSWORD_BCRYPT);
            $user->setPassword($passwordHash);

            $dao = new UserDAO();
            $response = $dao->registerUser($user);
            $json['success'] = $response;
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }
