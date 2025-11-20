<?php

namespace PortalDeEmpleo2\Controllers;

use PortalDeEmpleo2\Helpers\Authorization;

class GraficoController{

    private $templates;

    public function __construct($templates){
        $this->templates = $templates;
    }

    public function graficoEmpresas(){
        Authorization::requireRole("admin");
        echo $this->templates->render('grafico');
    }

}

?>