<?php

namespace PortalDeEmpleo2\Model;
use PortalDeEmpleo2\Repositories\RepoOferta;
use DateTime;

class Oferta{

    private int $id;
    private DateTime $fechaInicio;
    private DateTime $fechaFin;
    private string $descripcion;
    private int $empresaId;
    private array $ciclos;

    public function __construct(int $id, DateTime $fechaInicio, DateTime $fechaFin, string $descripcion, int $empresaId)
    {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->descripcion = $descripcion;
        $this->empresaId = $empresaId;
        $this->ciclos = RepoOferta::getCiclos($id);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFechaInicio(): DateTime {
        return $this->fechaInicio;
    }

    public function getFechaFin(): DateTime {
        return $this->fechaFin;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getEmpresaId(): int {
        return $this->empresaId;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function setFechaInicio(DateTime $fechaInicio): void {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFin(DateTime $fechaFin): void {
        $this->fechaFin = $fechaFin;
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setEmpresaId(int $empresaId): void {
        $this->empresaId = $empresaId;
    }

}

?>