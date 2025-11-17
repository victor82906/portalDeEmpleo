<?php 

namespace PortalDeEmpleo2\Controllers;
use PortalDeEmpleo2\Repositories\RepoSolicitud;
use PortalDeEmpleo2\Repositories\RepoAlumno;
use PortalDeEmpleo2\Repositories\RepoOferta;
use PortalDeEmpleo2\Helpers\Authorization;
use PortalDeEmpleo2\Helpers\Login;
use PortalDeEmpleo2\Repositories\RepoEmpresa;

class SolicitudController{

    private $repo;
    private $templates;

    public function __construct($templates){
        $this->repo = new RepoSolicitud();
        $this->templates = $templates;
    }

    public function mostrarSolicitudes(){
        Authorization::requireRole("alumno");
        echo $this->templates->render("mostrarSolicitudes");
    }

    public function gestionarSolicitudes(){
        Authorization::requireRole("empresa");

        if(isset($_GET["accion"])){
            $solicitud = RepoSolicitud::findById($_GET["id"]);
            switch($_GET["accion"]){
                case "aceptar":
                    $solicitud->setEstado("aceptada");
                break;
                case "rechazar":
                    $solicitud->setEstado("rechazada");
                break;
            }
            RepoSolicitud::update($solicitud);
        }

        $empresa = Login::getUser();
        $ofertas = RepoEmpresa::getOfertas($empresa["id"]);
        $solicitudes = [];
        $solis = [];
        foreach($ofertas as $oferta){
            $solis = array_merge($solis, RepoOferta::getSolicitudes($oferta->getId()));
        }

        foreach($solis as $soli){
            $alumno = RepoAlumno::findById($soli->getAlumnoId());
            $oferta = RepoOferta::findById($soli->getOfertaId());
            $solicitud = [];
            $solicitud["id"] = $soli->getId();
            $solicitud["nombre"] = $alumno->getNombre();
            $solicitud["foto"] = $alumno->getFoto();
            $solicitud["direccion"] = $alumno->getDireccion();
            $solicitud["correo"] = $alumno->getCorreo();
            $solicitud["curriculum"] = $alumno->getCv();
            $solicitud["descripcion"] = $oferta->getDescripcion();
            $estudios = RepoAlumno::getCiclos($alumno->getId());
            $solicitud["estudios"] = [];
            foreach($estudios as $estudio){
                $solicitud["estudios"][] = ["nombre" => $estudio->getNombre()." (".$estudio->getNivel().")"];
            }
            $solicitudes[] = $solicitud;
        }


        echo $this->templates->render("gestionarSolicitudes", [
            'solicitudes' => $solicitudes
        ]);
    }

}

?>