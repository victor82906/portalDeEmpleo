<?php

namespace PortalDeEmpleo2\Repositories;
use PortalDeEmpleo2\Model\User;
use PortalDeEmpleo2\Helpers\Converted;

class RepoUser{

    public static function findAll(){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM user";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $usersDB = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $users = [];
        foreach($usersDB as $user){
            $users[] = new User(
                $user["id"],
                $user["correo"],
                $user["contrasena"],
                $user["rol"],
                $user["foto"]
            );
        }

        // sin foreach, for normal
        // for($i=0; $i<count($usersDB); $i++){
        //     $users[] = new User($usersDB[$i]["id"],$usersDB[$i]["correo"],$usersDB[$i]["contraseña"],$usersDB[$i]["rol"]);
        // }

        return $users;
    }

    public static function findByCorreo($correo){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM user WHERE correo = :correo";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":correo" => $correo
        ]);
        $userDB = $stmt->fetch(\PDO::FETCH_ASSOC);

        $user = null;
        if($userDB){
            $user = new User(
                $userDB["id"],
                $userDB["correo"],
                $userDB["contrasena"],
                $userDB["rol"],
                $userDB["foto"]
            );
        }

        return $user;
    }

    public static function findById($id){
        $con = (new DB())->getConection();
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);
        $userDB = $stmt->fetch(\PDO::FETCH_ASSOC);

        $user = null;
        if($userDB){
            $user = new User(
                $userDB["id"],
                $userDB["correo"],
                $userDB["contrasena"],
                $userDB["rol"],
                $userDB["foto"]
            );
        }

        return $user;
    }

    public static function save(User $user){
        $con = (new DB())->getConection();
        $sql = "INSERT INTO user (correo, contrasena, rol, foto) VALUES(:correo, :contrasena, :rol, :foto)";
        $stmt = $con->prepare($sql);
        // $stmt->bindParam(":correo", Converted::codificarPassw($user->getCorreo()), \PDO::PARAM_STR);
        // $stmt->bindParam(":contrasena", $user->getContrasena(), \PDO::PARAM_STR);
        // $stmt->bindParam(":rol", $user->getRol(), \PDO::PARAM_STR);
        // $stmt->bindParam(":foto", $user->getFoto(), \PDO::PARAM_STR);
        $resultado = $stmt->execute([
            ":correo"       => $user->getCorreo(),
            ":contrasena"   => Converted::codificarPassw($user->getContrasena()),
            ":rol"          => $user->getRol(),
            ":foto"         => $user->getFoto()
        ]);

        if($resultado){
            //casteo a int
            $user->setId((int)$con->lastInsertId());
        }

        return $resultado;
    }

    public static function update(User $user){
        $con = (new DB())->getConection();
        $sql = "UPDATE user SET correo = :correo, contrasena = :contrasena, rol = :rol, foto = :foto WHERE id = :id";
        $stmt = $con->prepare($sql);
        $resultado = $stmt->execute([
            ":id"           => $user->getId(),
            ":correo"       => $user->getCorreo(),
            ":contrasena"   => Converted::codificarPassw($user->getContrasena()),
            ":rol"          => $user->getRol(),
            ":foto"         => $user->getFoto()
        ]);

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
}

?>