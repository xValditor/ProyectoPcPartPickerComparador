<?php

class Componente {
    protected $id;
    protected $nombre;
    protected $fabricante;
    protected $precio;
    protected $consumo;
    protected $anioLanzamiento;

    public function __construct($id, $nombre, $fabricante, $precio, $consumo, $anioLanzamiento) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fabricante = $fabricante;
        $this->precio = $precio;
        $this->consumo = $consumo;
        $this->anioLanzamiento = $anioLanzamiento;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFabricante() {
        return $this->fabricante;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getConsumo() {
        return $this->consumo;
    }

    public function getAnioLanzamiento() {
        return $this->anioLanzamiento;
    }

    public function setNombre($nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    public function setFabricante($fabricante): self {
        $this->fabricante = $fabricante;
        return $this;
    }

    public function setPrecio($precio): self {
        $this->precio = $precio;
        return $this;
    }

    public function setConsumo($consumo): self {
        $this->consumo = $consumo;
        return $this;
    }

    public function setAnioLanzamiento($anioLanzamiento): self {
        $this->anioLanzamiento = $anioLanzamiento;
        return $this;
    }
}