<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Content-Type: application/json; charset=utf-8");
    if(file_exists("../bd/bd.json")) {
        echo file_get_contents("../bd/bd.json");
    }
?>