<?php
require_once("Util.php");

class FileService
{

    function getFile($url){
        header("Content-Disposition: inline");
        header("Content-Type: application/pdf");
        // header("Content-Length: " . filesize($url )); 
        // header("Content-Transfer-Encoding: binary");
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        echo readfile($url);
    }

}
