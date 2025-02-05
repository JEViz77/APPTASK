<?php include("partials/cabecera.php");
include("conexiondb.php");

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
      <!-- Ejemplo de una fila de tarea -->
      <tr>
        <td>1</td>
        <td>Completar informe</td>
        <td>Preparar el informe mensual de ventas</td>
        <td>Fecha</td>
        <td>En proceso</td>

      </tr>
      <button>Editar</button>
      <button>Eliminar</button>
      <!-- Puedes añadir más filas aquí -->
    </tbody>
  </table>
</section>
<?php include("partials/footer.php"); ?>