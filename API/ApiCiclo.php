<?php

namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Repositories\RepoCiclo;
use PortalDeEmpleo2\Helpers\Converted;

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
    
    if(isset($_GET["familiaId"])){
        $id = $_GET["familiaId"];
        $ciclos = RepoCiclo::findAllByFamilia($id);
        echo Converted::ciclosToJson($ciclos);
    }
    // else{
    //     $ciclos = RepoCiclo::findAll();
    //     echo Converted::ciclosToJson($ciclos);
    // }
    
}

function post(){

}

function put(){
    
}

function delete(){
    
}
 
?>