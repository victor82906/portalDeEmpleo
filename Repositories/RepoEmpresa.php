<?php

namespace PortalDeEmpleo2\Repositories;
use PortalDeEmpleo2\Model\Empresa;
use PortalDeEmpleo2\Model\User;
use PortalDeEmpleo2\Model\Oferta;
use PortalDeEmpleo2\Helpers\Converted;
use DateTime;
use PDO;
use PDOException;

class RepoEmpresa{

    public function contar(bool $activas, $filtro = "", $valor = ""){
        $con = (new DB())->getConection();
        $sql = "SELECT COUNT(*) 
                FROM user u 
                JOIN empresa e ON u.id = e.user_id
                WHERE e.activa = :activa";

        if(!empty($filtro) && !empty($valor)){
            $sql .= " AND $filtro LIKE :valor";
        }
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":activa", $activas, \PDO::PARAM_BOOL);
        if(!empty($filtro) && !empty($valor)){
            $valor = "%$valor%";
            $stmt->bindParam(":valor", $valor, \PDO::PARAM_STR);
        }

        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function findPaginated(bool $activas, int $limit, int $offset, $filtro = "", $valor = ""){
        $con = (new DB())->getConection();
        $sql = "SELECT * 
            FROM user u 
            JOIN empresa e ON u.id = e.user_id
            WHERE e.activa = :activa";
        
        if(!empty($filtro) && !empty($valor)){
            $sql .= " AND $filtro LIKE :valor";
        }

        $sql .= " ORDER BY e.user_id ASC
                LIMIT :limit OFFSET :offset";
        $stmt = $con->prepare($sql);  
        $stmt->bindParam(":activa", $activas, \PDO::PARAM_BOOL);
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, \PDO::PARAM_INT);

        if(!empty($filtro) && !empty($valor)){
            $valor = "%$valor%";
            $stmt->bindParam(":valor", $valor, \PDO::PARAM_STR);  
        }

        $stmt->execute();
        $empresasDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $empresas = [];
        foreach ($empresasDB as $empresa) {
            $empresas[] = new Empresa(
                $empresa["id"],
                $empresa["correo"],
                $empresa["contrasena"],
                $empresa["rol"],
                $empresa["foto"],
                $empresa["nombre"],
                $empresa["telefono"],
                $empresa["direccion"],
                $empresa["descripcion"],
                $empresa["personaContacto"],
                $empresa["numPersonaContacto"],
                (bool) $empresa["activa"]
            );
        }

        return $empresas;
    }

    public static function findAll(bool $activas){
        $con = (new DB())->getConection();
        $sql = "SELECT * 
                FROM user u 
                JOIN empresa e ON u.id = e.user_id
                WHERE e.activa = :activa";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":activa", $activas, PDO::PARAM_BOOL);
        $stmt->execute();
        $empresasDB = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $empresas = [];
        foreach($empresasDB as $empresa){
            $empresas[] = new Empresa(
                $empresa["id"],
                $empresa["correo"],
                $empresa["contrasena"],
                $empresa["rol"],
                $empresa["foto"],
                $empresa["nombre"],
                $empresa["telefono"],
                $empresa["direccion"],
                $empresa["descripcion"],
                $empresa["personaContacto"],
                $empresa["numPersonaContacto"],
                (bool)$empresa["activa"]
            );
        }

        return $empresas;
    }

    public static function findById($id){
        $con = (new DB())->getConection();
        $sql = "SELECT *
                FROM user u 
                JOIN empresa e ON u.id = e.user_id 
                WHERE u.id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $empresaDB = $stmt->fetch(PDO::FETCH_ASSOC);

        $empresa = null;
        if($empresaDB){
            $empresa = new Empresa(
                $empresaDB["id"],
                $empresaDB["correo"],
                $empresaDB["contrasena"],
                $empresaDB["rol"],
                $empresaDB["foto"],
                $empresaDB["nombre"],
                $empresaDB["telefono"],
                $empresaDB["direccion"],
                $empresaDB["descripcion"],
                $empresaDB["personaContacto"],
                $empresaDB["numPersonaContacto"],
                (bool)$empresaDB["activa"]
            );
        }

        return $empresa;
    }

    public static function save(Empresa $empresa){
        try{
            $con = (new DB())->getConection();
            $con->beginTransaction();
            $resultado = true;

            $sqlUser = "INSERT INTO user (correo, contrasena, rol, foto) 
                        VALUES(:correo, :contrasena, :rol, :foto)";
            $stmtUser = $con->prepare($sqlUser);
            $resultadoUser = $stmtUser->execute([
                ":correo"       => $empresa->getCorreo(),
                ":contrasena"   => Converted::codificarPassw($empresa->getContrasena()),
                ":rol"          => $empresa->getRol(),
                ":foto"         => $empresa->getFoto()
            ]);

            if($resultadoUser){
                $empresa->setId((int)$con->lastInsertId());
                
                $sql = "INSERT INTO empresa (user_id, nombre, telefono, direccion, descripcion, personaContacto, numPersonaContacto, activa) 
                    VALUES(:user_id, :nombre, :telefono, :direccion, :descripcion, :personaContacto, :numPersonaContacto, :activa)";
                $stmt = $con->prepare($sql);
                $resultadoEmpresa = $stmt->execute([
                    ":user_id"              => $empresa->getId(),
                    ":nombre"               => $empresa->getNombre(),
                    ":telefono"             => $empresa->getTelefono(),
                    ":direccion"            => $empresa->getDireccion(),
                    ":descripcion"          => $empresa->getDescripcion(),
                    ":personaContacto"      => $empresa->getPersonaContacto(),
                    ":numPersonaContacto"   => $empresa->getNumPersonaContacto(),
                    ":activa"               => $empresa->isActiva() ? 1 : 0
                ]);

                if($resultadoEmpresa){
                    $con->commit();
                }else{
                    $con->rollBack();
                    $resultado = false;
                }
            }else{
                $con->rollBack();
                $resultado = false;
            }
        }catch(PDOException $e){
            if ($con->inTransaction()) {
                $con->rollBack();
            }
            $resultado = false;
        }
        return $resultado;
    }

    public static function update(Empresa $empresa){
        $con = (new DB())->getConection();
        $con->beginTransaction();

        $sqlUser = "UPDATE user SET correo = :correo, contrasena = :contrasena, rol = :rol, foto = :foto WHERE id = :id";
        $stmtUser = $con->prepare($sqlUser);
        $resultado = $stmtUser->execute([
            ":id"           => $empresa->getId(),
            ":correo"       => $empresa->getCorreo(),
            ":contrasena"   => $empresa->getContrasena(),
            ":rol"          => $empresa->getRol(),
            ":foto"         => $empresa->getFoto()
        ]);

        $sql = "UPDATE empresa SET nombre = :nombre, telefono = :telefono, direccion = :direccion, descripcion = :descripcion, personaContacto = :personaContacto, numPersonaContacto = :numPersonaContacto, activa = :activa WHERE user_id = :user_id";
        $stmt = $con->prepare($sql);
        $resultado = $stmt->execute([
            ":user_id"              => $empresa->getId(),
            ":nombre"               => $empresa->getNombre(),
            ":telefono"             => $empresa->getTelefono(),
            ":direccion"            => $empresa->getDireccion(),
            ":descripcion"          => $empresa->getDescripcion(),
            ":personaContacto"      => $empresa->getPersonaContacto(),
            ":numPersonaContacto"   => $empresa->getNumPersonaContacto(),
            ":activa"               => $empresa->isActiva() ? 1 : 0
        ]);

        if($resultado){
            $con->commit();
        }else{
            $con->rollBack();
        }

        return $resultado;
    }

    public static function delete($id){
        $con = (new DB())->getConection();
        $sql = "DELETE FROM USER WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->rowCount() > 0;
    }

    public static function getOfertas($empresaId){
        $con = (new DB())->getConection();
        $sql = "SELECT * 
                FROM oferta 
                WHERE empresa_user_id = :empresa_id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":empresa_id" => $empresaId
        ]);
        $ofertasDB = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ofertas = [];
        foreach($ofertasDB as $oferta){
            $ofertas[] = new Oferta(
                $oferta["id"],
                new DateTime($oferta["fechaInicio"]),
                new DateTime($oferta["fechaFin"]),
                $oferta["descripcion"],
                $oferta["empresa_user_id"]
            );
        }

        return $ofertas;
    }

}

?>