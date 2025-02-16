<?php
include("conexiondb.php");
session_start();

if (!isset($_SESSION["Usuarios_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['tareas_id'])) {
    $tareas_id = $_GET['tareas_id'];
    $Usuarios_id = $_SESSION['Usuarios_id'];

    // Usar consultas preparadas para evitar inyecciones SQL
    $sql = "DELETE FROM tareas WHERE tareas_id = :tareas_id AND Usuarios_id = :Usuarios_id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':tareas_id', $tareas_id, PDO::PARAM_INT);
    $stmt->bindParam(':Usuarios_id', $Usuarios_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: tareas.php");
        exit();
    } else {
        echo "Hubo un error al eliminar la tarea.";
        exit();
    }
} else {
    header("Location: tareas.php");
    exit();
}
?>
