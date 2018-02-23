<?php
    /**
     * Essa classe é para o tratar o acesso ao banco de dados
     * @author Glayson Olivieri <glayson.murollo75@gmail.com>
     * @version 0.1
     */
    namespace Project\PDO;
    use \PDOException;

    /**
     * Class MyPDOException
     * @package Project\PDO
     */
    class MyPDOException extends PDOException {

        /**
         * MyPDOException constructor.
         * @param PDOException $e
         */
        public function __construct(PDOException $e) {
            if(strstr($e->getMessage(), 'SQLSTATE[')) {
                preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
                $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
                $this->message = $matches[3];
            }
        }
    }
?>