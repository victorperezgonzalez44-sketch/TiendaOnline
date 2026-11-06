<?php
function obtenerPorEmail($pdo, $email)
{
    $consultarUsuario = $pdo->prepare('SELECT id_usuario, nombre, apellidos, email, password, rol FROM usuarios WHERE usuarios.email = :email');
    $consultarUsuario->execute([':email' => $email]);

    $usuario = $consultarUsuario->fetch(PDO::FETCH_ASSOC);

    return $usuario;
}

function obtenerUsuarioPorID($pdo, $id_usuario)
{
    $consultarUsuario = $pdo->prepare(
        'SELECT id_usuario, nombre, apellidos, email
         FROM usuarios
         WHERE id_usuario = :id_usuario'
    );

    $consultarUsuario->execute([
        ':id_usuario' => $id_usuario
    ]);

    return $consultarUsuario->fetch(PDO::FETCH_ASSOC);
}

function registrarUsuario($pdo, $nombre, $apellidos, $email, $password)
{
    $registrarUsuario = $pdo->prepare('INSERT INTO usuarios(nombre, apellidos, email, password)
    VALUES (:nombre, :apellidos, :email, :password)
    ');
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $registrarUsuario->execute([':nombre' => $nombre, ':apellidos' => $apellidos, ':email' => $email, ':password' => $passwordHash]);
}

?>