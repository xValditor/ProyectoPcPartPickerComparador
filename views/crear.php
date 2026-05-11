<?php include 'header.php'; ?>

<main>
    <h2>Añadir Componente</h2>

    <form method="POST">
        <label>Tipo:</label>
        <select name="tipo" required>
            <option value="Procesador">Procesador</option>
            <option value="TarjetaGrafica">Tarjeta Gráfica</option>
            <option value="MemoriaRAM">Memoria RAM</option>
        </select>

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Fabricante:</label>
        <input type="text" name="fabricante" required>

        <label>Precio (€):</label>
        <input type="number" step="0.01" name="precio" required>

        <label>Consumo (W):</label>
        <input type="number" name="consumo" required>

        <label>Año de lanzamiento:</label>
        <input type="number" name="anioLanzamiento" required>

        <label>Fecha de registro:</label>
        <input type="date" name="fechaRegistro">

        <label>Núcleos (Procesador):</label>
        <input type="number" name="nucleos">

        <label>Frecuencia GHz (Procesador):</label>
        <input type="number" step="0.01" name="frecuencia">

        <label>Socket (Procesador):</label>
        <input type="text" name="socket">

        <label>Memoria VRAM GB (GPU):</label>
        <input type="number" name="memoriaVRAM">

        <label>Velocidad Memoria MHz (GPU):</label>
        <input type="number" name="velocidadMemoria">

        <label>Ensamblador (GPU):</label>
        <input type="text" name="ensamblador">

        <label>Capacidad GB (RAM):</label>
        <input type="number" name="capacidad">

        <label>Frecuencia MHz (RAM):</label>
        <input type="number" name="frecuenciaRam">

        <label>Tipo DDR (RAM):</label>
        <input type="text" name="tipoRam">

        <label>Latencia CL (RAM):</label>
        <input type="number" name="latencia">

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="/ProyectoPcPartPickerComparador/index.php">← Volver</a>
</main>

<?php include 'footer.php'; ?>
