<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class ApiController
{

    public static function index()
    {
        $servicio = Servicio::all();

        echo json_encode($servicio);
    }

    public static function guardar()
    {

        //Almacena la cita y devuelve el Id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado["id"];

        //Almacena los servicios con el id de la Cita
        $idServicios = explode(",", $_POST["servicios"]);
        foreach ($idServicios as $idServicio) {
            $args = [
                "citaId" => $id,
                "servicioId" => $idServicio
            ];

            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //Retornamos una respuesta
        $respuesta = [
            "resultado" => $resultado
        ];

        echo json_encode($respuesta);
    }

    public static function eliminar()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];

            $cita = Cita::find($id);
            $cita->eliminar();

            header("Location: ".$_SERVER["HTTP_REFERER"]);
        }else{
            header("Location: /");
        }
    }
}
