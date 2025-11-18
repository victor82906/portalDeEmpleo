<?php

namespace PortalDeEmpleo2\Controllers;
use PortalDeEmpleo2\Helpers\Login;
use PortalDeEmpleo2\Repositories\RepoUser;
use PortalDeEmpleo2\Repositories\RepoEmpresa;

class LoginController {

    private $templates;

    public function __construct($templates){
        $this->templates = $templates;
    }

    public function login() {
        echo $this->templates->render('login');
    }

    public function procesarLogin(){

        $correo = $_POST['correo'] ?? '';
        $contrasena = $_POST['passw'] ?? '';

        $user = RepoUser::findByCorreo($correo);
        if($user){
            if (password_verify($contrasena, $user->getContrasena())) {
                // Iniciar sesión
                if($user->getRol() === "empresa"){
                    $empresa = RepoEmpresa::findById($user->getId());
                    if($empresa->isActiva()){
                        Login::login([
                            "id" => $user->getId(),
                            "correo" => $user->getCorreo(),
                            "rol" => $user->getRol(),
                            "foto" => $user->getFoto()
                        ]);
                        header("Location: ?menu=home");
                    }else{
                        echo $this->templates->render('login', ['mensaje' => "Esta empresa no esa activa, tiene que activarla un administrador"]);
                    }
                }else{
                    Login::login([
                        "id" => $user->getId(),
                        "correo" => $user->getCorreo(),
                        "rol" => $user->getRol(),
                        "foto" => $user->getFoto()
                    ]);
                    header("Location: ?menu=home");
                }

            } else {
                echo $this->templates->render('login', ['mensaje' => "El correo y la contraseña no coinciden"]);
            }
        }else{
            echo $this->templates->render('login', ['mensaje' => "Este correo no esta registrado"]);
        }

        
    }

    public function logout(){
        Login::logout();
        header("Location: ?menu=home");
    }

}

?>