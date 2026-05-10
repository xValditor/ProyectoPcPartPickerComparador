<?php

class MemoriaRAM extends Componente {
    private $capacidad;
    private $frecuencia;
    private $tipo;
    private $latencia;

    public function __construct($nombre, $fabricante, $precio, $consumo, $anioLanzamiento, $capacidad, $frecuencia, $tipo, $latencia, $id = 0, $fechaRegistro = null) {
        parent::__construct($id, $nombre, $fabricante, $precio, $consumo, $anioLanzamiento, $fechaRegistro);
        $this->capacidad = $capacidad;
        $this->frecuencia = $frecuencia;
        $this->tipo = $tipo;
        $this->latencia = $latencia;
    }

    public function getCapacidad() { return $this->capacidad; }
    public function setCapacidad($capacidad): self { $this->capacidad = $capacidad; return $this; }
    public function getFrecuencia() { return $this->frecuencia; }
    public function setFrecuencia($frecuencia): self { $this->frecuencia = $frecuencia; return $this; }
    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo): self { $this->tipo = $tipo; return $this; }
    public function getLatencia() { return $this->latencia; }
    public function setLatencia($latencia): self { $this->latencia = $latencia; return $this; }
}
