<?php
include_once("Util.php");

class CategoryService
{

    public function create()
    {
        $string_obj = file_get_contents('php://input');
        $obj = json_decode($string_obj, true);
        
        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "";
        if(isset($obj["id"])){
            $sql = Util::buildUpdateQuery("category", $obj["id"], $obj);
        }else{
            $sql = Util::buildInsertQuery("category", $obj);
        }
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

    public function findAll()
    {
        global $loggedin_user;
        $json = Util::setSuccess();
        $result = array();
        
        $conn = Util::getConn();
        $sql = "SELECT id, name, url FROM category WHERE parent_id = 0";
        $data_query = mysqli_query($conn, $sql);
        if ($data_query) {
            while ($r = mysqli_fetch_array($data_query, MYSQLI_ASSOC)) {
                extract($r);
                //#START Getting child menus
                $childs = array();
                $sql_child = "SELECT id, name, url FROM category WHERE parent_id = ".$r["id"];
                $child_data_query = mysqli_query($conn, $sql_child);
                if($child_data_query){
                    while ($row = mysqli_fetch_array($child_data_query, MYSQLI_ASSOC)) {
                        extract($row);
                        // $childs["children"] = $row;
                        array_push($childs, $row);
                    }
                }
                // #END
                if(count($childs) > 0){
                    $r["children"] = $childs;
                }
                
                $result[] = $r;
            }
        }
        $json = Util::setSuccess($result);
        mysqli_free_result($data_query);
        mysqli_close($conn);
        return $json;
    }

    public function findAllAs()
    {
        global $loggedin_user;
        $json = Util::setSuccess();
        $result = array();
        
        $conn = Util::getConn();
        $sql = "SELECT id, name, url, parent_id, (select name from category where id = c.parent_id) as parent_name FROM category c";
        $data_query = mysqli_query($conn, $sql);
        if ($data_query) {
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

    public function findByCategoryId()
    {
        global $loggedin_user;
        $json = Util::setSuccess();
        $result = array();
        
        $conn = Util::getConn();
        $sql = "SELECT * FROM category_content;";
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

    public function findById($id)
    {
        $conn = Util::getConn();
        $sql = "SELECT * FROM category WHERE id='$id'";
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

        $sql = "DELETE FROM category WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            if (Util::commitTrans($conn) == 1) {
                $json = Util::setSuccess();
            }else{
                mysqli_rollback($conn);
                $json = Util::setError("Error Occurred.");
            }
        }
        mysqli_close($conn);
        return $json;
    }

}
