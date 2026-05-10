<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Componente</title>
</head>
<?php $colorFondo = $_COOKIE['color_fondo'] ?? '#ffffff'; ?>
<body style="background-color: <?= $colorFondo ?>">
    <h1>Añadir Componente</h1>

    <form method="POST">
        Tipo:<br>
        <select name="tipo" required>
            <option value="Procesador">Procesador</option>
            <option value="TarjetaGrafica">Tarjeta Gráfica</option>
            <option value="MemoriaRAM">Memoria RAM</option>
        </select><br><br>

        Nombre:<br>
        <input type="text" name="nombre" required><br><br>

        Fabricante:<br>
        <input type="text" name="fabricante" required><br><br>

        Precio (€):<br>
        <input type="number" step="0.01" name="precio" required><br><br>

        Consumo (W):<br>
        <input type="number" name="consumo" required><br><br>

        Año de lanzamiento:<br>
        <input type="number" name="anioLanzamiento" required><br><br>

        <!-- Campos específicos Procesador -->
        Núcleos:<br>
        <input type="number" name="nucleos"><br><br>

        Frecuencia (GHz):<br>
        <input type="number" step="0.01" name="frecuencia"><br><br>

        Socket:<br>
        <input type="text" name="socket"><br><br>

        <!-- Campos específicos Tarjeta Gráfica -->
        Memoria VRAM (GB):<br>
        <input type="number" name="memoriaVRAM"><br><br>

        Velocidad Memoria (MHz):<br>
        <input type="number" name="velocidadMemoria"><br><br>

        Ensamblador:<br>
        <input type="text" name="ensamblador"><br><br>

        <!-- Campos específicos Memoria RAM -->
        Capacidad (GB):<br>
        <input type="number" name="capacidad"><br><br>

        Frecuencia RAM (MHz):<br>
        <input type="number" name="frecuenciaRam"><br><br>

        Tipo (DDR4/DDR5):<br>
        <input type="text" name="tipoRam"><br><br>

Latencia (CL):<br>
<input type="number" name="latencia"><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="index.php">Volver</a>
</body>
</html>