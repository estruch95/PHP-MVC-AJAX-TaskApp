<?php

require_once "config/database.php";
$conexion = Conectar::conexion();

$sql = "SELECT * FROM task";
$result = $conexion->query($sql);

if(!$result){
    die('Query failed.'.mysqli_error($conexion));
}

$json = array();
while($row = mysqli_fetch_array($result)){
    $json[] = array(
        'name' => $row['name'],
        'description' => $row['description'],
        'id' => $row['id']
    );
}

$jsonString = json_encode($json);

echo $jsonString;

?>