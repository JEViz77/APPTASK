<?php 
include("conexiondb.php");
session_start(); // Iniciar la sesión


if (isset($_POST["username"]) && isset($_POST["password"])) {

    try {
      
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Preparar la consulta para verificar el usuario
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":username", $username);
        $stm->execute();

        // Obtener el resultado
        $row = $stm->fetch(PDO::FETCH_ASSOC);

        // Si el usuario existe y la contraseña es correcta
        if ($row && password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;  // Guardar el nombre de usuario en la sesión

            // Redirigir al usuario a la página de tareas
            header("Location: main.php");
            exit(); // Asegurarse de que no se ejecute más código después de la redirección
        } else {
            // Si la contraseña es incorrecta o el usuario no existe
            $error = "Usuario o contraseña incorrectos.";
        }
    } catch (Exception $e) {
        // Si ocurre un error, mostrar el mensaje
        $error = "Error al iniciar sesión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    
    
</head>
<body>
    <header>
        <a href="index.php"><img src="logo/logo1.webp" alt="logo1"></a>
        <h1>Login</h1>
    </header>
    <form action="" autocomplete="off" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required placeholder="Username" autocomplete="off">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required placeholder="Password" autocomplete="off">
        <input type="submit" value="Login">
    </form>

</body>
<footer>
    <p>copyright_2025</p>
</footer>

</html>