<?php

include_once('service/LoginService.php');

Util::cors();

// #START Manage incoming request
$method = $_SERVER['REQUEST_METHOD'];
$type = isset($_GET["type"]) ? $_GET["type"] : "";

$json = array();
if ($method == 'POST') {
    $json = LoginService::login();
}
header('Content-type: application/json');
echo json_encode($json);
// #END

?>

