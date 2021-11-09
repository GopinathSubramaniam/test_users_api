<?php
require_once("Util.php");
include_once('service/FileService.php');

class CategoryContentService
{

    public function create()
    {
        $string_obj = file_get_contents('php://input');
        $obj = json_decode($string_obj, true);
        
        $conn = Util::getConn();
        $json = Util::setSuccess();
        $sql = "";
        $obj["content"] = base64_encode($obj["content"]);
        if(isset($obj["id"]) && trim($obj["id"]) != ""){
            $sql = Util::buildUpdateQuery("category_content", $obj["id"], $obj);
        }else{
            $sql = Util::buildInsertQuery("category_content", $obj);
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
        $sql = "SELECT * FROM category_content;";
        $data_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data_query)) {
            while ($r = mysqli_fetch_array($data_query, MYSQLI_ASSOC)) {
                extract($r);
                $r["content"] = base64_decode($r["content"]);
                $result[] = $r;
            }
        }
        $json = Util::setSuccess($result);
        mysqli_free_result($data_query);
        mysqli_close($conn);
        return $json;
    }
    
    public function findByCategoryId($id)
    {
        global $loggedin_user;
        $json = Util::setSuccess();
        $result = array();
        
        $conn = Util::getConn();
        $sql = "SELECT * FROM category_content WHERE category_id = $id";
        $data_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($data_query)) {
            while ($r = mysqli_fetch_array($data_query, MYSQLI_ASSOC)) {
                extract($r);
                $r["content"] = base64_decode($r["content"]);
                $result[] = $r;
            }
        }
        $json = Util::setSuccess($result);
        mysqli_free_result($data_query);
        mysqli_close($conn);
        return $json;
    }

    public function findByCategoryUrl($url)
    {
        global $loggedin_user;
        $json = Util::setSuccess();
        $result = array();
        
        $conn = Util::getConn();

        // Get category object
        $sql = "SELECT * FROM category WHERE url = '$url'";
        
        $data_query = mysqli_query($conn, $sql);
        $category = mysqli_fetch_object($data_query);

        // Get category content object
        $category_content_sql = "SELECT * FROM category_content WHERE category_id = ".$category->id;
        $data_query = mysqli_query($conn, $category_content_sql);
        if (mysqli_num_rows($data_query)) {
            while ($r = mysqli_fetch_array($data_query, MYSQLI_ASSOC)) {
                extract($r);
                $r["content"] = base64_decode($r["content"]);
                $result[] = $r;
            }
        }

        $json = Util::setSuccess($result);
        mysqli_free_result($data_query);
        mysqli_close($conn);
        return $json;
    }

    public function findById($id)
    {
        $conn = Util::getConn();
        $sql = "SELECT * FROM category_content WHERE id='$id'";
        $data_query = mysqli_query($conn, $sql);
        $category_content = mysqli_fetch_object($data_query);
        $category_content["content"] = base64_decode($category_content["content"]);
        mysqli_close($conn);
        return $user;
    }

    public function delete()
    {
        $json = Util::setSuccess();
        $conn = Util::getConn();
       
        $id = $_GET["id"];

        $sql = "DELETE FROM category_content WHERE id='$id'";
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

    public function getFile($fileName){
        $url = "../../api/files/$fileName";
        FileService::getFile($url);
    }

}
