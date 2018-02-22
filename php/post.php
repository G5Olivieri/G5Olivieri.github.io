<?php
    // if(file_exists("../bd/bd.json")) {
    //     $fp = fopen("../bd/bd.json", 'r+');
    //     fseek($fp, -1, SEEK_END);
    //     fwrite($fp, ",\r\n\t".file_get_contents('php://input'));
    //     fwrite($fp, ']');
    //     fclose($fp);
    // } else {
    //     $fp = fopen("../bd/bd.json", 'w');
    //     fwrite($fp, "[\t");
    //     fwrite($fp, file_get_contents('php://input'));
    //     fwrite($fp, "]");
    //     fclose($fp);
    // }

    // Pegar a o conteúdo da requisição
    $json = json_decode(file_get_contents('php://input'))   ;
//    var_dump($json);
    include "MyPDO.php";
    $con = new MyPDO();
    $con->insert($json->{"id"}, $json->{"fname"});
    $con = null;
?>