<?php
session_start();
include("conexiondb.php");

if (isset($_GET['tareas_id'])) {
    $tareas_id = $_GET['tareas_id'];
    $Usuarios_id = $_SESSION['Usuarios_id']; // Asumiendo que user_id se almacena en la sesión al iniciar sesión

    $sql = "DELETE FROM tareas WHERE tareas_id = $tareas_id AND Usuarios_id = $Usuarios_id";
    $conexion->query($sql);
    header("Location: tareas.php");
}
?>