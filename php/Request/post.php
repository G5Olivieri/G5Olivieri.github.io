<?php
    /**
     * Script que será chamado no método post
     * @author Glayson Olivieri <glayson.murollo75@gmail.com>
     * @version 0.1
     * @namespace Project\Request
     */
    namespace Project\Request;
    include '../Model/FakeModel.php';

    use Exception;
    use Project\Model\FakeModel;

    /**
     * Pegar a o conteúdo da requisição
     * @var stdClass $json
     */
    try {
        $fm = new FakeModel(file_get_contents('php://input'));
        $fm->save();
    } catch (Exception $e) {
        $e->getMessage();
    }

    ?>