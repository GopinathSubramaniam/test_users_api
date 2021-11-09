<?php
require_once("Util.php");

class AppService
{
    public function getIP()
    {
        $ip = null;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function create()
    {
        $string_obj = file_get_contents('php://input');
        $obj = json_decode($string_obj, true);
        
        $full_name = $obj["name"];
        $email = $obj["email"];
        $mobile = $obj["mobile"];
        $qualification = $obj["qualification"];
        $software_experience = $obj["software_exp"];
        $current_status = $obj["current_status"];
        $about_career = $obj["about_career"];

        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "INSERT INTO application (name, email, mobile, qualification, software_exp, current_status, about_career, status) 
                VALUES ('".$full_name."', '".$email."', '".$mobile."', '".$qualification."', '".$software_experience."', '".$current_status."', 
                '".$about_career."', 'PENDING')";
        
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            if (Util::commitTrans($conn) == 1) {
                $json = Util::setSuccess($last_id);
            }else{
                mysqli_rollback($conn);
                $json = Util::setError("Error Occurred.");
            }
        }
        mysqli_close($conn);
        return $json;
    }

    public function createContact()
    {
        $string_obj = file_get_contents('php://input');
        $obj = json_decode($string_obj, true);
        
        $name = $obj["name"];
        $email = $obj["email"];
        $subject = $obj["subject"];
        $message = $obj["message"];

        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "INSERT INTO inquiry (`name`, `email`, `subject`, `message` ) VALUES ('".$name."', '".$email."', '".$subject."', '".$message."')";
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            if (Util::commitTrans($conn) == 1) {
                $json = Util::setSuccess($last_id);
            }else{
                mysqli_rollback($conn);
                $json = Util::setError("Error Occurred.");
            }
        }
        mysqli_close($conn);
        return $json;
    }
}
