<?php
session_start(); // Iniciar la sesión

// Verificar si el formulario ha sido enviado
if (isset($_POST["username"])) {

    try {
        include("conexiondb.php"); // Incluir la conexión

        $username = $_POST["username"];
        $password = $_POST["password"];

        // Preparar la consulta para verificar el usuario
        $sql = "SELECT * FROM usuarios WHERE username = :username";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":username", $username);
        $stm->execute();

       
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($password,$row["password"])) {
         
            $_SESSION["username"] = $username;  // Guardar el nombre de usuario en la sesión

           
            header("Location: tareas.php");
            exit(); 
        } else {
            
            $error = "Usuario o contraseña incorrectos.";
        }
    } catch (Exception $e) {
       
        $error = "Error al iniciar sesión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="img/logo1.webp" alt="logo"></a>
        <h1>Login</h1>
    </header>

    
    <form action="login.php" method="post">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required placeholder="Usuario">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required placeholder="Contraseña">

        <input type="submit" value="Iniciar sesión">

       
        <?php if (isset($error)) { echo "<p style='color:red;'>" . $error . "</p>"; } ?>
    </form>

    <footer>
        <p>Copyright 2020</p>
    </footer>
</body>
</html>