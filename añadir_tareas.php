<?php
include("partials/cabecera.php");
include("conexiondb.php");
if(isset($_SESSION["Usuarios_id"])){
  $Usuarios_id = $_SESSION['Usuarios_id']; // Asumiendo que user_id se almacena en la sesión al iniciar sesión

}else{
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $estado = $_POST['estado'];
    $Usuarios_id = $_SESSION['Usuarios_id']; // Asumiendo que user_id se almacena en la sesión al iniciar sesión

    $sql = "INSERT INTO tareas (titulo, descripcion, fecha_creacion, estado, Usuarios_id) VALUES (:titulo, :descripcion, :fecha_creacion, :estado, '$Usuarios_id')";
    $stm=$conexion->prepare($sql);
    $stm->bindParam(":titulo",$titulo);
    $stm->bindParam(":descripcion",$descripcion);
    $stm->bindParam("fecha_creacion",$fecha_creacion);
    $stm->bindParam("estado",$estado);
    $stm->execute();
    header("Location: tareas.php");
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
      <option value=1>En proceso</option>
      <option value=0>Finalizado</option>
    </select>
    <button type="submit">Añadir Tarea</button>
  </form>
</section>
<?php include("partials/footer.php"); ?>