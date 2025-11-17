<?php

namespace PortalDeEmpleo2\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PortalDeEmpleo2\Helpers\Login;
use PortalDeEmpleo2\Helpers\Session;
use PortalDeEmpleo2\Repositories\RepoEmpresa;

class EmailController{

    private $templates;

    public function __construct($templates){
        $this->templates = $templates;
    }

    public function enviaEmail(){

        Session::openSession();
        if(Login::isLogin()){

            $usuario = Login::getUser();

            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP (MailHog)
                $mail->isSMTP();
                $mail->Host = getenv('MAIL_HOST') ?: 'localhost';
                $mail->Port = getenv('MAIL_PORT') ?: 1025;
                $mail->SMTPAuth = false;
                $mail->SMTPDebug = 0;
                // esto te va mostrando lo que hace, en 0 no lo muestra

                // Remitente y destinatario
                $mail->setFrom($usuario["correo"]);
                $mail->addAddress("gestor.email@portalzuelas.com");

                $plantilla = file_get_contents(__DIR__ .'\..\Public\plantillaEmail.html');
                $css = file_get_contents(__DIR__ .'\..\Public\css\estiloEmail.css');
                $plantilla = str_replace('<link rel="stylesheet" href="estilos.css" />', "<style>$css</style>", $plantilla);
                $plantilla = str_replace('{{correo}}', $usuario["correo"], $plantilla);
                $plantilla = str_replace('{{cuerpo}}', $_POST["cuerpo"], $plantilla);

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Sugerencia';
                $mail->Body    = $plantilla;

                $mail->send();
                $mensaje = "✅ Correo enviado correctamente.";
            } catch (Exception $e) {
                $mensaje = "❌ Error al enviar el correo";
            }

            echo $this->templates->render('home', [
                "mensaje" => $mensaje, 
                "empresas" => RepoEmpresa::findAll(true)
            ]);
        }else{
            echo $this->templates->render('login');
        }

    }

}

?>