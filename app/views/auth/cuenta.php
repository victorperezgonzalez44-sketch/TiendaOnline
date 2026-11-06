<section class="cuenta-section">

    <h1>Mi perfil</h1>
    <p>Consulta los datos de tu cuenta Kayrox.</p>

    <div class="cuenta-datos">

        <div>
            <span>Nombre</span>
            <p><?= escapar($usuario['nombre']) ?></p>
        </div>

        <div>
            <span>Apellidos</span>
            <p><?= escapar($usuario['apellidos']) ?></p>
        </div>

        <div>
            <span>Correo electrónico</span>
            <p><?= escapar($usuario['email']) ?></p>
        </div>

    </div>

</section>