
<?php
    include "../conexionBD/config.php";

    class GestionColeccion{

        public function nuevoTitulo($nombre, $genero, $plataforma, $rutaArchivo){
            global $conexion;  

            $consulta = "INSERT INTO biblioteca (nombre_titulo, genero, plataforma, imagen_url) VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conexion, $consulta);
            
            if($stmt){
                mysqli_stmt_bind_param($stmt, "ssss", $nombre, $genero, $plataforma, $rutaArchivo);

                $resultado = mysqli_execute($stmt);

                if($resultado){
                    header('Location: ../views/principal.php');
                }else{
                    echo "Error al crear el nuevo alumno: " . mysqli_error($conexion);
                }

                mysqli_stmt_close($stmt);
            }else{
                echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
            }
        }    


        public function mostrarTitulos(){
            global $conexion;

            $listaTitulos = [];

            $consulta = "SELECT id_titulo, nombre_titulo, genero, plataforma FROM biblioteca";
            
            $stmt = mysqli_prepare($conexion, $consulta);

            if($stmt){
                mysqli_stmt_execute($stmt);

                $resultado = mysqli_stmt_get_result($stmt);

                if($resultado){
                    while ($fila = mysqli_fetch_assoc($resultado)){
                        $listaTitulos[] = $fila;
                    }
                }
                mysqli_stmt_close($stmt);
            }
            return $listaTitulos;
        }


        public function eliminarTitulo($id_titulo){
            global $conexion;

            $consulta = "DELETE FROM biblioteca WHERE id_titulo = ?";
            
            $stmt = mysqli_prepare($conexion, $consulta);

            if($stmt){
                
                mysqli_stmt_bind_param($stmt, 'i', $id_titulo);

                $resultado = mysqli_stmt_execute($stmt);

                if(!$consulta){
                    echo "Error al eliminar el alumno: " . mysqli_error($conexion);
                }

                header('Location: ../views/principal.php');

                mysqli_stmt_close($stmt);
        
            }else{
                echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
            }
        } 


        public function obtenerPlataforma($plataforma){
            global $conexion;

            $listaTitulos = [];

            $consulta = "SELECT * FROM biblioteca WHERE plataforma = ? ";

            $stmt = mysqli_prepare($conexion, $consulta);

            if($stmt){

                mysqli_stmt_bind_param($stmt, 's', $plataforma);

                $resultado = mysqli_stmt_execute($stmt);

                if($resultado){
                    // Obtener el conjunto de resultados
                    $result = mysqli_stmt_get_result($stmt);

                    // Recorrer las filas y agregarlas a $listaTitulos
                    while($fila = mysqli_fetch_assoc($result)){
                        $listaTitulos [] = $fila;
                    }
                }
                mysqli_stmt_close($stmt);
            }
            return $listaTitulos;
        }



    }


?>