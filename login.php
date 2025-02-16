<?php

include("conexiondb.php");
session_start();

if (isset($_POST["username"])) { //Si se ha enviado el formulario

    $sql = "SELECT * FROM usuarios WHERE username=:username";
    $stm = $conexion->prepare($sql); //Preparamos consulta
    $stm->bindParam(":username", $_POST["username"]); //Sustituimos los parametros
    $stm->execute(); //Ejecutamos la consulta
    $username = $stm->fetch(); //Obtenemos el resultado de la consulta
    if ($username) { //Si existe el usuario
        if (password_verify($_POST["password"], $username["password"])) { //Si la contraseña es correcta

            $_SESSION["Usuarios_id"] = $username["Usuarios_id"]; //Guardamos el id del usuario en la sesion
            $_SESSION["username"] = $username["username"]; //Guardamos el username del usuario en la sesion
            header("Location: main.php");
            exit(); //Redirigimos a la pag ppal
        } else { //Si la contraseña no es correcta
            echo "Contraseña incorrecta"; //Mostramos sms de error
            exit(); //Salimos del script
        }
    } else { //Si no existe el usuario
        echo "username no encontrado";
        exit(); 
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">


</head>

<body>
    <header>
        <a href="index.php"><img src="logo/logo1.webp" alt="logo1"></a>
        <h1>Login</h1>
    </header>
    <form id=form_login action="login.php" autocomplete="off" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required placeholder="Username" autocomplete="off">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required placeholder="Password" autocomplete="off">
        <input type="submit" value="Login">
    </form>

</body>
<footer>
    <p>&copy; 2025 - Todos los derechos reservados</p>
</footer>

</html>