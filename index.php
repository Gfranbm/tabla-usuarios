<?php 
    require 'includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM empleados;";
    $resultado = mysqli_query($db, $query);
  
    
    //  echo "<pre>";
    //  var_dump($empleado);
    //  echo "</pre>";

    //    echo "<pre>";
    //    var_dump($_POST);
    //    echo "</pre>";


    
    $mensaje = $_GET['resultado'] ?? null;
    $busqueda = $_GET['busqueda'] ?? null;
   

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $query = "DELETE FROM empleados WHERE id = ${id};";
            $resultado = mysqli_query($db, $query);
        }

        if($resultado){
            header('location:/?resultado=3');
        }
    }

   
   if($_SERVER['REQUEST_METHOD'] === 'GET'){
   
    $query = "SELECT * FROM empleados WHERE nombre LIKE '${busqueda}';";
    $resultado = mysqli_query($db, $query); 
      
    if(empty($busqueda)){
        $query = "SELECT * FROM empleados;";
        $resultado = mysqli_query($db, $query); 
    }
   }
   
 
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Prueba 33 MercaFarma</title>
</head>

<body>
    <header class="header">
        <h1>Gaspar Brito</h1>
    </header>

    <main class="container">
        <a class="boton-azul w-auto" href="admin/crear.php">Nuevo empleado</a>
        <?php if(intval($mensaje) === 1): ?>
        <span class="alerta">Empleado Agregado Correctamente</span>
        <?php elseif(intval($mensaje) === 2): ?>
        <span class="alerta">Informacion Actualizada Correctamente</span>
        <?php elseif(intval($mensaje) === 3): ?>
        <span class="alerta error">Empleado Eliminado Correctamente</span>

        <?php endif; ?>
        <div class="barra">
        
                <a href="admin/descargar.php" class="boton-azul w-auto">Descargar Datos</a>
           
            <div>
                <form method="GET" class="doble">
                    <input type="text" name="busqueda" value="<?php echo $busqueda; ?>" id="busqueda"
                        placeholder="busqueda">
                    <input type="submit" value="Buscar" class="boton-azul">
                </form>
            </div>
        </div>
        <table class="table">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Edad</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Salario</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php while($empleado = mysqli_fetch_assoc($resultado)) : ?>
                <tr>
                    <td> <?php echo $empleado['id'];?> </td>
                    <td> <?php echo $empleado['nombre'];?> </td>
                    <td> <?php echo $empleado['apellido'];?> </td>
                    <td> <?php echo $empleado['edad'];?> </td>
                    <td> <?php echo $empleado['mail'];?> </td>
                    <td> <?php echo $empleado['direccion'];?> </td>
                    <td> <?php echo $empleado['telefono'];?> </td>
                    <td> <?php echo 'Q.' . $empleado['salario'];?> </td>
                    <td class="doble">
                        <form method="POST" class="margen-0">

                        <input type="hidden" id="eliminar" name="id" value="<?php echo $empleado['id']; ?>">
                        <input type="submit" value="Eliminar" class="boton-rojo confirmacion">

                        </form>
                        <a class="boton-azul text-center"
                            href="admin/actualizar.php?id=<?php echo $empleado['id'];?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div>


        </div>




    </main>

<?php include 'includes/templates/footer.php'?>

</html>