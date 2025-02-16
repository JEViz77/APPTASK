<?php 
include("partials/cabecera.php");
include("conexiondb.php");



if (!isset($_SESSION["Usuarios_id"])) {
  header("Location: login.php");
  exit();
}

$Usuarios_id = $_SESSION['Usuarios_id'];
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
      <?php while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) { 
        $estado = $fila['estado'] ? "En proceso" : "Finalizado";
      ?>
        <tr>
          <td><?php echo $fila['tareas_id']; ?></td>
          <td><?php echo $fila['titulo']; ?></td>
          <td><?php echo $fila['descripcion']; ?></td>
          <td><?php echo $fila['fecha_creacion']; ?></td>
          <td><?php echo $estado; ?></td>
          <td>
            <a href="editar_tareas.php?tareas_id=<?php echo $fila['tareas_id']; ?>">Editar</a> |
            <a href="eliminar_tareas.php?tareas_id=<?php echo $fila['tareas_id']; ?>">Eliminar</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</section>
<button id="añadir" type="submit"><a href="añadir_tareas.php">Añadir</a></button>

<?php include("partials/footer.php"); ?>
