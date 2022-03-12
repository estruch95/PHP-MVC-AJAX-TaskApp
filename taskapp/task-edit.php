<?php

require_once "config/database.php";
$conexion = Conectar::conexion();

if($_POST){

    $taskId = $_POST['taskId'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE task SET name = '$name', description = '$description' WHERE id = $taskId";
    $result = $conexion->query($sql);

    if(!$result){
        die('Query failed.');
    }

    echo "Update Task Successfully";


}

?>