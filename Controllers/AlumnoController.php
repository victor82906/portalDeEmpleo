<?php

namespace PortalDeEmpleo2\Controllers;
use PortalDeEmpleo2\Repositories\RepoAlumno;
use PortalDeEmpleo2\Helpers\Authorization;
use PortalDeEmpleo2\Controllers\LoginController;

class AlumnoController{

    private $repo;
    private $templates;

    public function __construct($templates){
        $this->repo = new RepoAlumno();
        $this->templates = $templates;
    }

    public function listadoAlumnos(){
        Authorization::requireRole("admin");
        echo $this->templates->render('crudAlumno');
    }

    public function registrarAlumno(){
        echo $this->templates->render('registroAlumno');
    }

}

?>