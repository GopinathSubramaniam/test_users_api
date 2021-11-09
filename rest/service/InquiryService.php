<?php
require_once("Util.php");

class InquiryService
{
    public function inquiries()
    {
        global $loggedin_user;
        $json = Util::setSuccess();
        $result = array();
        
        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "SELECT * FROM inquiry";
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
        $conn = Util::getConn();
       
        $id = $_GET["id"];
        $status = $_GET["status"];

        $obj = array("status"=>$status);
        $sql = Util::buildUpdateQuery("inquiry", $id, $obj);
        if (mysqli_query($conn, $sql)) {
            if (Util::commitTrans($conn) == 1) {
                $json = Util::setSuccess();
            }else{
                mysqli_rollback($conn);
                $json = Util::setError("Error Occurred.");
            }
        }
        $json = Util::setSuccess();
        mysqli_close($conn);
        return $json;
    }

}
