<?php

namespace PortalDeEmpleo2\Repositories;
use PortalDeEmpleo2\Model\Oferta;
use PortalDeEmpleo2\Model\Ciclo;
use PortalDeEmpleo2\Model\Solicitud;
use DateTime;
use PDOException;

class RepoOferta{
 
    public static function findAll(){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM oferta";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $ofertasDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
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

    public static function findById($id){
        $con = (new DB())->getConection();
        $sql = "SELECT * 
                FROM oferta 
                WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $ofertaDB = $stmt->fetch(\PDO::FETCH_ASSOC);

        $oferta = null;
        if($ofertaDB){
            $oferta = new Oferta(
                $ofertaDB["id"],
                new DateTime($ofertaDB["fechaInicio"]),
                new DateTime($ofertaDB["fechaFin"]),
                $ofertaDB["descripcion"],
                $ofertaDB["empresa_user_id"]
            );
        }

        return $oferta;
    }

    public static function save(Oferta $oferta){
        $con = (new DB())->getConection();
        $sql = "INSERT INTO oferta (fechaInicio, fechaFin, descripcion, empresa_user_id)
                VALUES(:fechaInicio, :fechaFin, :descripcion, :empresaId)";
        $stmt = $con->prepare($sql);
        $fechaInicioStr = $oferta->getFechaInicio()->format('Y-m-d');
        $fechaFinStr = $oferta->getFechaFin()->format('Y-m-d');
        $resultado = $stmt->execute([
            ":fechaInicio"  => $fechaInicioStr,
            ":fechaFin"     => $fechaFinStr,
            ":descripcion"  => $oferta->getDescripcion(),
            ":empresaId"    => $oferta->getEmpresaId()
        ]);

        if($resultado){
            //casteo a int
            $oferta->setId((int)$con->lastInsertId());
        }

        return $resultado;
    }

    public static function saveCiclo(int $cicloId, int $ofertaId){
        try {
            $con = (new DB())->getConection();

            $sqlCheck = "SELECT COUNT(*) FROM oferta_has_ciclo WHERE oferta_id = :ofertaId AND ciclo_id = :cicloId";
            $stmtCheck = $con->prepare($sqlCheck);
            $stmtCheck->execute([
                ':ofertaId' => $ofertaId,
                ':cicloId' => $cicloId
            ]);
            if ($stmtCheck->fetchColumn() > 0) {
                return false;
            }

            $sql = "INSERT INTO oferta_has_ciclo (oferta_id, ciclo_id) VALUES (:ofertaId, :cicloId)";
            $stmt = $con->prepare($sql);
            $resultado = $stmt->execute([
                ':ofertaId' => $ofertaId,
                ':cicloId' => $cicloId
            ]);

        } catch (PDOException $e) {
            $resultado = false;
        }

        return $resultado;
    }

    public static function update(Oferta $oferta){
        $con = (new DB())->getConection();
        $sql = "UPDATE oferta 
                SET fechaInicio = :fechaInicio, 
                    fechaFin = :fechaFin, 
                    descripcion = :descripcion 
                WHERE id = :id";
        $stmt = $con->prepare($sql);
        $fechaInicioStr = $oferta->getFechaInicio()->format('Y-m-d');
        $fechaFinStr = $oferta->getFechaFin()->format('Y-m-d');
        $resultado = $stmt->execute([
            ":fechaInicio"  => $fechaInicioStr,
            ":fechaFin"     => $fechaFinStr,
            ":descripcion"  => $oferta->getDescripcion(),
            ":id"           => $oferta->getId()
        ]);

        return $resultado;
    }

    public static function delete($id){
        $con = (new DB())->getConection();
        $sql = "DELETE FROM oferta WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->rowCount() > 0;
    }

    public static function getCiclos($ofertaId){
        $con = (new DB())->getConection();
        $sql = "SELECT c.id, c.nombre, c.nivel, c.familiaProfesional_id
                FROM ciclo c
                JOIN oferta_has_ciclo ohc ON c.id = ohc.ciclo_id
                JOIN oferta o ON o.id = ohc.oferta_id
                WHERE o.id = :ofertaId";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":ofertaId" => $ofertaId
        ]);
        $ciclosDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $ciclos = [];
        foreach($ciclosDB as $ciclo){
            $ciclos[] = new Ciclo(
                $ciclo["id"],
                $ciclo["nombre"],
                $ciclo["nivel"],
                $ciclo["familiaProfesional_id"]
            );
        }

        return $ciclos;
    }

    public static function getSolicitudes($ofertaId){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM solicitud WHERE oferta_id = :ofertaId AND estado = 'enProceso'";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":ofertaId" => $ofertaId
        ]);
        $solicitudesDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $solicitudes = [];
        foreach($solicitudesDB as $solicitud){
            $solicitudes[] = new Solicitud(
                $solicitud["id"],
                new DateTime($solicitud["fecha"]),
                $solicitud["estado"],
                $solicitud["alumno_user_id"],
                $solicitud["oferta_id"]
            );
        }

        return $solicitudes;
    }

}

?>