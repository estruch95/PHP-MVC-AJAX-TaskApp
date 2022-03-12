<?php

require_once "config/database.php";
$conexion = Conectar::conexion();

if( isset($_POST['name']) ) {
    
    //echo $_POST['name'];

    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $sql = "INSERT INTO task (name, description) VALUES ('$name', '$description')";
    $result = $conexion->query($sql);
    
    if(!$result){
        die('Query failed.');
    }

    echo "Task added succesfully.";
}

?>