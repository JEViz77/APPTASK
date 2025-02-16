<?php
include("conexiondb.php");
session_start();

if (!isset($_SESSION["Usuarios_id"])) { // Si no hay una sesión iniciada, redireccionar al login
    header("Location: login.php");
    exit();
}

if (isset($_GET['tareas_id'])) { // Si se recibe un ID de tarea
    $tareas_id = $_GET['tareas_id']; // Obtener el ID de la tarea a eliminar
    $Usuarios_id = $_SESSION['Usuarios_id']; // Obtener el ID del usuario actual

    // Usar consultas preparadas para evitar inyecciones SQL
    $sql = "DELETE FROM tareas WHERE tareas_id = :tareas_id AND Usuarios_id = :Usuarios_id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':tareas_id', $tareas_id, PDO::PARAM_INT); // Asignar el ID de la tarea a eliminar
    $stmt->bindParam(':Usuarios_id', $Usuarios_id, PDO::PARAM_INT); // Asignar el ID del usuario actual

    if ($stmt->execute()) { //Ejecutar la consulta
        header("Location: tareas.php"); 
        exit(); 
    } else { // Si hubo un error al eliminar la tarea
        echo "Hubo un error al eliminar la tarea.";
        exit(); // Finalizar el script
    }
} else { // Si no se recibió un ID de tarea
    header("Location: tareas.php");
    exit(); // Redireccionar al listado de tareas
}
?>
