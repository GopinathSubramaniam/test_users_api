<?php

include_once('./Util.php');
include_once('service/LoanService.php');

Util::cors();
// Util::checkAuthorize();

// #START Manage incoming request
$method = $_SERVER['REQUEST_METHOD'];
$type = isset($_GET['type']) ? $_GET['type'] : "";

$json = array();
if ($method == 'GET') {
    $json = (new LoanService())->getAll();
} elseif ($method == 'POST') {
    $string_obj = file_get_contents('php://input');
    $obj = json_decode($string_obj, true);
    $obj["user_type"] = "USER";
    $json = (new LoanService())->create($obj);
} elseif ($method == 'PUT') {
    $string_obj = file_get_contents('php://input');
    $obj = json_decode($string_obj, true);
    $json = (new LoanService())->update($obj);
} elseif ($method == 'DELETE') {
    $json = (new LoanService())->delete();
}

header('Content-type: application/json');
echo json_encode($json);
// #END
