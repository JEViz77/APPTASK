<?php   
session_start();
if (isset($_SESSION["username"])) {
    $username= $_SESSION["username"];

}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra Lateral</title>
    <link rel="stylesheet" href="css/nuevo.css">

</head>

<body>

    <main>
        <header id="welcome">
            <a href="index.php"><img src="logo/logo1.webp" alt="logo1"></a>
            <h1>APPTASK</h1>
            <p>Welcome <?php if(isset($username)){ echo $username;} ?></p>
        </header>
        <aside>
            <h2>Menú</h2>
            <ul>
                <li><a href="tareas.php">Tareas</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
            </ul>
        </aside>
   