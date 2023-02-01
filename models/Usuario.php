<?php

namespace Model;

use Model\ActiveRecord;
use mysqli;

class Usuario extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    //Alertas
    protected static $alertas = [];

    //Atributos
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->apellido = $args['apellido'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;
        $this->telefono = $args['telefono'] ?? null;
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? "";
    }

    public function validarDatos(){
        if(!$this->nombre){
            self::$alertas['error'][] = "No se ha ingresado un nombre"; 
        }

        if(!$this->apellido){
            self::$alertas['error'][] = "No se ha ingresado un apellido"; 
        }

        if(!$this->email){
            self::$alertas['error'][] = "No se ha ingresado un email"; 
        }

        if(!$this->password){
            self::$alertas['error'][] = "No se ha ingresado una password"; 
        }

        if(!$this->telefono){
            self::$alertas['error'][] = "No se ha ingresado un telefono"; 
        }

        return self::$alertas;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas[] = "No se ha ingresado un email"; 
        }

        if(!$this->password){
            self::$alertas[] = "No se ha ingresado una password"; 
        }

        return self::$alertas;
    }

    public function getByPW($password){
        $query = "SELECT * FROM ".self::$tabla." WHERE password = '".$password."';";
        
        $resultado = self::$db->query($query);

        if($resultado->num_rows > 0){
            return true;
        }

        return false;
    }

    public function getByConfirm($mail){
        $query = "SELECT confirmado FROM ".self::$tabla." WHERE email = '".$mail."' AND confirmado = 1 LIMIT 1;";
        
        $resultado = self::$db->query($query);

        if($resultado->num_rows > 0){
            return true;
        }

        return false;
    }

    public function getByMail($mail){
        $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$mail."' LIMIT 1;";
        
        $resultado = self::$db->query($query);

        if($resultado->num_rows > 0){
            return true;
        }

        return false;
    }

    public static function getByToken($token){
        $query = "SELECT * FROM usuarios WHERE token = '".$token."' LIMIT 1;";
        
        return self::$db->query($query);
    }

    public function usuarioExiste(){
        $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1;";
        
        $resultado = self::$db->query($query);

        if($resultado->num_rows > 0){
            self::$alertas[] = "El usuario ya esta registrado";
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = md5($this->password);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function update() {
        $query = "UPDATE usuarios SET confirmado = 0, token = '$this->token' WHERE id = $this->id";

        return self::$db->query($query);
    }

    public function updatePW($password, $id) {
        $query = "UPDATE usuarios SET password = '$password', token = '' WHERE id = $id";
        return self::$db->query($query);
    }

    public function guardar() {
        $query = "INSERT INTO usuarios(nombre, apellido, email, password, telefono, admin, confirmado, token )";
        $query .= "VALUES('$this->nombre', '$this->apellido', '$this->email', '$this->password', '$this->telefono', '$this->admin', '$this->confirmado', '$this->token')";
        
        return self::$db->query($query);
    }

    public function obtener($mail) {
        $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$mail."' LIMIT 1;";
        
        return self::$db->query($query);
    }

    public static function activarToken($token) {
        $query = "SELECT * FROM usuarios WHERE token='$token'";
        
        $resultado = self::$db->query($query);

        if($resultado->num_rows > 0){
            $query = "UPDATE usuarios SET confirmado = 1, token = NULL WHERE token = '$token'";
            self::$db->query($query);

            return true;
        }

        return false;
    }
}