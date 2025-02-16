<?php
include("partials/cabecera.php");
include("conexiondb.php");

if (isset($_POST["name"])) { //Verificar si se ha enviado el formulario
  $name = $_POST["name"]; // Obtener los datos del formulario
  $lastname = $_POST["lastname"]; 
  $sql = "UPDATE usuarios SET name='$name', lastname='$lastname' WHERE Usuarios_id=$_POST[Usuarios_id]"; // Crear la consulta SQL
  $conexion->query($sql); // Ejecutar la consulta
  header("Location:usuarios.php");
  exit();

}
if(! isset($_SESSION["Usuarios_id"])){ // Si no ha iniciado sesión
  header("Location:login.php");
}
else{ // Si ha iniciado sesión
  $sql = "SELECT Usuarios_id,name,lastname FROM usuarios where Usuarios_id=".$_SESSION["Usuarios_id"].";"; 
  $result = $conexion->query($sql); //
  $row = $result->fetch(PDO::FETCH_ASSOC); // Obtener la fila de resultados como un array asociativo
}




?>
<section id="tareas">
  <h3>Editar datos de usuario</h3>
  <form action="" method="post"> <!-- Formulario para editar los datos del usuario -->
    <input type="hidden" name="Usuarios_id" value="<?php echo $row['Usuarios_id']; ?>"> 
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required>
    <label for="lastname">Apellido</label>
    <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname']; ?>" required>
    <input type="submit" value="Guardar">

  </form>



</section>

<?php
include("partials/footer.php");
?>