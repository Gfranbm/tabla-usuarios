<?php 
    require '../includes/config/database.php';
    $db = conectarDB();

    $query = "SELECT * FROM empleados   order  by nombre asc;";
    $resultado = mysqli_query($db, $query);

    if($resultado){
        header('location:/index.php');
    }
?>