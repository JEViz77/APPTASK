
        <?php
        include("cabecera.php");
        $sql = "SELECT Usuarios_id,name,lastname FROM usuarios";
        $result = $conexion->query($sql); 
        ?>
        <section id="tareas">
          <h3>Usuarios</h3>
          
    <div class="listado">
        <h1>Proveedores</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>                    
                  
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $fila['Usuarios_id'] . "</td>";
                    echo "<td>" . $fila['name'] . "</td>";
                    echo "<td>" . $fila['lastname'] . "</td>";
                    echo "<td><a href='editar_proveedor.php?id=" . $fila['id'] . "'>Editar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </section>

        <?php
        include("footer.php");
        ?>
   
   