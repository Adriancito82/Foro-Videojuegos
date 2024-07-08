<?php
// Iniciar la sesión y la conexión a db
require_once 'includes/conexion.php';

// Recoger datos de formulario:
if (isset($_POST)) {
     // Esta parte la tuve que omitir porque me daba fallo, al quitarlo funciona bien.
           /* if (isset( $_SESSION['error_login'])) {
                session_unset($_SESSION['error_login']);
            }*/

    $email = trim($_POST['email']);
    $password = $_POST['password'];

// Consulta para comprobar las credenciales del usuario:
    $sql = "select * from usuarios Where email = '$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {

        $usuario = mysqli_fetch_assoc($login);

        // Comprobar la contraseña:
        $verify = password_verify($password, $usuario['password']);

        if ($verify) {

            // Utilizar una sesión para guardar los datos del usuario loqueado:
            $_SESSION['usuario'] = $usuario;

        } else {

            // Si algo falla enviar una sesión con el fallo:
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
    } else {

        // Mensaje de error:
        $_SESSION['error_login'] = "Login incorrecto!!";
    }
}

// Redirigir al index.php:
header('Location: index.php');

?>
