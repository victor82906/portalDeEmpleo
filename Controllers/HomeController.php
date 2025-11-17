<?php

namespace PortalDeEmpleo2\Controllers;
use PortalDeEmpleo2\Repositories\RepoEmpresa;
use PortalDeEmpleo2\Helpers\Session;

class HomeController {

    private $repo;
    private $templates;

    public function __construct($templates){
        $this->repo = new RepoEmpresa();
        $this->templates = $templates;
    }

    public function principal() {
        Session::openSession();
        $empresas = $this->repo->findAll(true);
        echo $this->templates->render('home', ['empresas' => $empresas]);
    }
}

?>