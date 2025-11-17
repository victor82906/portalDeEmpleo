<?php

namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Helpers\Login;
use PortalDeEmpleo2\Helpers\Converted;
use PortalDeEmpleo2\Helpers\Session;
use PortalDeEmpleo2\Repositories\RepoAlumno;
use PortalDeEmpleo2\Repositories\RepoOferta;

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

    if(isset($_GET["id"])){
        $oferta = RepoOferta::findById($_GET["id"]);
        echo json_encode(Converted::ofertaToJson($oferta));
    }else{
        Session::openSession();
        $alumno = Login::getUser();
        $ofertas = RepoAlumno::getOfertas($alumno["id"]);
        echo Converted::ofertasToJson($ofertas);
    }

}

function post(){

}

function put(){
    
}

function delete(){
    
}
 
?>