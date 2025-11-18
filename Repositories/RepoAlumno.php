<?php

namespace PortalDeEmpleo2\Repositories;
use PortalDeEmpleo2\Model\Alumno;
use PortalDeEmpleo2\Model\User;
use PortalDeEmpleo2\Model\Ciclo;
use PortalDeEmpleo2\Model\Solicitud;
use PortalDeEmpleo2\Model\Oferta;
use PortalDeEmpleo2\Helpers\Converted;
use DateTime;
use PDOException;

class RepoAlumno{

    public static function findAll(){
        $con = (new DB())->getConection();
        $sql = "SELECT *
                FROM alumno a 
                JOIN user u ON a.user_id = u.id";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $alumnosDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $alumnos = [];
        foreach($alumnosDB as $alumno){
            $alumnos[] = new Alumno(
                $alumno["id"],
                $alumno["correo"],
                $alumno["contrasena"],
                $alumno["rol"],
                $alumno["foto"],
                $alumno["nombre"],
                $alumno["apellidos"],
                $alumno["direccion"],
                $alumno["cv"]
            );
        }

        return $alumnos;

    }

    public static function findById($id){
        $con = (new DB())->getConection();
        $sql = "SELECT *
                FROM alumno a 
                JOIN user u ON a.user_id = u.id 
                WHERE u.id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $alumnoDB = $stmt->fetch(\PDO::FETCH_ASSOC);

        $alumno = null;
        if($alumnoDB){
            $alumno = new Alumno(
                $alumnoDB["id"],
                $alumnoDB["correo"],
                $alumnoDB["contrasena"],
                $alumnoDB["rol"],
                $alumnoDB["foto"],
                $alumnoDB["nombre"],
                $alumnoDB["apellidos"],
                $alumnoDB["direccion"],
                $alumnoDB["cv"]
            );
        }

        return $alumno;
    }

    public static function save(Alumno $alumno){
        try{
            $con = (new DB())->getConection();
            $con->beginTransaction();
            $resultado = true;

            $sqlUser = "INSERT INTO user (correo, contrasena, rol, foto) VALUES(:correo, :contrasena, :rol, :foto)";
            $stmtUser = $con->prepare($sqlUser);
            $resultadoUser = $stmtUser->execute([
                ":correo"       => $alumno->getCorreo(),
                ":contrasena"   => Converted::codificarPassw($alumno->getContrasena()),
                ":rol"          => $alumno->getRol(),
                ":foto"         => $alumno->getFoto()
            ]);

            if($resultadoUser){
                $alumno->setId((int)$con->lastInsertId());

                $sqlAlumno = "INSERT INTO alumno (user_id, nombre, apellidos, direccion, cv) 
                        VALUES(:user_id, :nombre, :apellidos, :direccion, :cv)";
                $stmtAlumno = $con->prepare($sqlAlumno);
                $resultadoAlumno = $stmtAlumno->execute([
                    ":user_id"      => $alumno->getId(),
                    ":nombre"       => $alumno->getNombre(),
                    ":apellidos"    => $alumno->getApellidos(),
                    ":direccion"    => $alumno->getDireccion(),
                    ":cv"           => $alumno->getCv()
                ]);

                if($resultadoAlumno){
                    $con->commit();
                } else {
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

    public static function update(Alumno $alumno){
        $con = (new DB())->getConection();
        $con->beginTransaction();

        $sqlUser = "UPDATE user SET correo = :correo, contrasena = :contrasena, rol = :rol, foto = :foto WHERE id = :id";
        $stmtUser = $con->prepare($sqlUser);
        $resultado = $stmtUser->execute([
            ":id"           => $alumno->getId(),
            ":correo"       => $alumno->getCorreo(),
            ":contrasena"   => $alumno->getContrasena(),
            ":rol"          => $alumno->getRol(),
            ":foto"         => $alumno->getFoto()
        ]);

        $sqlAlumno = "UPDATE alumno SET nombre = :nombre, apellidos = :apellidos, direccion = :direccion, cv = :cv WHERE user_id = :user_id";
        $stmtAlumno = $con->prepare($sqlAlumno);
        $resultado = $stmtAlumno->execute([
            ":user_id"      => $alumno->getId(),
            ":nombre"       => $alumno->getNombre(),
            ":apellidos"    => $alumno->getApellidos(),
            ":direccion"    => $alumno->getDireccion(),
            ":cv"           => $alumno->getCv()
        ]);

        if($resultado){
            $con->commit();
        } else {
            $con->rollBack();
        }

        return $resultado;
    }

    public static function delete($id){
        $con = (new DB())->getConection();
        $sql = "DELETE FROM alumno WHERE user_id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        
        return $stmt->rowCount() > 0;
    }

    public static function saveCiclo(Ciclo $ciclo, int $alumnoId){
        try {
            $con = (new DB())->getConection();

            $sqlCheck = "SELECT COUNT(*) FROM ciclo_has_alumno WHERE ciclo_id = :cicloId AND alumno_user_id = :alumnoId";
            $stmtCheck = $con->prepare($sqlCheck);
            $stmtCheck->execute([
                ':cicloId' => $ciclo->getId(),
                ':alumnoId' => $alumnoId
            ]);
            if ($stmtCheck->fetchColumn() > 0) {
                return false;
            }

            $sql = "INSERT INTO ciclo_has_alumno (ciclo_id, alumno_user_id, fechaInicio, fechaFin)
                    VALUES (:cicloId, :alumnoId, :fechaInicio, :fechaFin)";
            $stmt = $con->prepare($sql);
            $fechaInicio = $ciclo->getFechaInicio() ? $ciclo->getFechaInicio()->format('Y-m-d') : date('Y-m-d');
            $fechaFin = $ciclo->getFechaFin() ? $ciclo->getFechaFin()->format('Y-m-d') : null;
            $resultado = $stmt->execute([
                ':cicloId' => $ciclo->getId(),
                ':alumnoId' => $alumnoId,
                ':fechaInicio' => $fechaInicio,
                ':fechaFin' => $fechaFin
            ]);

        } catch (PDOException $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public static function getCiclos($alumnoId){
        $con = (new DB())->getConection();
        $sql = "SELECT c.id, c.nombre, c.nivel, c.familiaProfesional_id, cha.fechaInicio, cha.fechaFin
                FROM ciclo c
                JOIN ciclo_has_alumno cha ON c.id = cha.ciclo_id
                JOIN alumno a ON a.user_id = cha.alumno_user_id
                WHERE a.user_id = :alumnoId";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":alumnoId" => $alumnoId
        ]);
        $ciclosDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $ciclos = [];
        foreach($ciclosDB as $ciclo){
            $ciclos[] = new Ciclo(
                $ciclo["id"],
                $ciclo["nombre"],
                $ciclo["nivel"],
                $ciclo["familiaProfesional_id"],
                new DateTime($ciclo["fechaInicio"]),
                new DateTime($ciclo["fechaFin"])
            );
        }

        return $ciclos;
    }

    public static function getSolicitudes($alumnoId){
        $con = (new DB())->getConection();
        $sql = "SELECT *
                FROM solicitud
                WHERE alumno_user_id = :alumnoId";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":alumnoId" => $alumnoId
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

    public static function getOfertas($alumnoId){
        $con = (new DB())->getConection();
        $sql = "SELECT DISTINCT o.*
                FROM oferta o
                JOIN oferta_has_ciclo ohc ON o.id = ohc.oferta_id
                JOIN ciclo_has_alumno cha ON ohc.ciclo_id = cha.ciclo_id
                WHERE cha.alumno_user_id = :alumnoId
                AND o.fechaFin >= CURDATE()";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":alumnoId" => $alumnoId
        ]);
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

}
