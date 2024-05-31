<?php

    include '../conexionBD/config.php';

    class GestionGeneros{

        public function obtenerGeneros(){
            global $conexion;
            
            $consulta = "SELECT DISTINCT genero as nombre_genero FROM biblioteca"; // Selecciona valores distintos en la columna 'genero'

            $resultado = mysqli_query($conexion, $consulta);

            if($resultado){
                $generos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
                return $generos;
            }else{
                // Manejar el error, por ejemplo, imprimir un mensaje de error
                echo "Error en la consulta: " . mysqli_error($conexion);
            }
        }
    }



?>

