<?php
    namespace Project\Model\PDO;
    use Exception;
    use \PDO;
use PDOException;

class MyPDO extends PDO
    {

        /**
         * MyPDO constructor.
         * @package Project\PDO
         * @param string $file
         * @throws Exception
         */
        public function __construct($file = 'my_db_settings.ini')
        {
            if (!$settings = parse_ini_file($file, TRUE)) throw new Exception('Erro ao abrir o arquivo' . $file . '.');

            $dns = $settings['database']['driver'] .
                ":host=" . $settings['database']['host'] .
                ((!empty($settings['database']['port'])) ? ";port=" . $settings['database']['port'] : '') .
                ";dbname=" . $settings['database']['schema'];

            parent::__construct($dns, $settings['database']['username'], ($settings['database']['password'] ?? ''));
        }

        /**
         * @param $attributes
         * @throws Exception
         */
        public function insert($attributes)
        {
            if(!is_object($attributes) && !is_array($attributes)) {
                throw new Exception(gettype($attributes) . ' não suportado');
            }
            if ($this->valid($attributes)) {
                try {
                    $query = "INSERT INTO info VALUES (";
                    foreach($attributes as $key => $value) {
                        $query .= ":".$key . ", ";
                    }
                    $query = substr($query, 0, strlen($query)-2) . ")";
                    $stmt = $this->prepare($query);
                    $stmt->execute((array)$attributes);
                } catch (PDOException $e) {
                    throw new MyPDOException($e);
                }
            }
        }

        /**
         * @return array
         */
        public function getAll(): array
        {

            $arr = array();
            try {
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
         * @param $attributes
         * @return bool
         */
        public function valid($attributes): bool
        {
            try {
                /**
                 * @var string $name
                 * HEREDOC MYSQL query
                 */
                $query = "SELECT * FROM info WHERE ";
                foreach($attributes as $key => $value) {
                    $query .= $key . "=:" . $key . " and ";
                }
                $query = substr($query, 0, strlen($query)-5);

                $stmt = $this->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $stmt->execute((array)$attributes);
                if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
                    return true;
                }
            } catch (PDOException $e) {
                throw new MyPDOException($e);
            }
            return false;
        }
    }
?>
