<?php
    /**
     * Script que será chamado no método post
     * @author Glayson Olivieri <glayson.murollo75@gmail.com>
     * @version 0.1
     * @namespace Project\Request
     */
    namespace Project\Request;
    include "../PDO/MyPDO.php";
    use Project\PDO\MyPDO;
    /**
     * Pegar a o conteúdo da requisição
     * @var stdClass $json
     */
    $json = json_decode(file_get_contents('php://input'));
    $con = new MyPDO();
    $con->insert($json->{"id"}, $json->{"fname"});
    $con = null;
?>