<?php include 'header.php'; ?>

<main>
    <h2>Iniciar Sesión</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required minlength="6">

        <label>
            <input type="checkbox" name="recordarme"> Recordarme en este equipo
        </label>

        <button type="submit">Entrar</button>
    </form>

    <br>
    <p>¿No tienes cuenta? <a href="/ProyectoPcPartPickerComparador/index.php?accion=alta">Regístrate aquí</a></p>
    <a href="/ProyectoPcPartPickerComparador/index.php">← Volver al inicio</a>
</main>

<?php include 'footer.php'; ?>
