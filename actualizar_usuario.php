<?php

if (isset($_POST)) {

// Conexión a la base de datos:
require_once 'includes/conexion.php';

// Recoger los valores del formulario de actualizacion:

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

    // Array de errores:
    $errores = array();

    // Validar los datos antes de guardarlos en la base de datos:

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es válido';
    }

    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = 'Los apellidos no son válidos';
    }

    if (!empty($email) && filter_var($email)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = 'El email no es válido';
    }

    $guardar_usuario = false;

    if (count($errores) == 0) {
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;

        //Comprobar si el email ya existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if($isset_user['id'] == $usuario['id'] || empty($isset_user)) {

            $sql = "UPDATE usuarios SET ".
                    "nombre = '$nombre', ".
                    "apellidos = '$apellidos', ".
                    "email = '$email' ".
                    "WHERE id = ".$usuario['id'];
            $guardar = mysqli_query($db, $sql);

            if ($guardar) {
                $_SESSION['usuario'] ['nombre'] = $nombre;
                $_SESSION['usuario'] ['apellidos'] = $apellidos;
                $_SESSION['usuario'] ['email'] = $email;
                $_SESSION['completado'] = 'Tus datos se han actualizado con éxito';
            } else {
                $_SESSION['errores'] ['general'] = 'Fallo al actualizar tus datos!!';
            }
        } else {
            $_SESSION['errores'] ['general'] = 'El email ya existe!!';
        }

    } else {
        $_SESSION['errores'] = $errores;
    }

}

header('Location: mis_datos.php');
?>
