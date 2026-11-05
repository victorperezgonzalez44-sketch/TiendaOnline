<main class="site-main">
    <div class="login-container">
        
        <?php if (isset($resultado['error'])): ?>
            <div class="alerta alerta-error">
                <?= htmlspecialchars($resultado['error']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($resultado['exito'])): ?>
            <div class="alerta alerta-exito">
                Inicio de sesión correcto
            </div>
        <?php else: ?>
            <form class="login-form" method="POST">
                <h2>Iniciar Sesión</h2>
                
                <div class="producto-campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required autocomplete="email">
                </div>

                <div class="producto-campo">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>

                <button type="submit" class="producto-boton">
                    <span>Iniciar sesión</span>
                </button>
            </form>
        <?php endif; ?>

    </div>
</main>