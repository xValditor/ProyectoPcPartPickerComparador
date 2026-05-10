<?php

class GestorPDO {
    private $db;

    public function __construct() {
        $this->db = Connection::getInstance()->getConn();
    }

    public function listar() {
        $rtdo = $this->db->query("SELECT * FROM componentes");
        $arrayComponentes = [];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $arrayComponentes[] = $this->hidratar($value);
        }
        return $arrayComponentes;
    }

    public function buscar($id) {
        $stmt = $this->db->prepare("SELECT * FROM componentes WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$value) return null;
        return $this->hidratar($value);
    }

    public function listarNombresDistintos() {
        $rtdo = $this->db->query("SELECT DISTINCT nombre FROM componentes ORDER BY nombre ASC");
        return $rtdo->fetchAll(PDO::FETCH_COLUMN);
    }

    public function buscarPorNombre($nombre) {
        $stmt = $this->db->prepare("SELECT * FROM componentes WHERE nombre = :nombre ORDER BY fecha_registro ASC");
        $stmt->bindValue(':nombre', $nombre);
        $stmt->execute();
        $arrayComponentes = [];
        while ($value = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $arrayComponentes[] = $this->hidratar($value);
        }
        return $arrayComponentes;
    }

    public function agregar($componente) {
        try {
            if ($componente instanceof Procesador) {
                $sql = "INSERT INTO componentes 
                        (tipoComponente, nombre, fabricante, precio, consumo, anioLanzamiento, fecha_registro, nucleos, frecuencia, socket) 
                        VALUES (:tipo, :nombre, :fabricante, :precio, :consumo, :anio, :fecha, :nucleos, :frecuencia, :socket)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipo', 'Procesador');
                $stmt->bindValue(':nucleos', $componente->getNucleos());
                $stmt->bindValue(':frecuencia', $componente->getFrecuencia());
                $stmt->bindValue(':socket', $componente->getSocket());

            } elseif ($componente instanceof TarjetaGrafica) {
                $sql = "INSERT INTO componentes 
                        (tipoComponente, nombre, fabricante, precio, consumo, anioLanzamiento, fecha_registro, memoriaVRAM, velocidadMemoria, ensamblador) 
                        VALUES (:tipo, :nombre, :fabricante, :precio, :consumo, :anio, :fecha, :vram, :velocidad, :ensamblador)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipo', 'TarjetaGrafica');
                $stmt->bindValue(':vram', $componente->getMemoriaVRAM());
                $stmt->bindValue(':velocidad', $componente->getVelocidadMemoria());
                $stmt->bindValue(':ensamblador', $componente->getEnsamblador());

            } else {
                $sql = "INSERT INTO componentes 
                        (tipoComponente, nombre, fabricante, precio, consumo, anioLanzamiento, fecha_registro, capacidad, frecuencia, tipo, latencia) 
                        VALUES (:tipo, :nombre, :fabricante, :precio, :consumo, :anio, :fecha, :capacidad, :frecuencia, :tipoRam, :latencia)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':tipo', 'MemoriaRAM');
                $stmt->bindValue(':capacidad', $componente->getCapacidad());
                $stmt->bindValue(':frecuencia', $componente->getFrecuencia());
                $stmt->bindValue(':tipoRam', $componente->getTipo());
                $stmt->bindValue(':latencia', $componente->getLatencia());
            }

            $stmt->bindValue(':nombre', $componente->getNombre());
            $stmt->bindValue(':fabricante', $componente->getFabricante());
            $stmt->bindValue(':precio', $componente->getPrecio());
            $stmt->bindValue(':consumo', $componente->getConsumo());
            $stmt->bindValue(':anio', $componente->getAnioLanzamiento());
            $stmt->bindValue(':fecha', $componente->getFechaRegistro());
            return $stmt->execute();

        } catch (PDOException $e) {
            die("Error MySQL: " . $e->getMessage());
        }
    }

    public function actualizar($componente) {
        try {
            if ($componente instanceof Procesador) {
                $sql = "UPDATE componentes SET 
                        nombre=:nombre, fabricante=:fabricante, precio=:precio, consumo=:consumo,
                        anioLanzamiento=:anio, fecha_registro=:fecha,
                        nucleos=:nucleos, frecuencia=:frecuencia, socket=:socket
                        WHERE id=:id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':nucleos', $componente->getNucleos());
                $stmt->bindValue(':frecuencia', $componente->getFrecuencia());
                $stmt->bindValue(':socket', $componente->getSocket());

            } elseif ($componente instanceof TarjetaGrafica) {
                $sql = "UPDATE componentes SET 
                        nombre=:nombre, fabricante=:fabricante, precio=:precio, consumo=:consumo,
                        anioLanzamiento=:anio, fecha_registro=:fecha,
                        memoriaVRAM=:vram, velocidadMemoria=:velocidad, ensamblador=:ensamblador
                        WHERE id=:id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':vram', $componente->getMemoriaVRAM());
                $stmt->bindValue(':velocidad', $componente->getVelocidadMemoria());
                $stmt->bindValue(':ensamblador', $componente->getEnsamblador());

            } else {
                $sql = "UPDATE componentes SET 
                        nombre=:nombre, fabricante=:fabricante, precio=:precio, consumo=:consumo,
                        anioLanzamiento=:anio, fecha_registro=:fecha,
                        capacidad=:capacidad, frecuencia=:frecuencia, tipo=:tipoRam, latencia=:latencia
                        WHERE id=:id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':capacidad', $componente->getCapacidad());
                $stmt->bindValue(':frecuencia', $componente->getFrecuencia());
                $stmt->bindValue(':tipoRam', $componente->getTipo());
                $stmt->bindValue(':latencia', $componente->getLatencia());
            }

            $stmt->bindValue(':id', $componente->getId());
            $stmt->bindValue(':nombre', $componente->getNombre());
            $stmt->bindValue(':fabricante', $componente->getFabricante());
            $stmt->bindValue(':precio', $componente->getPrecio());
            $stmt->bindValue(':consumo', $componente->getConsumo());
            $stmt->bindValue(':anio', $componente->getAnioLanzamiento());
            $stmt->bindValue(':fecha', $componente->getFechaRegistro());
            return $stmt->execute();

        } catch (PDOException $e) {
            die("Error al actualizar: " . $e->getMessage());
        }
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM componentes WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    private function hidratar($value) {
        $fecha = $value['fecha_registro'] ?? null;
        if ($value['tipoComponente'] == 'Procesador') {
            return new Procesador(
                $value['nombre'], $value['fabricante'], $value['precio'],
                $value['consumo'], $value['anioLanzamiento'],
                $value['nucleos'], $value['frecuencia'], $value['socket'],
                $value['id'], $fecha
            );
        } elseif ($value['tipoComponente'] == 'TarjetaGrafica') {
            return new TarjetaGrafica(
                $value['nombre'], $value['fabricante'], $value['precio'],
                $value['consumo'], $value['anioLanzamiento'],
                $value['memoriaVRAM'], $value['velocidadMemoria'], $value['ensamblador'],
                $value['id'], $fecha
            );
        } else {
            return new MemoriaRAM(
                $value['nombre'], $value['fabricante'], $value['precio'],
                $value['consumo'], $value['anioLanzamiento'],
                $value['capacidad'], $value['frecuencia'], $value['tipo'], $value['latencia'],
                $value['id'], $fecha
            );
        }
    }

    public function registrarUsuario($usuario) {
        try {
            $sql = "INSERT INTO usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id'], $value['color_fondo']);
        }
        return false;
    }

    public function actualizarColorUsuario($userId, $color) {
        $stmt = $this->db->prepare("UPDATE usuario SET color_fondo = :color WHERE id = :id");
        $stmt->bindValue(':color', $color);
        $stmt->bindValue(':id', $userId);
        $stmt->execute();
    }
}