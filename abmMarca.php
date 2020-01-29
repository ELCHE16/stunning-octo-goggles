<?php
    require 'clases/Marca.php';
    $objMarca = new Marca;
    $marcas = $objMarca->listarMarcas(); 
    include 'includes/head.php';
    include 'includes/headerAdm.php'; 
    
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<title>ABM Marcas</title>

<body>
<! -- include 'includes/headerAdm.php'; -->
<main class="container">
    <h1>Administracion de Marcas</h1>

    <a href="admin.php" class="btn btn-outline-secondary m-3">Volver a principal</a>

        <table class="table table-stripped table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th>id</th>
                <th>Marca</th>
                <th colspan="2">
                    <a href="formAgregarMarca.php" class="btn btn-dark">
                        agregar
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
<?php
            foreach ( $marcas as $marca  ){
?>
            <tr>
                <td><?= $marca['id_marca']; ?></td>
                <td><?= $marca['marca']; ?></td>                
                <td>
                    <a href="formModificarMarca.php?id=<?php echo $marca['id_marca']; ?>" class="btn btn-outline-secondary">
                        modificar 
                    </a>
                </td>
                <td>
                    <a href="eliminarMarca.php?id=<?php echo $marca['id_marca']; ?>" class="btn btn-outline-secondary">
                        eliminar
                    </a>
                </td>
                
            </tr>
            
<?php
            }           
?>
              
            </tbody>
        </table>

    <a href="admin.php" class="btn btn-outline-secondary m-3">Administracion principal</a>

    </main>

    <?php
  include 'includes/footer.php';
  include 'includes/scriptBootstrap.php';
  ?>

</body>
</html>





