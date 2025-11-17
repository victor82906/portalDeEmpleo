<?php

namespace PortalDeEmpleo2\Repositories;
use PortalDeEmpleo2\Model\FamiliaProfesional;

class RepoFamiliaProfesional{

    public static function findAll(){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM familiaProfesional";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $familiasDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $familias = [];
        foreach($familiasDB as $familia){
            $familias[] = new FamiliaProfesional(
                $familia["id"],
                $familia["nombre"]
            );
        }

        return $familias;
    }

    public static function findById($id){
        $con = (new DB())->getConection();
        $sql = "SELECT * 
                FROM familiaProfesional 
                WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $familiaDB = $stmt->fetch(\PDO::FETCH_ASSOC);

        $familia = null;
        if($familiaDB){
            $familia = new FamiliaProfesional(
                $familiaDB["id"],
                $familiaDB["nombre"]
            );
        }

        return $familia;
    }

    public static function save(FamiliaProfesional $familia){
        $con = (new DB())->getConection();
        $sql = "INSERT INTO familiaProfesional (nombre) 
                VALUES(:nombre)";
        $stmt = $con->prepare($sql);
        $resultado = $stmt->execute([
            ":nombre"   => $familia->getNombre()
        ]);

        if($resultado){
            //casteo a int
            $familia->setId((int)$con->lastInsertId());
        }

        return $resultado;
    }

    public static function update(FamiliaProfesional $familia){
        $con = (new DB())->getConection();
        $sql = "UPDATE familiaProfesional 
                SET nombre = :nombre 
                WHERE id = :id";
        $stmt = $con->prepare($sql);
        $resultado = $stmt->execute([
            ":nombre"   => $familia->getNombre(),
            ":id"       => $familia->getId()
        ]);

        return $resultado;
    }

    public static function delete($id){
        $con = (new DB())->getConection();
        $sql = "DELETE FROM familiaProfesional WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->rowCount() > 0;
    }

}

?>