<?php
include("partials/cabecera.php");
include("conexiondb.php");



if (!isset($_SESSION["Usuarios_id"])) { // Si no existe la variable de sesion Usuarios_id...
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Si se ha enviado el formulario...
    $titulo = $_POST['titulo']; // Guardamos los valores de los campos del formulario en variables
    $descripcion = $_POST['descripcion']; //
    $fecha_creacion = $_POST['fecha_creacion'];
    $estado = $_POST['estado'];
    $Usuarios_id = $_SESSION['Usuarios_id']; // Guardamos el valor de la variable de sesion Usuarios_id en la variable $Usuarios_id 

    // Usar consultas preparadas para evitar inyecciones SQL
    $sql = "INSERT INTO tareas (titulo, descripcion, fecha_creacion, estado, Usuarios_id) 
            VALUES (:titulo, :descripcion, :fecha_creacion, :estado, :Usuarios_id)";
    $stmt = $conexion->prepare($sql); // Preparamos la consulta
// Asignamos los valores de las variables a los parametros de la consulta
    $stmt->bindParam(':titulo', $titulo); 
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':fecha_creacion', $fecha_creacion);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
    $stmt->bindParam(':Usuarios_id', $Usuarios_id, PDO::PARAM_INT);

    if ($stmt->execute()) { // Si la consulta se ejecuta correctamente...
        header("Location: tareas.php");
        exit();
    }
}
?>

<section id="anadir_tarea">
  <h3>Añadir Nueva Tarea</h3>
  <form action="" method="POST">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" required>
    <label for="fecha_creacion">Fecha de Creación:</label>
    <input type="date" id="fecha_creacion" name="fecha_creacion" required>
    <label for="estado">Estado:</label>
    <select name="estado" id="estado" required>
      <option value="1">En proceso</option>
      <option value="0">Finalizado</option>
    </select>
    <button type="submit">Añadir Tarea</button>
  </form>
</section>

<?php include("partials/footer.php"); ?> 
