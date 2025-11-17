<?php

namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Helpers\Login;
use PortalDeEmpleo2\Repositories\RepoUser;

require_once __DIR__ . '/../autoLoad.php';

loginAutomaticoAlumno();

function loginAutomaticoAlumno(){
    $data = json_decode(file_get_contents("php://input"), true);
    $correo = $data['correo'];
    $user = RepoUser::findByCorreo($correo);
    Login::login([
        "id" => $user->getId(),
        "correo" => $user->getCorreo(),
        "rol" => $user->getRol(),
        "foto" => $user->getFoto()
    ]);
    phpinfo();
    header("Location: http://localhost/portalDeEmpleo2/?menu=home");
}

?>