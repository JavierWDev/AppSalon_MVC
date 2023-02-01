<?php

namespace Model;

class Cita extends ActiveRecord
{
    //Base de datos
    protected static $tabla = "citas";
    protected static $columnasDB = ["id", "fecha", "hora", "usuarioId"];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->fecha = $args["fecha"] ?? "";
        $this->hora = $args["hora"] ?? "";
        $this->usuarioId = $args["usuarioId"] ?? "";
    }

    public function crear() {

        // Insertar en la base de datos
        $query = " INSERT INTO citas(id, fecha, hora, usuarioId)";
        $query .= " VALUES ( '$this->id', '$this->fecha', '$this->hora', '$this->usuarioId')"; 

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id
        ];
    }

}
