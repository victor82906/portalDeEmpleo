<?php

namespace PortalDeEmpleo2\Router;

use PortalDeEmpleo2\Controllers\EmailController;
use PortalDeEmpleo2\Controllers\AlumnoController;
use League\Plates\Engine;
use PortalDeEmpleo2\Controllers\HomeController;
use PortalDeEmpleo2\Controllers\LoginController;
use PortalDeEmpleo2\Controllers\EmpresaController;
use PortalDeEmpleo2\Controllers\OfertaController;
use PortalDeEmpleo2\Controllers\UserController;
use PortalDeEmpleo2\Controllers\SolicitudController;

class Router{

    public function arranca(){
        
        $ruta = "";
        if(isset($_GET["menu"])){
            $ruta = $_GET["menu"];
        }else {
            $ruta = "home";
        }

        // if(!isset($_GET["menu"])){
        //     $_GET["menu"] = "home";
        // }

        $templates = new Engine(__DIR__ . "/../Views");
        // puedo crear aqui el engine de las plantillas si quiero,
        //  y lo paso a los controllers como propiedad de la clase


        switch($ruta){
            case "crudAlumno":
                $controller = new AlumnoController($templates);
                $controller->listadoAlumnos();
            break;
            case "crudEmpresa":
                $controller = new EmpresaController($templates);
                $controller->listadoEmpresas();
            break;
            case "login":
                $controller = new LoginController($templates);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->procesarLogin();
                } else {
                    $controller->login();
                }
            break;
            case "logout":
                $controller = new LoginController($templates);
                $controller->logout();
            break;
            case "registrarAlumno":
                $controller = new AlumnoController($templates);
                $controller->registrarAlumno();
            break;
            case "registrarEmpresa":
                $controller = new EmpresaController($templates);
                $controller->registrarEmpresa();
            break;
            case "borrarEmpresa":
                $controller = new EmpresaController($templates);
                $controller->borrarEmpresa($_GET['id']);
            break;
            case "editarEmpresa":
                $controller = new EmpresaController($templates);
                $controller->editarEmpresa($_GET['id'] ?? null);
            break;
            case "guardaEmpresa":
                $controller = new EmpresaController($templates);
                $controller->guardaEmpresa($_GET['id'] ?? null);
            break;
            case "crearOferta":
                $controller = new OfertaController($templates);
                $controller->crearOferta();
            break;
            case "solicitarOferta":
                $controller = new OfertaController($templates);
                $controller->solicitarOferta();
            break;
            case "mostrarSolicitudes":
                $controller = new SolicitudController($templates);
                $controller->mostrarSolicitudes();
            break;
            case "gestionarSolicitudes":
                $controller = new SolicitudController($templates);
                $controller->gestionarSolicitudes();
            break;
            case "enviaEmail":
                $controller = new EmailController($templates);
                $controller->enviaEmail();
            break;
            case "home":
                $controller = new HomeController($templates);
                $controller->principal();
            break;
            default:
                //not found
            break;
        }
    }
}

?>