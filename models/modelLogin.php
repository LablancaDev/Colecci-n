<?php
    session_start();

    include '../conexionBD/config.php';

    class UserLogin{

        public function verificarUsuario($user, $password){
            global $conexion;
            
            // Consulta preparada para evitar inyecciones sql: 

            // consulta
            $consulta = "SELECT * FROM usuarios WHERE nombre = ? AND password = ? ";

            // preparar consulta
            $stmt = mysqli_prepare($conexion, $consulta);

            // se enlazan variables a la sentencia preparada, ss= indica que pasamos dos strings
            mysqli_stmt_bind_param($stmt, 'ss', $user, $password);

            // ejecutar la consulta
            mysqli_stmt_execute($stmt);


            // se obtiene el resultado de la consulta
            $resultado = mysqli_stmt_get_result($stmt);

            /* Una vez se obtiene el resultado, puedo manejar el resultado de diferentes maneras
               Puedo obtener las filas resultantes usando funciones como mysqli_fetch_assoc, mysqli_fetch_object
               o mysqli_num_rows*/
            
            // Si la consulta fué exitosa    
            if($resultado){
                 // Verificar si se encontró un usuario con las credenciales proporcionadas
                if(mysqli_num_rows($resultado) == 1){

                    $_SESSION['user'] = $user;

                    header("Location: ../views/principal.php");

                    exit();
                // Si no se encuentra el usuario especificado, se se crea la variable de session con el mensaje de error y se manda al login al user
                }else{
                    $_SESSION['error'] = 'User and password incorrect';
                    header("Location: ../views/login.php");
                    exit();
                }
            }else{
                echo 'Error en la consulta: ' . mysqli_error($conexion);
            }   
            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
        }
    }

?>

<!-- 
Las tres formas de manejar los datos obtenidos (mysqli_fetch_assoc, mysqli_fetch_object y mysqli_num_rows):
    
    1-mysqli_fetch_assoc:

    Devuelve: Un array asociativo donde los nombres de las columnas son las claves del array.
    Uso: Es útil cuando prefieres trabajar con datos asociativos y te refieres a las columnas por sus nombres.

    2-mysqli_fetch_object:

    Devuelve: Un objeto donde los nombres de las columnas se convierten en propiedades del objeto.
    Uso: Es útil cuando prefieres trabajar con datos de manera orientada a objetos.

    3-mysqli_num_rows:

    Devuelve: El número de filas afectadas por la última operación SELECT.
    Uso: Se utiliza cuando solo necesitas saber cuántas filas cumplen con la condición en la consulta.

-->