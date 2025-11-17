<?php

namespace PortalDeEmpleo2\Model;
use DateTime;

class Ciclo{

    private int $id;
    private string $nombre;
    private string $nivel;
    private int $familiaId;
    private ?DateTime $fechaInicio;
    private ?DateTime $fechaFin;

    public function __construct(int $id, string $nombre, string $nivel, int $familiaId, ?DateTime $fechaInicio = null, ?DateTime $fechaFin = null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->familiaId = $familiaId;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getNivel(): string {
        return $this->nivel;
    }

    public function getFamiliaId(): int {
        return $this->familiaId;
    }

    public function getFechaInicio(): DateTime {
        return $this->fechaInicio;
    }

    public function getFechaFin(): DateTime {
        return $this->fechaFin;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setNivel(string $nivel): void {
        $this->nivel = $nivel;
    }

    public function setFamiliaId(int $familiaId): void {
        $this->familiaId = $familiaId;
    }

    public function setFechaInicio(DateTime $fechaInicio): void {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFin(DateTime $fechaFin): void {
        $this->fechaFin = $fechaFin;
    }

}

?>