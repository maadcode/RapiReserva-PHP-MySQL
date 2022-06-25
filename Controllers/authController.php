<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['validate'])) {
            require_once "../Models/DAO/authDAO.php";
            require_once "../Models/DTO/authDTO.php";
           
            $json = array('isValid' => false, 'token' => '', 'userId' => 0);
            if(isset($_POST['token']) && isset($_POST['userId'])) {
                $token = $_POST['token'];
                $userId = $_POST['userId'];
                $json['token'] = $token;
                $dao = new AuthDAO();
                $response = $dao->validateToken($token, $userId);
                $json['isValid'] = $response;
                $json['userId'] = $response ? $userId : 0;
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }

        if(isset($_POST['saveAuth'])) {
            require_once "../Models/DAO/authDAO.php";
            require_once "../Models/DTO/authDTO.php";
            $json = array();
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
            
            $json = array('isValid'=>false, 'token'=>'');
            $currentDate = new DateTime('now', new DateTimeZone('America/Lima'));
            $date = $currentDate->format('Y-m-d H:i:s');
            $token = password_hash($_POST['userId'].$date, PASSWORD_BCRYPT);;
            $auth = new AuthDTO();
            $auth->setToken($token);
            $auth->setCreationDate($date);
            $auth->setUser($_POST['userId']);

            $dao = new AuthDAO();
            $response = $dao->registerAuth($auth);
            if($response) {
                $json['isValid'] = true;
                $json['token'] = $auth->getToken();
            }
            $json['userId'] = $auth->getUser();
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    }
