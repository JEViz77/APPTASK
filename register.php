<?php
include("conexiondb.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $lastname=$_POST["lastname"];

    // Incluir archivo de conexión
    

    try {
        // Verificar si el usuario ya existe en la base de datos
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":username", $username);
        $stm->execute();
        
        if ($stm->rowCount() > 0) {
            $error = "El nombre de usuario ya está en uso.";
        } else {
            // Si el usuario no existe, procesar el registro
            // Hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertar los datos en la base de datos
            $sql = "INSERT INTO usuarios (username, password, name, lastname) VALUES (:username, :password, :name, :lastname)";
            $stm = $conexion->prepare($sql);
            $stm->bindParam(":username", $username);
            $stm->bindParam(":password", $hashed_password);
            $stm->bindParam(":name", $name);
            $stm->bindParam(":lastname", $lastname);
            $stm->execute();

            // Redirigir al usuario a una página de éxito o login
            header("Location: login.php");
            exit();
        }
    } catch (Exception $e) {
        // Manejo de errores
        $error = "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <header>
        <a href="index.php"><img src="logo/logo1.webp" alt="logo1"></a>
        <h1>Registro</h1>

    </header>
    <form action="" method="post">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required placeholder="Nombre">
        <label for="lastname">Apellidos:</label>
        <input type="text" name="lastname" id="lastname" required placeholder="Apellidos">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required placeholder="Usuario">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required placeholder="Password">
        <input type="submit" value="Registro">
        <?php if (isset($error)) { echo "<p>" . $error . "</p>"; } ?>
    </form>
</body>
<footer>
    <p>Copyrigth 2020</p>
</footer>

</html>