<?php

namespace PortalDeEmpleo2\Model;
use PortalDeEmpleo2\Repositories\RepoEmpresa;

class Empresa extends User{
    
    private string $nombre;
    private int $telefono;
    private string $direccion;
    private string $descripcion;
    private string $personaContacto;
    private int $numPersonaContacto;
    private bool $activa;
    private array $ofertas;

    public function __construct(int $id, string $correo, string $contrasena, string $rol, string $foto, string $nombre, int $telefono, string $direccion, string $descripcion, string $personaContacto, int $numPersonaContacto, bool $activa
    ) {
        parent::__construct($id, $correo, $contrasena, $rol, $foto);
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->descripcion = $descripcion;
        $this->personaContacto = $personaContacto;
        $this->numPersonaContacto = $numPersonaContacto;
        $this->activa = $activa;
        $this->ofertas = RepoEmpresa::getOfertas($id);
    }

    // Getters
    public function getNombre(): string {
        return $this->nombre;
    }

    public function getTelefono(): int {
        return $this->telefono;
    }

    public function getDireccion(): string {
        return $this->direccion;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getPersonaContacto(): string {
        return $this->personaContacto;
    }

    public function getNumPersonaContacto(): int {
        return $this->numPersonaContacto;
    }

    public function isActiva(): bool {
        return $this->activa;
    }

    public function getOfertas(): array {
        return $this->ofertas;
    }

    // Setters
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setTelefono(int $telefono): void {
        $this->telefono = $telefono;
    }

    public function setDireccion(string $direccion): void {
        $this->direccion = $direccion;
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setPersonaContacto(string $personaContacto): void {
        $this->personaContacto = $personaContacto;
    }

    public function setNumPersonaContacto(int $numPersonaContacto): void {
        $this->numPersonaContacto = $numPersonaContacto;
    }

    public function setActiva(bool $activa): void {
        $this->activa = $activa;
    }

    public function setOfertas(array $ofertas): void {
        $this->ofertas = $ofertas;
    }

}

?>