<?php

class TarjetaGrafica extends Componente {
    private $memoriaVRAM;
    private $velocidadMemoria;
    private $ensamblador;

    public function __construct($nombre, $fabricante, $precio, $consumo, $anioLanzamiento, $memoriaVRAM, $velocidadMemoria, $ensamblador, $id = 0, $fechaRegistro = null) {
        parent::__construct($id, $nombre, $fabricante, $precio, $consumo, $anioLanzamiento, $fechaRegistro);
        $this->memoriaVRAM = $memoriaVRAM;
        $this->velocidadMemoria = $velocidadMemoria;
        $this->ensamblador = $ensamblador;
    }

    public function getMemoriaVRAM() { return $this->memoriaVRAM; }
    public function setMemoriaVRAM($memoriaVRAM): self { $this->memoriaVRAM = $memoriaVRAM; return $this; }
    public function getVelocidadMemoria() { return $this->velocidadMemoria; }
    public function setVelocidadMemoria($velocidadMemoria): self { $this->velocidadMemoria = $velocidadMemoria; return $this; }
    public function getEnsamblador() { return $this->ensamblador; }
    public function setEnsamblador($ensamblador): self { $this->ensamblador = $ensamblador; return $this; }
}
