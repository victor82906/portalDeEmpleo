<?php

namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Helpers\Login;
use PortalDeEmpleo2\Helpers\Session;
use PortalDeEmpleo2\Helpers\Converted;
use PortalDeEmpleo2\Repositories\RepoSolicitud;
use PortalDeEmpleo2\Repositories\RepoAlumno;
use PortalDeEmpleo2\Model\Solicitud;
use DateTime;

require_once __DIR__ . '/../autoLoad.php';

router();

function router(){

    $metodo = $_SERVER['REQUEST_METHOD'];

    switch($metodo){
        case "GET":
            get();
        break;

        case "POST":
            post();
        break;
        
        case "PUT":
            put();
        break;
        
        case "DELETE":
            delete();
        break;
    }

}

function get(){

    Session::openSession();
    $alumno = Login::getUser();
    $solicitudes = RepoAlumno::getSolicitudes($alumno["id"]);
    echo Converted::solicitudesToJson($solicitudes);

}

function post(){

    Session::openSession();
    $alumno = Login::getUser();
    $data = json_decode(file_get_contents("php://input"), true);

    $respuesta = true;
    $mensaje = "Oferta solicitada correctamente";
    $solicitud = new Solicitud(0, new DateTime(), "enProceso", $alumno["id"], $data["ofertaId"]);
    if(!RepoSolicitud::save($solicitud)){
        $respuesta = false;
        $mensaje = "Ya has solicitado esta oferta";
    }

    echo json_encode([
        "respuesta" => $respuesta,
        "mensaje"   => $mensaje
    ]);

}

function put(){
    
}

function delete(){
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    $respuesta = true;
    $mensaje = "Solicitud borrada correctamente";
    if(!RepoSolicitud::delete($data["id"])){
        $respuesta = false;
        $mensaje = "Fallo al borrar";
    }
    echo json_encode([
        "respuesta" => $respuesta,
        "mensaje"   => $mensaje
    ]);

}
 
?>