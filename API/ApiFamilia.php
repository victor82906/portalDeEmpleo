<?php

namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Helpers\Converted;
use PortalDeEmpleo2\Repositories\RepoFamiliaProfesional;

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
        $id = $_GET["id"];
        $ciclo = RepoFamiliaProfesional::findById($id);
        echo json_encode(Converted::familiaToJson($ciclo));
    }else{
        $ciclos = RepoFamiliaProfesional::findAll();
        echo Converted::familiasToJson($ciclos);
    }
    
}

function post(){

}

function put(){
    
}

function delete(){
    
}
 
?>