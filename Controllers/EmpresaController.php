<?php

namespace PortalDeEmpleo2\Controllers;
use PortalDeEmpleo2\Repositories\RepoEmpresa;
use PortalDeEmpleo2\Helpers\Authorization;
use PortalDeEmpleo2\Helpers\Converted;
use PortalDeEmpleo2\Helpers\Validator;
use PortalDeEmpleo2\Helpers\Paginator;
use PortalDeEmpleo2\Model\Empresa;

class EmpresaController{

    private $repo;
    private $templates;

    public function __construct($templates){
        $this->repo = new RepoEmpresa();
        $this->templates = $templates;
    }

    public function registrarEmpresa(){
        if(isset($_POST["telefono"])){

            $validator = new Validator();

            $validator->correo($_POST["correo"],"correo");
            $validator->contrasena($_POST["passw"], "passw");
            $validator->nombre($_POST["nombre"], "nombre");
            $validator->telefono($_POST["telefono"], "telefono");
            $validator->requerido($_POST["direccion"], "direccion");
            $validator->requerido($_POST["descripcion"], "descripcion");
            $validator->nombre($_POST["personaContacto"], "personaContacto");
            $validator->telefono($_POST["numeroContacto"], "numeroContacto");
            if(isset($_FILES["foto"])){
                $validator->foto($_FILES["foto"], "foto");
            }

            if(empty($validator->getErrores())){
                $empresa = new Empresa(
                    0, 
                    $_POST["correo"], 
                    $_POST["passw"],
                    "empresa", 
                    "",
                    $_POST["nombre"],
                    $_POST["telefono"],
                    $_POST["direccion"],
                    $_POST["descripcion"],
                    $_POST["personaContacto"],
                    $_POST["numeroContacto"],
                    false
                );
                if($this->repo->save($empresa)){
                    $empresa = $this->repo->findById($empresa->getId());
                    if(!empty($_FILES["foto"]["tmp_name"])){
                        $foto = Converted::fotoCuadrada($_FILES["foto"]);
                        $empresa->setFoto("/portalDeEmpleo2/fotosPerfil/" . $empresa->getId() . ".png");
                        imagepng($foto, "C:\\xampp\\htdocs\\portalDeEmpleo2\\fotosPerfil\\" . $empresa->getId() . ".png");
                    }
                    $this->repo->update($empresa);
                    echo $this->templates->render('registroEmpresa', [
                        "mensaje" => "Creada!!, espera a que un admin la active para loguearte"
                    ]);
                }else{
                    echo $this->templates->render('registroEmpresa', [
                        "mensaje" => "Este correo ya esta registrado!!"
                    ]);
                }
            }else{
                ///echo $validator->getErrores();
                echo $this->templates->render('registroEmpresa', [
                    "errores"   => $validator->getErrores(),
                    "data"      => $_POST
                ]);
            }
            
        }else{
            echo $this->templates->render('registroEmpresa');
        }
    }

    public function listadoEmpresas(){
        Authorization::requireRole("admin");

        $paginaActual = $_GET['page'] ?? 1;
        $porPagina = $_GET['limit'] ?? 10;
        $filtro = "";
        $valor = "";
        if(isset($_GET['filtro']) && isset($_GET['valor'])){
            $filtro = $_GET['filtro'];
            $valor = $_GET['valor'];
        }
        $totalEmpresas = $this->repo->contar(true, $filtro, $valor);
        $paginador = Paginator::build($totalEmpresas, $paginaActual, $porPagina);
        $empresas = $this->repo->findPaginated(true, $paginador['porPagina'], $paginador['offset'], $filtro, $valor);
        $empresasNoActivas = $this->repo->findAll(false);
        echo $this->templates->render('crudEmpresa', ['empresas'          => $empresas,
                                                      'empresasNoActivas' => $empresasNoActivas,
                                                      'paginador'         => $paginador]);
    }

    public function borrarEmpresa($id){
        Authorization::requireRole("admin");
        $this->repo->delete($id);
        header("Location: ?menu=crudEmpresa");
    }

    public function editarEmpresa($id){
        Authorization::requireRole("admin");
        $empresa = $id ? $this->repo->findById($id) : null;
        echo $this->templates->render("editarEmpresa", ["empresa" => $empresa,
                                                        "edicion" => $id ? true : false,
                                                        "id"      => $id]);
    }

    public function guardaEmpresa($id){
        Authorization::requireRole("admin");

        $validator = new Validator();
        if(!$id){
            $validator->correo($_POST["correo"], "correo");
        }
        $validator->nombre($_POST["nombre"], "nombre");
        $validator->telefono($_POST["telefono"], "telefono");
        $validator->requerido($_POST["direccion"], "direccion");
        $validator->requerido($_POST["descripcion"], "descripcion");
        $validator->nombre($_POST["personaContacto"], "personaContacto");
        $validator->telefono($_POST["numeroContacto"], "numeroContacto");
        if(isset($_FILES["foto"])){
            $validator->foto($_FILES["foto"], "foto");
        }

        if(empty($validator->getErrores())){
            if($id){
                $empresa = $this->repo->findById($id);
                $empresa->setNombre($_POST["nombre"]);
                $empresa->setTelefono($_POST["telefono"]);
                $empresa->setDireccion($_POST["direccion"]);
                $empresa->setDescripcion($_POST["descripcion"]);
                $empresa->setPersonaContacto($_POST["personaContacto"]);
                $empresa->setNumPersonaContacto($_POST["numeroContacto"]);
                $empresa->setActiva(isset($_POST["activa"]) ? true : false);
                if(!empty($_FILES["foto"]["tmp_name"])){ // no hay foto subida
                    $foto = Converted::fotoCuadrada($_FILES["foto"]);
                    $empresa->setFoto("/portalDeEmpleo2/fotosPerfil/" . $empresa->getId() . ".png");
                    imagepng($foto, "C:\\xampp\\htdocs\\portalDeEmpleo2\\fotosPerfil\\" . $empresa->getId() . ".png");
                }
                $this->repo->update($empresa);
                header("Location: ?menu=crudEmpresa");
            } else{
                $empresa = new Empresa(
                    0, 
                    $_POST["correo"], 
                    "0123456789", 
                    "empresa", 
                    "",
                    $_POST["nombre"],
                    $_POST["telefono"],
                    $_POST["direccion"],
                    $_POST["descripcion"],
                    $_POST["personaContacto"],
                    $_POST["numeroContacto"],
                    isset($_POST["activa"]) ? true : false
                );
                if($this->repo->save($empresa)){
                    $empresa = $this->repo->findById($empresa->getId());
                    if(!empty($_FILES["foto"]["tmp_name"])){
                        $foto = Converted::fotoCuadrada($_FILES["foto"]);
                        $empresa->setFoto("/portalDeEmpleo2/fotosPerfil/" . $empresa->getId() . ".png");
                        imagepng($foto, "C:\\xampp\\htdocs\\portalDeEmpleo2\\fotosPerfil\\" . $empresa->getId() . ".png");
                    }
                    $this->repo->update($empresa);
                    header("Location: ?menu=crudEmpresa");
                }else{
                    echo $this->templates->render('editarEmpresa', [
                        "mensaje"   => "Este correo ya esta registrado!!",
                        "edicion"   => false,
                        "id"        => $id
                    ]);
                }
            }
        }else{
            echo $this->templates->render('editarEmpresa', [
                "errores"   => $validator->getErrores(),
                "data"      => $_POST,
                "edicion"   => $id ? true : false,
                "id"        => $id
            ]);
        }
    }

    // public function registrarEmpresa(){
        
    // }

}

?>