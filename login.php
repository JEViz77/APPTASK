<?php

include("conexiondb.php");
session_start();

if (isset($_POST["username"])) {

    $sql = "SELECT * FROM usuarios WHERE username=:username";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(":username", $_POST["username"]);
    $stm->execute();
    $username = $stm->fetch();
    if ($username) {
        if (password_verify($_POST["password"], $username["password"])) {

            $_SESSION["Usuarios_id"] = $username["Usuarios_id"];
            $_SESSION["username"] = $username["username"];
            header("Location: main.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
            exit();
        }
    } else {
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