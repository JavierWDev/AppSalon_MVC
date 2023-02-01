<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{

    public static function index(Router $router){

        $servicios = Servicio::all();

        $router->render("servicios/index",[
            "servicios" => $servicios
        ]);
    }

    public static function crear(Router $router){

        $servicio = new Servicio;
        $alertas = [];


        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST);
            
            if(!$_POST["nombre"]){
                $alertas["error"][] = "El nombre del servicio es obligatorio"; 
            }

            if(!$_POST["precio"]){
                $alertas["error"][] = "El precio del servicio es obligatorio"; 
            }

            if(!is_numeric($_POST["precio"])){
                $alertas["error"][] = "El precio no es valido"; 
            }

            //Guardo en la Db
            if(empty($alertas)){
                $servicio->guardar();
                header("Location: /servicios");
            }

        }

        $router->render("servicios/crear", [
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    public static function actualizar(Router $router){
        if(!is_numeric($_GET["id"])) return;

        $servicioId = Servicio::find($_GET["id"]);
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicioId->sincronizar($_POST);
            
            if(!$_POST["nombre"]){
                $alertas["error"][] = "El nombre del servicio es obligatorio"; 
            }

            if(!$_POST["precio"]){
                $alertas["error"][] = "El precio del servicio es obligatorio"; 
            }

            if(!is_numeric($_POST["precio"])){
                $alertas["error"][] = "El precio no es valido"; 
            }

            //Guardo en la Db
            if(empty($alertas)){
                $servicioId->guardar();
                header("Location: /servicios");
            }
        }

        $router->render("servicios/actualizar",[
            "servicio" => $servicioId,
            "alertas" => $alertas,
        ]);

    }

    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $servicio = Servicio::find($id);

            $servicio->eliminar();
            header("Location: /servicios");
        }
    }
}