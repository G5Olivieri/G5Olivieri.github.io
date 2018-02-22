<?php
    /**
     * Essa classe é para o acesso ao banco de dados
     * @author Glayson Olivieri <glayson.murollo75@gmail.com>
     * @version 0.1
     * @copyright GPLv3 © 2018
     */
    class MyPDO extends PDO
    {

        /**
         * MyPDO constructor.
         * @param string $file
         * @throws Exception
         */
        public function __construct($file = 'my_db_settings.ini') {
            if(!$settings = parse_ini_file($file, TRUE)) throw new Exception('Erro ao abrir o arquivo' . $file . '.');

            $dns = $settings['database']['driver'] . 
                ":host=" . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? ";port=" . $settings['database']['port'] : '') .
                ";dbname=" . $settings['database']['schema'];
            
            parent::__construct($dns, $settings['database']['username'], ($settings['database']['password'] ?? ''));
        }

        /**
         * @param Int $id
         * @param String $name
         */
        public function insert(Int $id, String $name) {
            if($this->valid($id, $name)) {
                try{
                    $query = "INSERT INTO info VALUES(:id, :name)";
                    $stmt = $this->prepare($query);
                    $stmt->bindValue(":id", $id);
                    $stmt->bindValue(":name", $name);
                    $stmt->execute();
                } catch(PDOException $e) {
                    throw new MyPDOException($e);
                }
            }
        }

        /**
         * @return array
         */
        public function getAll(): array {
            $arr = array();
            try{
                $query = "SELECT * FROM info";
                foreach ($this->query($query) as $row) {
                    array_push($arr, ["id" => $row['id'], "fname" => $row['name']]);
                }
            } catch (PDOException $e) {
                throw new MyPDOException($e);
            }
            return $arr;
        }

        /**
         * @param Int $id
         * @param String $name
         * @throws MyPDOException
         * @return bool
         */
        public function valid(Int $id, String $name): bool {
            try {
                $query = /** @lang MySQL */
                        <<<MYSQL
SELECT * FROM info WHERE id='$id' and name='$name';
MYSQL;
//                echo $query;

                if( $this->query($query)->fetch(PDO::FETCH_ASSOC)) {
                    return false;
                }
            } catch(PDOException $e) {
                throw new MyPDOException($e);
                 return false;
            }
            return true;
        }
    }
?>