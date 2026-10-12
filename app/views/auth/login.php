<?php if (isset($resultado['error'])): ?>

    <p><?= $resultado['error'] ?></p>

<?php endif ?>

<?php if (isset($resultado['exito'])): ?>

    <p>Inicio de sesión correcto</p>

<?php else: ?>

    <form method="POST">
        <div>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label for="password">Contraseña: </label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>

<?php endif ?>