<?php
require_once("Util.php");
require_once("UserService.php");
require_once("ApplicationService.php");

class ApplicationService
{

    public function users()
    {
        global $loggedin_user;
        $json = Util::setSuccess();
        $result = array();
        
        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "SELECT * FROM application";
        $data_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data_query)) {
            while ($r = mysqli_fetch_array($data_query, MYSQLI_ASSOC)) {
                extract($r);
                $result[] = $r;
            }
        }
        $json = Util::setSuccess($result);
        mysqli_free_result($data_query);
        mysqli_close($conn);
        return $json;
    }

    public function update()
    {
        global $loggedin_user;
        $json = Util::setSuccess();
       
        $id = $_GET["id"];
        $status = $_GET["status"];

        if($status == Util::APPLICATION_STATUS["USER"]){
            $obj = self::findById($id);
            $obj->user_type = "TRAINEE";
            $json_obj = json_decode(json_encode($obj), true);
            
            unset($json_obj["about_career"]);
            unset($json_obj["current_status"]);
            unset($json_obj["status"]);
            unset($json_obj["created_date"]);
            unset($json_obj["modified_date"]);
            $json = UserService::createUser($json_obj);
        }
        if($json["success"] == true){
            $conn = Util::getConn();
            $obj = array("status"=>$status);
            $sql = Util::buildUpdateQuery("application", $id, $obj);
            if (mysqli_query($conn, $sql)) {
                if (Util::commitTrans($conn) == 1) {
                    $json = Util::setSuccess();
                }else{
                    mysqli_rollback($conn);
                    $json = Util::setError("Error Occurred.");
                }
            }
            mysqli_close($conn);
        }
        return $json;
    }

    public function findById($id)
    {
        $conn = Util::getConn();
        $sql = "SELECT * FROM application WHERE id='$id'";
        $data_query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_object($data_query);
        mysqli_close($conn);
        return $user;
    }

}
