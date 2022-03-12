<?php

require_once "config/database.php";
$conexion = Conectar::conexion();

$search = $_POST['search']; //LO GUARDO DEL LADO DEL SERVIDOR

if(!empty($search)){
    $sql = "SELECT * FROM task WHERE name LIKE '$search%'";
    $result = $conexion->query($sql);

    if(!$result){
       die("Query error: ".mysqli_error($conexion)); 
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'name' => $row['name'],
            'description' => $row['description'],
            'id' => $row['id']
        );
    }

    $jsonString = json_encode($json); //DATO QUE QUIERO ENVIAR AL FRONTEND
    
    //IMPRIMIMOS EL JSON EN STRING
    echo $jsonString;

}

?>