<?php

namespace PortalDeEmpleo2\Repositories;
use PortalDeEmpleo2\Model\Solicitud;
use PDOException;

class RepoSolicitud{

    public static function findAll(){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM solicitud";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $solicitudesDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $solicitudes = [];
        foreach($solicitudesDB as $solicitud){
            $solicitudes[] = new Solicitud(
                $solicitud["id"],
                new \DateTime($solicitud["fecha"]),
                $solicitud["estado"],
                $solicitud["alumno_user_id"],
                $solicitud["oferta_id"]
            );
        }

        return $solicitudes;

    }

    public static function findById($id){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM solicitud WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $solicitudDB = $stmt->fetch(\PDO::FETCH_ASSOC);

        $solicitud = null;
        if($solicitudDB){
            $solicitud = new Solicitud(
                $solicitudDB["id"],
                new \DateTime($solicitudDB["fecha"]),
                $solicitudDB["estado"],
                $solicitudDB["alumno_user_id"],
                $solicitudDB["oferta_id"]
            );
        }

        return $solicitud;
    }

    public static function save(Solicitud $solicitud){
        try{
            $con = (new DB())->getConection();

            $sqlCheck = "SELECT COUNT(*) 
                        FROM solicitud 
                        WHERE alumno_user_id = :alumnoId
                        AND oferta_id = :ofertaId";
            $stmtCheck = $con->prepare($sqlCheck);
            $stmtCheck->execute([
                ':alumnoId' => $solicitud->getAlumnoId(),
                ':ofertaId' => $solicitud->getOfertaId()
            ]);

            if ($stmtCheck->fetchColumn() > 0) {
                return false;
            }

            $sql = "INSERT INTO solicitud (fecha, estado, alumno_user_id, oferta_id) VALUES(:fecha, :estado, :alumnoId, :ofertaId)";
            $stmt = $con->prepare($sql);
            $fechaStr = $solicitud->getFecha()->format('Y-m-d H:i:s');
            $resultado = $stmt->execute([
                ":fecha"    => $fechaStr,
                ":estado"   => $solicitud->getEstado(),
                ":alumnoId" => $solicitud->getAlumnoId(),
                ":ofertaId" => $solicitud->getOfertaId()
            ]);

            if($resultado){
                $solicitud->setId((int)$con->lastInsertId());
            }

        }catch(PDOException $e) {
            $resultado = false;
        }

        return $resultado;
    }

    public static function update(Solicitud $solicitud){
        $con = (new DB())->getConection();
        $sql = "UPDATE solicitud SET fecha = :fecha, estado = :estado, alumno_user_id = :alumnoId, oferta_id = :ofertaId WHERE id = :id";
        $stmt = $con->prepare($sql);
        $fechaStr = $solicitud->getFecha()->format('Y-m-d H:i:s');
        $resultado = $stmt->execute([
            ":fecha"    => $fechaStr,
            ":estado"   => $solicitud->getEstado(),
            ":alumnoId" => $solicitud->getAlumnoId(),
            ":ofertaId" => $solicitud->getOfertaId(),
            ":id"       => $solicitud->getId()
        ]);

        return $resultado;
    }

    public static function delete($id){
        $con = (new DB())->getConection();
        $sql = "DELETE FROM solicitud WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->rowCount() > 0;
    }

}

?>