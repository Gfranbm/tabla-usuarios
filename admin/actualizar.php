<?php 
 

    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('location: /index.php');
    }

    require '../includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM empleados WHERE id = ${id};";
    $resultado = mysqli_query($db, $query);
    $empleado = mysqli_fetch_assoc($resultado);
    
    // echo "<pre>";
    // var_dump($empleado);
    // echo "</pre>";

  
   
  $erroes = [];

//    echo "<pre>";
//    var_dump($_POST);
//    echo "</pre>";

   $nombre = $empleado['nombre'];
   $apellido = $empleado['apellido'];
   $edad = $empleado['edad'];
   $email = $empleado['mail'];
   $direccion = $empleado['direccion'];
   $telefono = $empleado['telefono'];
   $salario = $empleado['salario'];
  

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
      $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
      $edad = mysqli_real_escape_string($db, $_POST['edad']);
      $email = mysqli_real_escape_string($db, $_POST['email']);
      $direccion = mysqli_real_escape_string($db, $_POST['direccion']);
      $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
      $salario = mysqli_real_escape_string($db, $_POST['salario']);

      if(!$nombre){
          $erroes[] = "El nombe es Obligatario";
      }

      if(!$apellido){
        $erroes[] = "El apellido es Obligatario";
    }

      if(!$edad){
        $erroes[] = "la edad es Obligataria";
    }

    if(!$direccion){
        $erroes[] = "La direcion es Obligataria";
    }

     if(!$telefono){
        $erroes[] = "El telefono es Obligatario";
    }

      if(!$salario){
        $erroes[] = "El salario es Obligatario";
    }
  
    // echo "<pre>";
    // var_dump($erroes);
    // echo "</pre>";
    if(empty($erroes)){
        $query = "UPDATE empleados SET nombre = '${nombre}', apellido = '${apellido}', edad = ${edad}, mail = '${email}', 
        direccion = '${direccion}', telefono = '${telefono}', salario = ${salario} WHERE id = ${id};";
    
        $resultado = mysqli_query($db, $query);
    
        if($resultado){
            header('location:/?resultado=2');
        }
    }
  }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Agregar informacion</title>
</head>

<body>
    <main class="container">
        <h1>Actualizar Informacion</h1>

        <?php foreach($erroes as $error) :?>
            <div class="alerta error"> <?php echo $error;?> </div>
            <?php endforeach; ?>
        <form class="formulario" method="POST">
            <fieldset>
                <legend>Información del empleado</legend>

                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre del empleado"
                    value="<?php echo $empleado['nombre'];?>">

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido del empleado"
                    value="<?php echo $empleado['apellido'];?>">

                <label for="edad">Edad:</label>
                <input type="number" min="18" id="edad" name="edad" placeholder="Ejemplo: 18"
                    value="<?php echo $empleado['edad'];?>">

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="E-mail del empleado"
                    value="<?php echo $empleado['mail'];?>">

                <label for="direccion">Direccion:</label>
                <input type="text" id="direccion" name="direccion" placeholder="Direccion completa del empleado"
                    value="<?php echo $empleado['direccion'];?>">

                <label for="telefono">Telefono:</label>
                <input type="text" id="telefono" name="telefono" placeholder="Telefono eje. 54546622"
                    value="<?php echo $empleado['telefono'];?>">

                <label for="salario">Salario:</label>
                <input type="number" id="salario" name="salario"
                       placeholder="Salario del empleado" min="2900"
                       value="<?php echo $empleado['salario'];?>">

            </fieldset>
            <input type="submit" value="Agregar Empleado" class="boton-verde">
        </form>
    </main>

    
    <?php include '../includes/templates/footer.php';?>