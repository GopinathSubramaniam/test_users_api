<?php

include_once('service/AppService.php');

Util::cors();

// #START Manage incoming request
$method = $_SERVER['REQUEST_METHOD'];
$type = isset($_GET["type"]) ? $_GET["type"] : "";

$json = array();
if ($method == 'POST') {
    if($type == "contact"){
        $json = AppService::createContact();
    }else{
        $json = AppService::create();
    }
}
header('Content-type: application/json');
echo json_encode($json);
// #END

// Handles all the GET method functions
function createIPDetail()
{
    $json = array();
    $ip = null;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if (isset($ip)) {
        $json = saveIPDetail(1, $ip);
    }

    return $json;
}

function getIPInfo($ip)
{
    $ipdat = @json_decode(file_get_contents("http://ip-api.com/json/" . $ip));
    return $ipdat;
}

?>

