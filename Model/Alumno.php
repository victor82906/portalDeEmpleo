<?php

namespace PortalDeEmpleo2\Model;
use PortalDeEmpleo2\Repositories\RepoAlumno;

class Alumno extends User{

    private string $nombre;
    private string $apellidos;
    private string $direccion;
    private array $ciclos;
    private array $solicitudes;
    private string $cv;

    public function __construct(int $id, string $correo, string $contrasena, string $rol, string $foto, string $nombre, string $apellidos, string $direccion, ?string $cv = null) {
        parent::__construct($id, $correo, $contrasena, $rol, $foto);
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->direccion = $direccion;
        $this->ciclos = RepoAlumno::getCiclos($id);
        $this->ciclos = RepoAlumno::getSolicitudes($id);
        $this->cv = $cv ?? "";
    }

    // Getters 
    public function getNombre(): string {
        return $this->nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function getDireccion(): string {
        return $this->direccion;
    }

    public function getCiclos(): array {
        return RepoAlumno::getCiclos($this->getId());
    }

    public function getSolicitudes(): array {
        return RepoAlumno::getSolicitudes($this->getId());
    }

    public function getCv(): string {
        return $this->cv;
    }


    // Setters
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setDireccion(string $direccion): void {
        $this->direccion = $direccion;
    }

    public function setCiclos(array $ciclos): void {
        $this->ciclos = $ciclos;
    }

    public function setSolicitudes(array $solicitudes): void {
        $this->solicitudes = $solicitudes;
    }

    public function setCv(string $cv): void {
        $this->cv = $cv;
    }

}

?>