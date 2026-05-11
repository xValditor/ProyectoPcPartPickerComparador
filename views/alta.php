<?php include 'header.php'; ?>

<main>
    <h2>Crear nueva cuenta</h2>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required minlength="6">

        <button type="submit">Registrarse</button>
    </form>

    <br>
    <p>¿Ya tienes cuenta? <a href="/ProyectoPcPartPickerComparador/index.php?accion=login">Inicia sesión aquí</a></p>
    <a href="/ProyectoPcPartPickerComparador/index.php">← Volver al inicio</a>
</main>

<?php include 'footer.php'; ?>
