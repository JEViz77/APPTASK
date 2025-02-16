<?php 
include("partials/cabecera.php");
include("conexiondb.php");



if (!isset($_SESSION["Usuarios_id"])) { // Si no ha iniciado sesión
  header("Location: login.php");
  exit();
}

$Usuarios_id = $_SESSION['Usuarios_id']; // Obtener el ID del usuario actual
$sql = "SELECT * FROM tareas WHERE Usuarios_id = :Usuarios_id ORDER BY tareas_id DESC";
$stmt = $conexion->prepare($sql); 
$stmt->bindParam(':Usuarios_id', $Usuarios_id, PDO::PARAM_INT); 
$stmt->execute();

?>

<section id="tareas">
  <h3>Tareas</h3>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha Creación</th>
        <th>Estado</th>
        <th>Operaciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { // Recorrer los resultados de la consulta
        $estado = $fila['estado'] ? "En proceso" : "Finalizado"; // Si estado es 1, mostrar "En proceso", de lo contrario, mostrar "Finalizado"
      ?>
        <tr>
          <td><?php echo $fila['tareas_id']; ?></td>         <!--Mostrar el id de la tarea -->
          <td><?php echo $fila['titulo']; ?></td>            <!--Mostrar el titulo de la tarea -->
          <td><?php echo $fila['descripcion']; ?></td>       <!--Mostrar la descripcion de la tarea-->
          <td><?php echo $fila['fecha_creacion']; ?></td>    <!--Mostrar la fecha de creacion de la tarea-->
          <td><?php echo $estado; ?></td>
          <td>
            <a href="editar_tareas.php?tareas_id=<?php echo $fila['tareas_id']; ?>">Editar</a> | 
            <a href="eliminar_tareas.php?tareas_id=<?php echo $fila['tareas_id']; ?>">Eliminar</a>
          </td>
        </tr>
      <?php } ?> <!--Fin del bucle while-->
    </tbody>
  </table>
</section>
<button id="añadir" type="submit"><a href="añadir_tareas.php">Añadir</a></button> 

<?php include("partials/footer.php"); ?>
