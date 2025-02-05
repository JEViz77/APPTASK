<?php
include("partials/cabecera.php");
include("conexiondb.php");
if (isset($_POST["name"])) {
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];
  $sql = "UPDATE usuarios SET name='$name', lastname='$lastname' WHERE Usuarios_id=$_POST[Usuarios_id]";
  $conexion->query($sql);
  header("Location:usuarios.php");
  exit();

}
if(! isset($_SESSION["Usuarios_id"])){
  header("Location:login.php");
}
else{
  $sql = "SELECT Usuarios_id,name,lastname FROM usuarios where Usuarios_id=".$_SESSION["Usuarios_id"].";";
  $result = $conexion->query($sql);
  $row = $result->fetch(PDO::FETCH_ASSOC);
}




?>
<section id="tareas">
  <h3>Editar datos de usuario</h3>
  <form action="" method="post">
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