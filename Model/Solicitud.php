<?php

namespace PortalDeEmpleo2\Model;
use DateTime;

class Solicitud{

    private int $id;
    private DateTime $fecha;
    private string $estado;
    private int $alumnoId;
    private int $ofertaId;

    public function __construct(int $id, DateTime $fecha, string $estado, int $alumnoId, int $ofertaId)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->alumnoId = $alumnoId;
        $this->ofertaId = $ofertaId;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFecha(): DateTime {
        return $this->fecha;
    }

    public function getEstado(): string {
        return $this->estado;
    }

    public function getAlumnoId(): int {
        return $this->alumnoId;
    }

    public function getOfertaId(): int {
        return $this->ofertaId;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
    
    public function setFecha(DateTime $fecha): void {
        $this->fecha = $fecha;
    }

    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }

    public function setAlumnoId(int $alumnoId): void {
        $this->alumnoId = $alumnoId;
    }

    public function setOfertaId(int $ofertaId): void {
        $this->ofertaId = $ofertaId;
    }
    
}

?>