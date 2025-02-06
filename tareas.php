<?php include("partials/cabecera.php");
include("conexiondb.php");
$sql = "SELECT * FROM tareas order by tareas_id desc";
$result = $conexion->query($sql);

?>
<section id="tareas">
  <h3>Tareas</h3>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Descripción</th>
        <th>Fecha creacion</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
        $estado = $fila['estado'] ? "En proceso" : "Finalizado";
        echo "<tr>";
        echo "<td>" . $fila['tareas_id'] . "</td>";
        echo "<td>" . $fila['titulo'] . "</td>";
        echo "<td>" . $fila['descripcion'] . "</td>";
        echo "<td>" . $fila['fecha_creacion'] . "</td>";
        echo "<td>" . $estado . "</td>";



        echo "<td>
                    <a href='editar_tarea.php?tareas_id=" . $fila['tareas_id'] . "'>Editar</a> |
                    <a href='eliminar_tarea.php?tareas_id=" . $fila['tareas_id'] . "'>Eliminar</a> | 
                    <a href='anadir_tarea?tareas_id=" . $fila['tareas_id'] . "'>Añadir</a>| 
                    <a href='ver_tareas?tareas_id=" . $fila['tareas_id'] . "'>Ver</a></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</section>
<?php include("partials/footer.php"); ?>