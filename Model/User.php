<?php

namespace PortalDeEmpleo2\Model;

class User{
    
    private int $id;
    private string $correo;
    private string $contrasena;
    private string $rol;
    private string $foto;

    public function __construct(int $id, string $correo, string $contrasena, string $rol, string $foto) {
        $this->id = $id;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
        $this->rol = $rol;
        $this->foto = $foto ?: "/portalDeEmpleo2/fotosPerfil/default.png";
    }
    
    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getCorreo(): string {
        return $this->correo;
    }

    public function getContrasena(): string {
        return $this->contrasena;
    }

    public function getRol(): string {
        return $this->rol;
    }

    public function getFoto(): string {
        return $this->foto;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setCorreo(string $correo): void {
        $this->correo = $correo;
    }

    public function setContrasena(string $contrasena): void {
        $this->contrasena = $contrasena;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }

    public function setFoto(string $foto): void {
        $this->foto = $foto;
    }

}

?>