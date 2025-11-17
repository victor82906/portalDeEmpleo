<?php

namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Repositories\RepoEmpresa;
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
    
    if(isset($_GET["id"])){
        $empresa = RepoEmpresa::findById($_GET["id"]);
        echo json_encode(Converted::empresaToJson($empresa));
    }
}

function post(){

}

function put(){
    
}

function delete(){
    
}
 
?>