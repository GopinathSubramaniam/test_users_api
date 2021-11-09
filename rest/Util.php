<?php

$loggedin_user = array();

abstract class Util
{
    const ERROR = "500";
    const BAD_REQ = "400";
    const OK = "200";
    const CONFIG = array( "CARD" => "CARD", "WEBSITE" => "WEBSITE" );
    const ERROR_MSGS = array( "COMMIT_TRANSACTION" => "Transaction commit failed" );
    const SUCCESS_MSGS = array( "" => "" );
    const USER_TYPE = array("EMPLOYEE" => "EMPLOYEE", "TRAINEE" => "TRAINEE");
    const APPLICATION_STATUS = array("PENDING" => "PENDING", "ACCEPTED" => "ACCEPTED", "COMPLETED" => "COMPLETED", "USER" => "USER");


    public static function checkAuthorize(){
        $auth_free_urls = ["/api/rest/app"];
        $url = strtok($_SERVER["REQUEST_URI"], '?');
        if (!in_array($url, $auth_free_urls)) {
            $loggedin_user = self::getAuthKey();
            
            if ($loggedin_user == null) {
                echo "Unauthorized Error";
                exit();
            }
        }
    }

    public static function getProperty($key)
    {
        $config = parse_ini_file('../db.ini');
        return $config[$key];
    }

    public static function cors()
    {
    
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}"); 
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
            header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
            header('Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type, Accept, User-Agent, Referer, Authkey');
        }
        
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
            }
            
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        
            exit(0);
        }
    }

    public static function getConn()
    {
        $config = parse_ini_file('../db.ini');
        $conn = mysqli_connect($config['dbhost'], $config['username'], $config['password']);
        mysqli_select_db($conn, $config['db']);
        mysqli_autocommit($conn, false);
        return $conn;
    }

    public static function getPaymentKey($key)
    {
        $config = parse_ini_file('../../payment/config.ini');
        return $config[$key];
    }

    public static function commitTransAndCloseConn($sql_conn)
    {
        $committed = true;
        if (!mysqli_commit($sql_conn)) {
            $committed = false;
            mysqli_rollback($sql_conn);
        }
        mysqli_close($sql_conn);
        return $committed;
    }

    public static function getAuthKey()
    {
        $id = '';
        $email = '';
        $headers = getallheaders();
        
        if (isset($headers['Authkey'])) {
            $encoded_auth_val = base64_decode($headers['Authkey']);
            $auth_vals = explode('~', $encoded_auth_val);
            if (!empty($auth_vals)) {
                $id = $auth_vals[0]; // User Id
                $username = $auth_vals[1]; // User Email
                return ( object ) array( 'id' => $id, 'username' => $username );
            }
        }
        return null;
    }

    public static function setSuccess($data = "", $status = self::OK)
    {
        return array( "status" => self::getErrorCode($status), "success" => true, "data" => $data );
    }

    public static function setError($msg = 'Server Error', $status = self::ERROR)
    {
        return array( "status" => self::getErrorCode($status), "success" => false, "msg" => $msg );
    }

    public static function setPaginationSuccess($draw, $recordsTotal, $recordsFiltered, $result = null, 
        $sec = null, $status = self::OK)
    {
        return array( "status" => self::getErrorCode($status), 
                        "draw" => $draw, 
                        "recordsTotal" => intval($recordsTotal), 
                        "recordsFiltered" =>  $recordsFiltered, 
                        "data" => $result,
                    "secondary" => $sec);
    }

    public static function getErrorCode($type)
    {
        $error_code = null;
        switch ($type) {
            case 'ERROR':
            $error_code = 500;
            break;
            case 'BAD':
            $error_code = 400;
            break;
            default:
            $error_code = 200;
            break;
        }
        return $error_code;
    }

    public static function buildInsertQuery($table, $obj)
    {
        unset($obj["id"]);
        $keys = array_keys($obj);
        $sql_columns = '';
        $sql_values = '';
        foreach ($keys as $key) {
            $val = $obj[$key];
            if (!is_array($val) && isset($val) && $val != "") {
                $sql_columns = $sql_columns . "`".rtrim($key)."`". ",";
                $sql_values = $sql_values . "'" .$val. "', ";
            }
        }
        $sql_columns = rtrim($sql_columns, ", ");
        $sql_values = rtrim($sql_values, ", ");

        return "INSERT INTO ".$table." (" . $sql_columns . ") VALUES (" . $sql_values . ")";
    }

    public static function buildInsertQ($sql_conn, $table, $obj)
    {
        unset($obj["id"]);
        $keys = array_keys($obj);
        $sql_columns = '';
        $sql_values = '';
        foreach ($keys as $key) {
            $val = $obj[$key];
            if (!is_array($val) && isset($val)) {
                $sql_columns = $sql_columns . "`".$key."`". ",";
                $sql_values = $sql_values . "'" . mysqli_real_escape_string($sql_conn, $val)  . "', ";
            }
        }
        $sql_columns = rtrim($sql_columns, ", ");
        $sql_values = rtrim($sql_values, ", ");

        return "INSERT INTO ".$table." (" . $sql_columns . ") VALUES (" . $sql_values . ")";
    }

    public static function buildUpdateQuery($table, $id, $obj)
    {
        unset($obj["id"]);
        $comma = " ";
        $sql = "UPDATE ".$table." SET";
        foreach ($obj as $key => $val) {
            $sql .= $comma . "`".$key . "` = '" . trim($val) . "'";
            $comma = ", ";
        }
        return $sql . " WHERE id = " . $id;
    }

    public static function buildUpdateQ($sql_conn, $table, $id, $obj)
    {
        unset($obj["id"]);
        $comma = " ";
        $sql = "UPDATE ".$table." SET";
        foreach ($obj as $key => $val) {
            $sql .= $comma . "`".$key . "` = '" . mysqli_real_escape_string($sql_conn, trim($val)) . "'";
            $comma = ", ";
        }
        return $sql . " WHERE id = " . $id;
    }

    public static function getConfig($sql_conn, $config_name)
    {
        $json = null;
        try {
            $sql = "SELECT * FROM configuration WHERE name='$config_name'";
            $data_query = mysqli_query($sql_conn, $sql);
            if ($data_query) {
                $json = mysqli_fetch_object($data_query);
            }
        } catch (Exception $e) {
            $json = Util::setError($e);
        }

        return $json;
    }

    public function getJSONObj(){
        $string_obj = file_get_contents('php://input');
        return json_decode($string_obj, true);
    }

    public function getSearchParams(){
        $obj = array();
        $columns = $_GET["columns"];
        $search = $_GET["search"];
        $orders = $_GET["order"];

        foreach ($orders as $order) {
            $tempObj = $columns[$order["column"]];
            $obj["order_column"] = $tempObj["data"];
            $obj["order_dir"] = $order["dir"];
        }
        $obj["search"] = trim($search["value"]);
        if(isset($_GET["startDate"])){
            $obj["start_date"] = $_GET["startDate"];
        }
        if(isset($_GET["endDate"])){
            $obj["end_date"] = $_GET["endDate"];
        }
        return $obj;        
    }
}
