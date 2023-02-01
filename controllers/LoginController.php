<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            $usuario = new Usuario();

            if(empty($alertas)){
                //Prosigo con la validacion
                $usuarioEnDb = $usuario->getByMail(s($_POST["email"]));

                if($usuarioEnDb){
                    //Verificar password
                    $contraseñaHash = md5(s($_POST["password"]));
                    $confPw = $usuario->getByPW($contraseñaHash);

                    if($confPw){
                        $confCreate = $usuario->getByConfirm(s($_POST["email"]));
                        if($confCreate){
                            $rest = $usuario->obtener(s($_POST["email"]));

                            foreach ($rest as $key => $value) {
                                $_SESSION["nombre"] = $value["nombre"];
                                $_SESSION["apellido"] = $value["apellido"];
                                $_SESSION["admin"] = $value["admin"];
                                $_SESSION["id"] = $value["id"];
                                $_SESSION["login"] = true;

                            }

                            if($_SESSION["admin"] === "1"){
                                header("Location: /admin");
                            }else{
                                header("Location: /cita");
                            }
                        }else{
                            $alertas[] = "El usuario aun no ha sido verificado";
                        }
                    }else{
                        $alertas[] = "La contraseña es incorrecta";
                    }


                }else{
                    $alertas[] = "No existe ese usuario";
                }
            }
        }

        $router->render("auth/login", [
            "alertas" => $alertas
        ]);
    }

    public static function logout(Router $router){
    
        $_SESSION = [];

        header("location: /");
    }

    public static function create(Router $router){

        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarDatos();

            if(empty($alertas)){
                $resultado = $usuario->usuarioExiste();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    //Hashear contraseña
                    $usuario->hashPassword();
                    //Crear token
                    $usuario->crearToken();
                    //Nombre y apellido
                    $nombreCompleto = $usuario->nombre." ".$usuario->apellido;
                    //Enviar el e-mail
                    $email = new Email($usuario->email ,$nombreCompleto, $usuario->token);
                    $email->construirEmail();

                    $resultado = $usuario->guardar();

                    if($resultado){
                        header("Location: /mensaje");
                    }

                }
                
            }

        }

        $router->render("auth/create", [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render("auth/mensaje", []);
    }

    public static function forgot_password(Router $router){
        $alertas = [];

        if ($_SERVER["REQUEST_METHOD"]=== "POST") {
            $auth = new Usuario($_POST);

            $result = $auth->getByMail($_POST["email"]);

            if($result){
                $usuario = $auth->usuarioExiste();
                
                $user = 0;
                foreach ($usuario as $key => $value) {
                    $user = new Usuario($value);
                }

                foreach ($usuario as $key => $value) {
                    if($value["confirmado"] === "1"){
                        //Generar un token de un solo uso
                        $user->crearToken();
                        $user->update();

                        //TODO enviar email
                        $email = new Email($user->nombre, $user->email, $user->token);
                        $email->enviarInstrucciones();

                    }else{
                        Usuario::setAlerta("error", "El usuario no existe o no esta confirmado");
                        $alertas = Usuario::getAlertas();
                    }
                }
                
            }else{
                $alertas[] = "No se ha encontrado a ese usuario";
            }
        }

        $router->render("auth/forgotpw", [
            "alertas" => $alertas
        ]);
    }

    public static function recovery(Router $router){
        $alertas = [];
        $error = false;

        //Obtengo el token
        $token = isset($_GET["token"]) ? $_GET["token"] : null;

        //Verifico que me llegue un token - Si no: envio al index
        if($token === null){
            header("Location: /");
        }
        
        //Verifico que el usuario exista en mi Db
        $usuario = Usuario::getByToken($token);
        $userAct = 0;   //Este sera mi obj usuario

        foreach ($usuario as $key => $value) {
            $userAct = $value;
        }


        //Si userAct es 0 : El usuario no existe
        if($userAct != 0){
            $userAct = new Usuario($userAct);
            //Obtengo el id del usuario 
            $userId = intval($userAct->id);
            
            //Aqui comienza el metodo Post
            if($_SERVER["REQUEST_METHOD"] === "POST"){

                $password = md5(s($_POST["password"]));
                $userAct->updatePW($password, $userId);

                echo "Actualización de contraseña exitosa";
            }

        }else{
            $alertas[] = "No se ha encontrado a ese usuario";
            $error = true;
        }

        $router->render('auth/recovery', [
            "alertas" => $alertas,
            "error" => $error
        ]);
    }

    public static function confirm(Router $router){
        $token = s($_GET["token"]);
        $error = true;
        $result = Usuario::activarToken($token);

        if($result){
            $error = false;
        }

        $router->render("auth/confirm", [
              "error" => $error
        ]);
    }

}

