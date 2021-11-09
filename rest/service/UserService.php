<?php
require_once("Util.php");

class UserService
{

    /**
     * User Type - ADMIN, USER
     * 
     */
    public function create()
    {
        $string_obj = file_get_contents('php://input');
        $obj = json_decode($string_obj, true);

        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "";
        if (isset($obj["id"])) {
            $sql = Util::buildUpdateQuery("user", $obj["id"], $obj);
        } else {
            $sql = Util::buildInsertQuery("user", $obj);
        }

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            if (Util::commitTransAndCloseConn($conn) == 1) {
                $json = Util::setSuccess($last_id);
            } else {
                mysqli_rollback($conn);
                $json = Util::setError("Error Occurred.");
            }
        }
        return $json;
    }

    /**
     * User Type - ADMIN, USER
     * 
     */
    public function createUser($obj)
    {
        $json = Util::setSuccess();
        $arr = $this->findByEmail($obj["email"]);
        if (count($arr)) {
            $json = Util::setError("Email already exists");
        } else {
            $arr = $this->findByMobile($obj["mobile"]);
            if (count($arr)) {
                $json = Util::setError("Mobile already exists");
            } else {
                $conn = Util::getConn();
                $sql = Util::buildInsertQuery("user", $obj);
                if (mysqli_query($conn, $sql)) {
                    $last_id = mysqli_insert_id($conn);
                    if (Util::commitTransAndCloseConn($conn) == 1) {
                        $json = Util::setSuccess($last_id);
                    } else {
                        mysqli_rollback($conn);
                        $json = Util::setError("Error Occurred.");
                    }
                }
            }
        }
        return $json;
    }

    public function getUsersByType($type)
    {
        $json = Util::setSuccess();
        $result = array();

        $conn = Util::getConn();
        $sql = "SELECT * FROM user WHERE user_type='$type'";
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

    public function update($obj)
    {
        $json = Util::setSuccess();
        $conn = Util::getConn();

        $id = $obj["id"];
        $sql = Util::buildUpdateQuery("user", $id, $obj);
        if (mysqli_query($conn, $sql)) {
            if (Util::commitTransAndCloseConn($conn) == 1) {
                $json = Util::setSuccess();
            } else {
                mysqli_rollback($conn);
                $json = Util::setError("Error Occurred.");
            }
        }
        $json = Util::setSuccess();
        return $json;
    }

    public function findByEmail($email)
    {
        $result = array();
        $conn = Util::getConn();
        $sql = "SELECT * FROM user WHERE email='$email'";
        $data_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data_query)) {
            while ($r = mysqli_fetch_array($data_query, MYSQLI_ASSOC)) {
                extract($r);
                $result[] = $r;
            }
        }
        mysqli_free_result($data_query);
        mysqli_close($conn);
        return $result;
    }

    public function findByMobile($mobile)
    {
        $result = array();
        $conn = Util::getConn();
        $sql = "SELECT * FROM user WHERE mobile='$mobile'";
        $data_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data_query)) {
            while ($r = mysqli_fetch_array($data_query, MYSQLI_ASSOC)) {
                extract($r);
                $result[] = $r;
            }
        }
        mysqli_free_result($data_query);
        mysqli_close($conn);
        return $result;
    }

    public function findById($id)
    {
        $conn = Util::getConn();
        $sql = "SELECT * FROM user WHERE id='$id'";
        $data_query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_object($data_query);
        mysqli_close($conn);
        return $user;
    }

    public function delete()
    {
        $json = Util::setSuccess();
        $conn = Util::getConn();

        $id = $_GET["id"];

        $sql = "DELETE FROM user WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            if (Util::commitTransAndCloseConn($conn) == 1) {
                $json = Util::setSuccess();
            } else {
                mysqli_rollback($conn);
                $json = Util::setError("Error Occurred.");
            }
        }
        return $json;
    }
}
