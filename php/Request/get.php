<?php
    /**
     * Script que será chamado no método get
     * @author Glayson Olivieri <glayson.murollo75@gmail.com>
     * @version 0.1
     * @namespace Project\Request
     */
    namespace Project\Request;
    include '../PDO/MyPDO.php';
    use Project\Model\PDO\MyPDO;
    /**
     * Alterando Header http para aplicação json
     */
    header("Cache-Control: no-cache, must-revalidate");
    header("Content-Type: application/json; charset=utf-8");
    $con = new MyPDO();
    echo json_encode($con->getAll());
    $con = null;
?>