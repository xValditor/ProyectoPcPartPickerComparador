<?php

class ComponenteController {
    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $componentes = $this->gestor->listar();
        include "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'];
            $nombre = $_POST['nombre'];
            $fabricante = $_POST['fabricante'];
            $precio = $_POST['precio'];
            $consumo = $_POST['consumo'];
            $anioLanzamiento = $_POST['anioLanzamiento'];

            if ($tipo == 'Procesador') {
                $componente = new Procesador(
                    $nombre, $fabricante, $precio, $consumo, $anioLanzamiento,
                    $_POST['nucleos'],
                    $_POST['frecuencia'],
                    $_POST['socket']
                );
            } elseif ($tipo == 'TarjetaGrafica') {
                $componente = new TarjetaGrafica(
                    $nombre, $fabricante, $precio, $consumo, $anioLanzamiento,
                    $_POST['memoriaVRAM'],
                    $_POST['velocidadMemoria'],
                    $_POST['ensamblador']
                );
            } else {
                $componente = new MemoriaRAM(
                    $nombre, $fabricante, $precio, $consumo, $anioLanzamiento,
                    $_POST['capacidad'],
                    $_POST['frecuenciaRam'],
                    $_POST['tipoRam'],
                    $_POST['latencia']
    );
}

            $this->gestor->agregar($componente);
            header("Location: index.php");
            exit;
        }

        include "views/crear.php";
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        $componente = $this->gestor->buscar($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $componente->setNombre($_POST['nombre']);
            $componente->setFabricante($_POST['fabricante']);
            $componente->setPrecio($_POST['precio']);
            $componente->setConsumo($_POST['consumo']);
            $componente->setAnioLanzamiento($_POST['anioLanzamiento']);

            if ($componente instanceof Procesador) {
                $componente->setNucleos($_POST['nucleos']);
                $componente->setFrecuencia($_POST['frecuencia']);
                $componente->setSocket($_POST['socket']);
            } elseif ($componente instanceof TarjetaGrafica) {
                $componente->setMemoriaVRAM($_POST['memoriaVRAM']);
                $componente->setVelocidadMemoria($_POST['velocidadMemoria']);
                $componente->setEnsamblador($_POST['ensamblador']);
            } else {
                $componente->setCapacidad($_POST['capacidad']);
                $componente->setFrecuencia($_POST['frecuenciaRam']);
                $componente->setTipo($_POST['tipoRam']);
                $componente->setLatencia($_POST['latencia']);
            }

            $this->gestor->actualizar($componente);
            header("Location: index.php");
            exit;
        }

        include "views/editar.php";
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        $this->gestor->eliminar($id);
        header("Location: index.php");
        exit;
    }
}