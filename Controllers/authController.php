<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['validate']) && $_POST['validate']) {
            $json = array('isValid' => false);
            if(isset($_POST['token'])) {
                $json['token'] = $_POST['token'];
                
                // $json['isValid'] = true;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }

        if(isset($_POST['saveAuth'])) {
            require_once "../Models/DAO/authDAO.php";
            require_once "../Models/DTO/authDTO.php";
            $json = array('Valid'=>false, 'Token'=>'');
            if(!isset($_POST['userId']) || $_POST['userId'] == 0) {
                array_push($json, array('userId' => 'error'));
            }

            foreach ($json as $key => $object) {
                foreach ($object as $index => $value) {
                    if($value == 'error') {
                        $jsonstring = json_encode($json);
                        echo $jsonstring;
                    }
                }
            }
            
            $date = date('d-m-y h:i:s');
            $token = password_hash($_POST['userId'].$date, PASSWORD_BCRYPT);;
            $auth = new AuthDTO();
            $auth->setToken($token);
            $auth->setCreationDate($date);
            $auth->setUser($_POST['userId']);

            $dao = new AuthDAO();
            $response = $dao->registerAuth($auth);
            if($response) {
                $json['Valid'] = true;
                $json['Token'] = $auth->getToken();
            }
            $jsonstring = json_encode($json);
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
    // $res = password_verify($password, '$2y$10$j72.kpEvDgOcbov9VlYUPuTWqz.D/Gvxg/tX833f5DBOgD8vmveUs');