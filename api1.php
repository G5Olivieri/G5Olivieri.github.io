<?php
    if(file_exists("bd.json")) {
        $fp = fopen("bd.json", 'r+');
        fseek($fp, -1, SEEK_END);
        fwrite($fp, ",\r\n\t".file_get_contents('php://input'));
        fwrite($fp, ']');
        fclose($fp);
    } else {
        $fp = fopen("bd.json", 'w');
        fwrite($fp, "[\t");
        fwrite($fp, file_get_contents('php://input'));
        fwrite($fp, "]");
        fclose($fp);
    }
?>