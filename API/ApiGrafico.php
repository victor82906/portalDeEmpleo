<?php


namespace PortalDeEmpleo2\API;
use PortalDeEmpleo2\Repositories\RepoEmpresa;

require_once __DIR__ . '/../autoLoad.php';


getEmpresas();
function getEmpresas(){
    $repoEmpresa = new RepoEmpresa();

    $activas = $repoEmpresa->contar(true);
    $noActivas = $repoEmpresa->contar(false);

    echo json_encode(['activas' => $activas, 'noActivas' => $noActivas]);
}


?>