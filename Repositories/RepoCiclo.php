<?php

namespace PortalDeEmpleo2\Repositories;
use PortalDeEmpleo2\Model\Ciclo;

class RepoCiclo{

    public static function findAll(){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM ciclo";
        $stmt = $con->prepare($sql);
        $stmt->execute();
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

    public static function findAllByFamilia($familiaId){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM ciclo WHERE familiaProfesional_id = :familiaId";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":familiaId" => $familiaId
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

    public static function findById($id){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM ciclo WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $cicloDB = $stmt->fetch(\PDO::FETCH_ASSOC);

        $ciclo = null;
        if($cicloDB){
            $ciclo = new Ciclo(
                $cicloDB["id"],
                $cicloDB["nombre"],
                $cicloDB["nivel"],
                $cicloDB["familiaProfesional_id"]
            );
        }

        return $ciclo;
    }

    public static function save(Ciclo $ciclo){
        $con = (new DB())->getConection();
        $sql = "INSERT INTO ciclo (nombre, nivel, familiaProfesional_id) VALUES(:nombre, :nivel, :familia)";
        $stmt = $con->prepare($sql);
        $resultado = $stmt->execute([
            ":nombre" => $ciclo->getNombre(),
            ":nivel" => $ciclo->getNivel(),
            ":familia" => $ciclo->getFamiliaId()
        ]);

        if($resultado){
            //casteo a int
            $ciclo->setId((int)$con->lastInsertId());
        }
    }

    public static function update(Ciclo $ciclo){
        $con = (new DB())->getConection();
        $sql = "UPDATE ciclo SET nombre = :nombre, nivel = :nivel, familiaProfesional_id = :familiaId WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id"        => $ciclo->getId(),
            ":nombre"    => $ciclo->getNombre(),
            ":nivel"     => $ciclo->getNivel(),
            ":familiaId" => $ciclo->getFamiliaId()
        ]);
    }

    public static function delete(int $id){
        $con = (new DB())->getConection();
        $sql = "DELETE FROM ciclo WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->rowCount() > 0;
    }

}

?>