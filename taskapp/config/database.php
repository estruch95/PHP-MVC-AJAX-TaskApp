<?php

class Conectar {

    public static function conexion(){
        
        $servidor = "localhost";
        $usuario = "root";
        $pass = "";
        $bd = "taskapp";
        
        $conexion = new mysqli($servidor, $usuario, $pass, $bd);
        
        if($conexion)
        {
            echo "Base de datos conectada.";
            return $conexion;
        }
          
    }

}

?>