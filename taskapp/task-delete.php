<?php

require_once "config/database.php";
$conexion = Conectar::conexion();


if( isset($_POST['taskId']) ){

    $idTask = $_POST['taskId'];
    $sql = "DELETE FROM task WHERE id = $idTask";
    $result = $conexion->query($sql);

    if(!$result){
        die('Query failed.');
    }

    echo "Task Deleted Successfully";

}


?>