<?php 
    require '../includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM empleados;";
    $resultado = mysqli_query($db, $query);
    $nombre = md5( uniqid( rand(), true)). ".xls";

    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename =' .$nombre);
    header('Pragma: no-cache');
    header('Expires: 0');

  echo '<table border=1>';
  echo '<tr>';
  echo '<th coldspan=4> respote </th> ';
  echo'  <tr>
  <th scope="col">Id</th>
  <th scope="col">Nombre</th>
  <th scope="col">Apellido</th>
  <th scope="col">Edad</th>
  <th scope="col">E-mail</th>
  <th scope="col">Direccion</th>
  <th scope="col">Telefono</th>
  <th scope="col">Salario</th>
</tr>';

while($empleado = mysqli_fetch_assoc($resultado)) : ?>
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
  <?php endwhile; 
?>

