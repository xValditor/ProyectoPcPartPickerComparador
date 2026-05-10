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
            $fechaRegistro = $_POST['fechaRegistro'] ?: null;

            if ($tipo == 'Procesador') {
                $componente = new Procesador(
                    $nombre, $fabricante, $precio, $consumo, $anioLanzamiento,
                    $_POST['nucleos'], $_POST['frecuencia'], $_POST['socket'], 0, $fechaRegistro
                );
            } elseif ($tipo == 'TarjetaGrafica') {
                $componente = new TarjetaGrafica(
                    $nombre, $fabricante, $precio, $consumo, $anioLanzamiento,
                    $_POST['memoriaVRAM'], $_POST['velocidadMemoria'], $_POST['ensamblador'], 0, $fechaRegistro
                );
            } else {
                $componente = new MemoriaRAM(
                    $nombre, $fabricante, $precio, $consumo, $anioLanzamiento,
                    $_POST['capacidad'], $_POST['frecuenciaRam'], $_POST['tipoRam'], $_POST['latencia'], 0, $fechaRegistro
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
            $componente->setFechaRegistro($_POST['fechaRegistro'] ?: null);

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

    public function comparar() {
        $nombre   = $_GET['nombre'] ?? null;
        $id1      = $_GET['id1'] ?? null;
        $id2      = $_GET['id2'] ?? null;
        $nombres  = $this->gestor->listarNombresDistintos();
        $registros = $nombre ? $this->gestor->buscarPorNombre($nombre) : [];
        $resultado = null;
        $error     = null;

        if ($id1 && $id2) {
            if ($id1 === $id2) {
                $error = "Debes seleccionar dos registros distintos.";
            } else {
                $c1 = $this->gestor->buscar($id1);
                $c2 = $this->gestor->buscar($id2);
                if ($c1 && $c2) {
                    $diff = $c2->getPrecio() - $c1->getPrecio();
                    $pct  = $c1->getPrecio() != 0 ? ($diff / $c1->getPrecio()) * 100 : 0;
                    $resultado = [
                        'c1'   => $c1,
                        'c2'   => $c2,
                        'diff' => $diff,
                        'pct'  => $pct
                    ];
                }
            }
        }

        include "views/comparar.php";
    }
}
