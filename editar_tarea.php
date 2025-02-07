<?php
include("partials/cabecera.php");
include("conexiondb.php");
if(isset($_SESSION["Usuarios_id"])){
  $Usuarios_id = $_SESSION['Usuarios_id']; // Asumiendo que user_id se almacena en la sesión al iniciar sesión

}else{
  header("Location: login.php");
  exit();
}


if (isset($_GET['tareas_id'])) {
    $tareas_id = $_GET['tareas_id'];
    $sql = "SELECT * FROM tareas WHERE tareas_id = $tareas_id AND Usuarios_id = $Usuarios_id";
    $result = $conexion->query($sql);
    $fila = $result->fetch(PDO::FETCH_ASSOC);
}else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $tareas_id = $_POST['tareas_id'];
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $fecha_creacion = $_POST['fecha_creacion'];
  $estado = $_POST['estado'];

  $sql = "UPDATE tareas SET titulo = '$titulo', descripcion = '$descripcion',fecha_creacion='$fecha_creacion',estado = '$estado' WHERE tareas_id = $tareas_id AND Usuarios_id = $Usuarios_id";
  $conexion->query($sql);
  header("Location: tareas.php");
}else{
  header("Location: tareas.php");
  exit();
}


?>

<section id="editar_tarea">
  <h3>Editar Tarea</h3>
  <form action="editar_tarea.php" method="POST">
    <input type="hidden" name="tareas_id" value="<?php echo $fila['tareas_id']; ?>">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $fila['titulo']; ?>" required>
    <label for="descripcion">Descripción:</label>
    <input type="text" id="descripcion" name="descripcion" value="<?php echo $fila['descripcion']; ?>" required>
    <label for="fecha_creacion">Fecha de Creación:</label>
    <input type="date" id="fecha_creacion" name="fecha_creacion" value="<?php echo $fila['fecha_creacion']; ?>" required>
    <label for="estado">Estado:</label>
    <select name="estado" id="estado" required>
      <option value=1 <?php if($fila['estado'] == 1) echo "selected"; ?>>En proceso</option>
      <option value=0 <?php if($fila['estado'] == 0) echo "selected"; ?>>Finalizado</option>
    </select>
    <button type="submit">Guardar Cambios</button>
  </form>
</section>
<?php include("partials/footer.php"); ?>