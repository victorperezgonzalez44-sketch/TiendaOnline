<?php if (isset($resultado['error'])): ?>

    <p><?= $resultado['error'] ?></p>

<?php endif ?>

<?php if (isset($resultado['exito'])): ?>

    <p>Usuario registrado correctamente.</p>

<?php else: ?>

    <form method="POST">
        <div>
            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div>
            <label for="apellidos">Apellidos: </label>
            <input type="text" id="apellidos" name="apellidos">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="password">Contraseña: </label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Registrarse</button>
    </form>

<?php endif ?>