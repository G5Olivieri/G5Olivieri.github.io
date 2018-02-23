<?php
/**
 * Essa classe é a simulação de uma classe de domínio do projeto
 * @author Glayson Olivieri <glayson.murollo75@gmail.com>
 * @version 0.1
 */
namespace Project\Model;
include 'PDO/MyPDO.php';
use Exception;
use Project\Model\PDO\MyPDO;

/**
 * Class FakeModel
 * @package Project\Model
 */
class FakeModel
{

    /**
     * @var Int $id
     * @var String name
     */
    private $id;
    private $name;

    /**
     * FakeModel constructor.
     * @param array ...$array
     * @throws Exception
     */
    public function __construct(...$array){
        switch (count($array)) {
            case 0:
                break;
            case 1:
                if(is_object($array[0])) {
                    $json = $array[0];
                    if(isset($json->id) && isset($json->name)) {
                        $this->id = $json->id;
                        $this->name = $json->name;
                    }else {
                        throw new Exception('Objeto inválido');
                    }
                } elseif(is_string($array[0])) {
                    $json = json_decode($array[0]);
                    if(isset($json->id) && isset($json->name)) {
                        $this->id = $json->id;
                        $this->name = $json->name;
                    }else {
                        throw new Exception('JSON inválido');
                    }
                } else {
                    throw new Exception('Argumento inválido');
                }
                break;
            case 2:
                if(is_int($array[0]) && is_string($array[1])){
                    $this->id = $array[0];
                    $this->name = $array[1];
                } elseif(is_int($array[1]) && is_string($array[0])){
                    $this->id = $array[1];
                    $this->name = $array[0];
                } else {
                    throw new Exception('Argumentos inválidos');
                }
                break;
            default:
                throw new Exception('Número de argumentos inválido');
                break;
        }
    }

    /**
     * @param $name
     * @param $value
     * @throws Exception
     */
    public function __set($name, $value) {
        switch($name) {
            case "id":
                if(is_int($value))
                    $this->id = $value;
                else
                    throw new Exception('Tipo inválido para id');
                break;
            case "name":
                if(is_string($value))
                    $this->name = $value;
                else
                    throw new Exception('Tipo inválido para name');
                break;
            default:
                throw new Exception($name . ' não é um atributo da class FakeModel');
                break;
        }
    }

    /**
     * @param $name
     * @return int
     * @throws Exception
     */
    public function __get($name) {
        switch ($name) {
            case "id":
                return $this->id;
                break;
            case "name":
                return $this->name;
                break;
            default:
                throw new Exception($name . ' não é um atributo da class FakeModel');
                break;
        }
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return "Project\Model\FakeModel {\"id\" => \"" . $this->id . "\", \"name\"\"" . $this->name ."\"}\n";
    }

    /**
     * @throws Exception
     */
    public function save() {
        $objPDO = new MyPDO();
        $objPDO->insert($this->toArray());
        $objPDO = null;
    }

    public function toArray(): array {
        return array("id" => $this->id, "name" => $this->name);
    }
}