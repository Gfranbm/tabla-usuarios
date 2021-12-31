<?php

function conectarDB() :mysqli{
    $db = mysqli_connect('localhost', 'root', 'root', 'mercafarma');

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    }
  return $db;
}

