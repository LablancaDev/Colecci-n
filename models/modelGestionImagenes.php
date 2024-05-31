<?php

// Incluye el archivo de configuración de la base de datos
include('../conexionBD/config.php');

// Define una clase para gestionar las imágenes
class GestionImagenes {
    // Función para obtener las URLs de las imágenes desde la base de datos
    public function obtenerImagenes() {
        // Accede a la variable global que contiene la conexión a la base de datos
        global $conexion;

        // Array para almacenar las URLs de las imágenes
        $listaUrlImagenes = [];

        // Consulta SQL para seleccionar las URLs de las imágenes desde la tabla 'biblioteca'
        $consulta = 'SELECT imagen_url FROM biblioteca';

        // Ejecuta la consulta y guarda el resultado en $result
        $result = mysqli_query($conexion, $consulta);

        // Verifica si la consulta fue exitosa
        if ($result) {
            // Itera sobre cada fila del resultado y agrega la URL de la imagen al array
            while ($fila = mysqli_fetch_assoc($result)) { //mientras haya filas el bucle se ejecutará hasta recuperar todas y las almacenará en la variable fila
                $listaUrlImagenes[] = $fila['imagen_url'];
            }

            // Libera la memoria asociada al resultado
            mysqli_free_result($result);
        }

        // Retorna el array con las URLs de las imágenes
        return $listaUrlImagenes;
    }

    public function obtenerImagenesPorPlataforma($plataforma){
        global $conexion;
        
        $listaUrlImagenes = [];

        $consulta = "SELECT imagen_url FROM biblioteca WHERE plataforma = ? ";

        $stmt = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($stmt, "s", $plataforma);

        if($stmt){

            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if($resultado){
                while($fila = mysqli_fetch_assoc($resultado)){
                    $listaUrlImagenes[] = $fila['imagen_url'];
                }
            }
            mysqli_stmt_close($stmt);
        }
        return $listaUrlImagenes;
    }


    public function obtenerImagenesPorGenero($genero){
        global $conexion;

        $listaUrlImagenes = [];
        
        $consulta = "SELECT imagen_url FROM biblioteca WHERE genero = ? ";
        
        $stmt = mysqli_prepare($conexion, $consulta);
        
        mysqli_stmt_bind_param($stmt, "s", $genero);

        if($stmt){

            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if($resultado){
                while($fila = mysqli_fetch_assoc($resultado)){
                    $listaUrlImagenes[] = $fila['imagen_url'];
                } 
            }
            mysqli_stmt_close($stmt);
        }
        return $listaUrlImagenes;
    }

    public function obtenerImagenesPorInicioTitulo($nombre_titulo){
        global $conexion;
    
        $listaUrlImagenes = [];
        
        $consulta = 'SELECT imagen_url FROM biblioteca WHERE nombre_titulo LIKE ?';
        $tituloParam = $nombre_titulo . '%';  // Agregamos el símbolo % para buscar aquellos que comiencen con $nombre_titulo
        
        $stmt = mysqli_prepare($conexion, $consulta);
    
        mysqli_stmt_bind_param($stmt, "s", $tituloParam);
    
        if($stmt){
    
            mysqli_stmt_execute($stmt);
    
            $resultado = mysqli_stmt_get_result($stmt);
    
            if($resultado){
                while($fila = mysqli_fetch_assoc($resultado)){
                    $listaUrlImagenes[] = $fila['imagen_url'];
                }
            }
            mysqli_stmt_close($stmt);
        }
        return $listaUrlImagenes;
    }
    
}

?>
