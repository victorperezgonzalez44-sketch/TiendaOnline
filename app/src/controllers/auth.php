<?php

require_once __DIR__ . '/../models/usuario.php';

session_start();



function procesarRegistro($pdo)
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuario = obtenerPorEmail($pdo, $email);

        if ($usuario !== false) {

            $error = 'El email ya está registrado.';
            return ['error' => $error];

        } else {

            registrarUsuario($pdo, $nombre, $apellidos, $email, $password);
            return ['exito' => true];
        }

    }

}

function procesarLogin($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $usuario = obtenerPorEmail($pdo, $email);

        if ($usuario !== false) {



            if (password_verify($password, $usuario['password'])) {

                session_regenerate_id(true);
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                return ['exito' => true];

            } else {

                $error = 'Email o contraseña incorrectos';
                return ['error' => $error];

            }


        } else {

            $error = 'Email o contraseña incorrectos';
            return ['error' => $error];

        }

    }
}


?>