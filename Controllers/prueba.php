<?php
require_once "../Models/DAO/authDAO.php";
require_once "../Models/DTO/authDTO.php";

$json = array('Valid'=>false, 'Token'=>'');

$id = 5;
$date = date('d-m-y h:i:s');
$token = password_hash($id.$date, PASSWORD_BCRYPT);;
$auth = new AuthDTO();
$auth->setToken($token);
$auth->setCreationDate($date);
$auth->setUser($id);

$dao = new AuthDAO();
$response = $dao->registerAuth($auth);
if($response) {
    $json['Valid'] = true;
    $json['Token'] = $auth->getToken();
}
$jsonstring = json_encode($json);
echo $jsonstring;