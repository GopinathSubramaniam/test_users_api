<?php
require_once("Util.php");

class LoginService
{
    public function login()
    {
        $json = Util::setSuccess();

        $string_obj = file_get_contents('php://input');
        $obj = json_decode($string_obj, true);
        
        $username = $obj["username"];
        $password = $obj["password"];

        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "SELECT * FROM login WHERE username='".$username."' OR email='".$username."'";
        $data_query = mysqli_query($conn, $sql);
        $login = mysqli_fetch_object($data_query);
        if (isset($login) && isset($login->id)) {
            if($login->password == $password){
                $login->password = null;
                $json = Util::setSuccess($login);
            }else{
                $json = Util::setError("Incorrect Password");
            }
        }else{
            $json = Util::setError("User Not Found");
        }
        mysqli_close($conn);
        return $json;
    }

}
