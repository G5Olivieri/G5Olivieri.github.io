<?php
    class MyPDO extends PDO
    {
        public function __construct($file = 'my_db_settings.ini') {
            if(!$settings = parse_ini_file($file, TRUE)) throw new Exception('Erro ao abrir o arquivo' . $file . '.');

            $dns = $settings['database']['driver'] . 
                ":host=" . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? (";port=" . $settings['database']['port']: '')) .
                ";dbname=" . $settings['database']['schema'];
            
            parent::__construct($dns, $settings['database']['username'], ($settings['database']['password'] ?? ''));
        }
        
        static function getConnect() {
            $con = null;
            try {
                $con = new MyPDO();
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }

        static function insert(Int $id, String $name) {
            $pdo = getConnect();
            $query = "INSERT INTO info VALUES(:id, :name)";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":name", $name);
            $stmt->execute();
            $pdo = null;
        }

        static function validar(Int $id, String $name, PDO $pdo): boolean {
            $query = "SELECT * FROM info WHERE id=:id name=:name";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":name", $name);
            $stmt.execute();
        }
    }
?>