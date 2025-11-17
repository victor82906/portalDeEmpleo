<?php

namespace PortalDeEmpleo2\Controllers;
use PortalDeEmpleo2\Repositories\RepoOferta;
use PortalDeEmpleo2\Repositories\RepoFamiliaProfesional;
use PortalDeEmpleo2\Repositories\RepoCiclo;
use PortalDeEmpleo2\Helpers\Authorization;
use PortalDeEmpleo2\Helpers\Login;
use PortalDeEmpleo2\Helpers\Validator;
use PortalDeEmpleo2\Model\Oferta;
use DateTime;

class OfertaController{

    private $repo;
    private $templates;

    public function __construct($templates){
        $this->repo = new RepoOferta();
        $this->templates = $templates;
    }

    public function crearOferta(){
        Authorization::requireRole("empresa");
        $empresa = Login::getUser();

        $familias = RepoFamiliaProfesional::findAll();
        $ciclos = [];
        $familiaId = null;
        $errores = [];
        $ciclosSeleccionados = $_POST['ciclosSeleccionados'] ?? [];
        $nombresCiclos = [];
        $mensaje = "";

        $soloCiclo = isset($_POST["soloCiclo"]) ? true : false;
        $accion = $_POST["accion"] ?? null;

        if(!empty($_POST['familia']) && $accion === 'seleccionarFamilia'){
            $familiaId = $_POST['familia'];
            $ciclos = RepoCiclo::findAllByFamilia($familiaId);
        }

        if($_SERVER['REQUEST_METHOD'] === "POST" && empty($accion)){

            $ciclosSeleccionados = array_merge($ciclosSeleccionados, $_POST['ciclos'] ?? []);
            $ciclosSeleccionados = array_filter($ciclosSeleccionados); // quito los vacios

            if(!$soloCiclo){
                $validator = new Validator();
                $validator->requerido($_POST["descripcion"], "descripcion");
                $validator->requerido($_POST["fin"], "fin");
                $errores = $validator->getErrores();

                if(empty($ciclosSeleccionados)){
                    $mensaje = "Debe seleccionar al menos un ciclo formativo";
                }
                
                if(empty($errores) && !empty($ciclosSeleccionados)){
                    $oferta = new Oferta(0, new DateTime(), new DateTime($_POST["fin"]), $_POST["descripcion"], $empresa["id"]);
                    $this->repo->save($oferta);

                    foreach($ciclosSeleccionados as $cicloId){
                        $this->repo->saveCiclo($cicloId, $oferta->getId());
                    }

                    $mensaje = "Oferta creada correctamente";
                    // Limpiar selección de ciclos para el formulario
                    $ciclosSeleccionados = [];
                    $_POST["descripcion"] = "";
                    $_POST["fin"] = "";
                }
            }
        
        }
        
        foreach($ciclosSeleccionados as $cicloId){
            $ciclo = RepoCiclo::findById($cicloId);
            $nombresCiclos[] = $ciclo->getNombre();
        }

        echo $this->templates->render("crearOferta", [
            'familias' => $familias,
            'ciclos' => $ciclos,
            'familiaId' => $familiaId,
            'errores' => $errores,
            'mensaje' => $mensaje,
            'ciclosSeleccionados' => $ciclosSeleccionados,
            'nombresCiclos' => $nombresCiclos
        ]);
            
    }

    public function solicitarOferta(){
        Authorization::requireRole("alumno");
        echo $this->templates->render("solicitarOferta");
    }

}

?>