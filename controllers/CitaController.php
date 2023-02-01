<?php

namespace Controllers;

use MVC\Router;

class CitaController{
    
    public static function index(Router $router){

        $nombre = "";
        $id = "";
        $apellido = "";

        if($_SESSION["login"] === true){
            $nombre = $_SESSION["nombre"];
            $apellido = $_SESSION["apellido"];
            $id = $_SESSION["id"];
        }else{
            header("Location: /");
        }

        $router->render("cita/index", [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "id" => $id
        ]);
        
    }
}
