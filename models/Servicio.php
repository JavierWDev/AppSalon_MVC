<?php 

namespace Model;

class Servicio extends ActiveRecord{

    //Base de datos
    protected static $tabla = "servicios";
    protected static $columnasDB = ["id", "nombre", "precio"];

    //Atributos
    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->precio = $args["precio"] ?? "";
    }

    //Listar todos los servicios
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}