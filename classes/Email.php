<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function construirEmail(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '668803bcb6836c';
        $mail->Password = 'a3eb9121a62dd7';

        $mail->setFrom("admin@appsalon.com");
        $mail->addAddress("admin@appsalon.com", "AppSalon.com");
        $mail->Subject = "Confirma tu cuenta";
        
        //Html
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p><strong>".$this->nombre;
        $contenido .= "</strong> Has creado tu cuenta en AppSalon,"; 
        $contenido .= "solo debes confirmar tu cuenta presionando el siguiente enlace</p>";
        $contenido .= "<a href='http:localhost:9090/confirm?token=".$this->token."'>Confirmar cuenta</a>";
        $contenido .= "<p>Su no has sido tu, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '668803bcb6836c';
        $mail->Password = 'a3eb9121a62dd7';

        $mail->setFrom("admin@appsalon.com");
        $mail->addAddress("admin@appsalon.com", "AppSalon.com");
        $mail->Subject = "Restablece tu password";
        
        //Html
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";

        $contenido = "<html>";
        $contenido .= "<p><strong>".$this->nombre;
        $contenido .= "</strong> Has solicitado restablecer tu contraseña,"; 
        $contenido .= "presiona el siguiente enlace para poder recuperar tu cuenta.</p>";
        $contenido .= "<a href='http:localhost:9090/recovery?token=".$this->token."'>Restablecer contraseña</a>";
        $contenido .= "<p>Su no has sido tu, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        $mail->send();
    }
}