<?php

require_once "config/database.php";
$conexion = Conectar::conexion();


if( isset($_POST['taskId']) ){

    $taskId = $_POST['taskId'];
    $sql = "SELECT * FROM task WHERE id = $taskId";
    $result = $conexion->query($sql);

    if(!$result){
        die('Query failed.');
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){ //CONVERTIMOS LOS RESULTADOS EN FILAS
        $json = array(
            'name' => $row['name'],
            'description' => $row['description'],
            'id' => $row['id']
        );
    }

    $jsonStr = json_encode($json[0]);
    echo $jsonStr;

}



?>