<?php

namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Repositories\RepoAlumno;
use PortalDeEmpleo2\Repositories\RepoCiclo;
use PortalDeEmpleo2\Helpers\Converted;
use PortalDeEmpleo2\Helpers\Validator;
use PortalDeEmpleo2\Model\Alumno;
use PortalDeEmpleo2\Repositories\RepoUser;
use PortalDeEmpleo2\Controllers\EmailController;
use DateTime;

// necesito meter estos cuatro para que funcione el mandar email desde api
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';

require_once __DIR__ . '/../autoLoad.php';

// esto es para cuando venga del fetch que hemos engañado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["_method"]) && $_POST["_method"] === "PUT") {
    put();
    exit;
}

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

    // cuando en get en el body no pongo nada es porque los quiere todos
    // si quiero devolver solo algunas propiedades uso stdobject
    // $obj = new stdObject();
    // $obj->id = 1;
    // $obj->nombre = "juan"; ...
}

function get(){
    
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $alumno = RepoAlumno::findById($id);
        echo json_encode(Converted::alumnoToJson($alumno));
    }else{
        $alumnos = RepoAlumno::findAll();
        echo Converted::alumnosToJson($alumnos);
    }
}

function post(){

    $data = $_POST;

    if(isset($data["nombre"])){ // si no es array porque el nombre o otra propiedad viene en la base

        $validator = new Validator();
        if(isset($data["contrasena"])){
            $validator->contrasena($data["contrasena"]);
        }
        $validator->correo($data["correo"]);
        $validator->nombre($data["nombre"]);
        $validator->nombre($data["apellidos"]);
        $validator->requerido($data["direccion"]);
        if(isset($_FILES["foto"])){
            $validator->foto($_FILES["foto"]);
        }
        if(isset($_FILES["cv"])){
            $validator->curriculum($_FILES["cv"]);
        }

        if(!empty($validator->getErrores())){
            echo json_encode([
                    "respuesta" => false,
                    "mensaje"   => "Errores al guardar"
                ]);
        }else{
            $contrasena = isset($data["contrasena"]) ? $data["contrasena"] : bin2hex(random_bytes(8));
            $alumno = new Alumno(
                0, 
                $data["correo"], 
                $contrasena,
                "alumno", 
                "", 
                $data["nombre"], 
                $data["apellidos"], 
                $data["direccion"], 
                null);
            if(RepoAlumno::save($alumno)){
                $alumno = RepoAlumno::findById($alumno->getId());
                if(isset($_FILES["foto"])){
                    $foto = Converted::fotoCuadrada($_FILES["foto"]);
                    $alumno->setFoto("/portalDeEmpleo2/fotosPerfil/" . $alumno->getId() . ".png");
                    imagepng($foto, __DIR__ . "/../fotosPerfil/" . $alumno->getId() . ".png");
                }
                if(isset($_FILES["cv"])){
                    $alumno->setCv("/portalDeEmpleo2/curriculums/" . $alumno->getId() . ".pdf");
                    move_uploaded_file($_FILES["cv"]["tmp_name"], __DIR__ . "/../curriculums/" . $alumno->getId() . ".pdf");
                }
                RepoAlumno::update($alumno);
                $respuesta = Converted::alumnoToJson($alumno);
                if(!isset($data["contrasena"])){
                    EmailController::emailUserNuevo($alumno, $contrasena);
                }

                if(!empty($data["ciclo"])){
                    $ciclo = RepoCiclo::findById($data["ciclo"]);
                    $fechaInicio = new DateTime();
                    $fechaInicio->modify('-2 years');
                    $ciclo->setFechaInicio($fechaInicio);
                    $ciclo->setFechaFin(new DateTime());
                    if(RepoAlumno::saveCiclo($ciclo, $alumno->getId())){
                        echo json_encode([
                            "respuesta" => true,
                            "alumno" => $respuesta
                        ]);
                    }else{
                        echo json_encode([
                            "respuesta" => false,
                            "mensaje" => "Fallo al añadir ciclo al alumno"
                        ]);
                    }
                }else{
                    echo json_encode([
                        "respuesta" => true,
                        "alumno" => $respuesta
                    ]);
                }
                
            }else{
                echo json_encode([
                    "respuesta" => false,
                    "mensaje"   => "Este correo ya esta registrado"
                ]);
            }
        }
    }else{
        $data = json_decode(file_get_contents("php://input"), true);

        $guardados = [];
        $errores = [];
        foreach($data as $alumnoData){
            $contrasena = bin2hex(random_bytes(8));
            $alumno = new Alumno(
                0, 
                $alumnoData["correo"], 
                $contrasena, 
                "alumno", 
                "", 
                $alumnoData["nombre"], 
                $alumnoData["apellidos"], 
                $alumnoData["direccion"], 
                null);
            if(RepoAlumno::save($alumno)){
                $guardados[] = Converted::alumnoToJson($alumno);
                EmailController::emailUserNuevo($alumno, $contrasena);
            }else{
                $errores[] = $alumnoData["correo"];
            }
        }
        echo json_encode([
            "guardados" => $guardados,
            "errores"   => $errores
        ]);
    }

}

function put(){
    
    $data = $_POST;
    
    $alumno = RepoAlumno::findById($data["id"]);
    $alumno->setNombre($data["nombre"]);
    $alumno->setApellidos($data["apellidos"]);
    $alumno->setDireccion($data["direccion"]);
    $alumno->setCorreo($data["correo"]);
    if(isset($_FILES["foto"])){
        $foto = Converted::fotoCuadrada($_FILES["foto"]);
        $alumno->setFoto("/portalDeEmpleo2/fotosPerfil/" . $alumno->getId() . ".png");
        imagepng($foto, __DIR__ . "/../fotosPerfil/" . $alumno->getId() . ".png");
    }
    if(isset($_FILES["cv"])){
        $alumno->setCv("/portalDeEmpleo2/curriculums/" . $alumno->getId() . ".pdf");
        move_uploaded_file($_FILES["cv"]["tmp_name"], __DIR__ . "/../curriculums/" . $alumno->getId() . ".pdf");
    }
    if(RepoAlumno::update($alumno)){
        $respuesta = Converted::alumnoToJson($alumno);

        //echo $data["ciclo"];
        if(!empty($data["ciclo"])){
            $ciclo = RepoCiclo::findById($data["ciclo"]);
            $fechaInicio = new DateTime();
            $fechaInicio->modify('-2 years');
            $ciclo->setFechaInicio($fechaInicio);
            $ciclo->setFechaFin(new DateTime());
            if(RepoAlumno::saveCiclo($ciclo, $alumno->getId())){
                echo json_encode([
                    "respuesta" => true,
                    "alumno" => $respuesta
                ]);
            }else{
                echo json_encode([
                    "respuesta" => false,
                    "mensaje" => "Fallo al añadir ciclo al alumno"
                ]);
            }
        }else{
            echo json_encode([
                "respuesta" => true,
                "alumno" => $respuesta
            ]);
        }

    }else{
        echo json_encode([
            "respuesta" => false,
            "mensaje"   => "No se ha podido modificar el alumno"
        ]);
    }
}

function delete(){
    
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"];
    if(RepoUser::delete((int)$id)){
        echo json_encode(["respuesta" => true]);
    }else {
        echo json_encode(["respuesta" => false]);
    }
}
 
?>
