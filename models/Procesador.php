<?php

class Procesador extends Componente {
    private $nucleos;
    private $frecuencia;
    private $socket;

    public function __construct($nombre, $fabricante, $precio, $consumo, $anioLanzamiento, $nucleos, $frecuencia, $socket, $id = 0) {
        parent::__construct($id, $nombre, $fabricante, $precio, $consumo, $anioLanzamiento);
        $this->nucleos = $nucleos;
        $this->frecuencia = $frecuencia;
        $this->socket = $socket;
    }

    public function getNucleos() {
        return $this->nucleos;
    }

    public function setNucleos($nucleos): self {
        $this->nucleos = $nucleos;
        return $this;
    }

    public function getFrecuencia() {
        return $this->frecuencia;
    }

    public function setFrecuencia($frecuencia): self {
        $this->frecuencia = $frecuencia;
        return $this;
    }

    public function getSocket() {
        return $this->socket;
    }

    public function setSocket($socket): self {
        $this->socket = $socket;
        return $this;
    }
}