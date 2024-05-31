<?php
    include '../models/modelGestionTitulos.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['nombre']) && isset($_POST['genero']) && isset($_POST['plataforma']) && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0){
            $nombre = $_POST['nombre'];
            $genero = $_POST['genero'];
            $plataforma = $_POST['plataforma'];
            
            // Ruta donde guardarás las imágenes, asegúrate de tener permisos de escritura
            $carpetaDestino = '../assets/imgsServer/';
            
            // Se genera un nombre único para el archivo combinando un identificador único y el nombre original del archivo.
            $nombreArchivo = uniqid() . '_' . $_FILES['imagen']['name'];

            // Se construye la ruta completa donde se guardará el archivo en el servidor.
            $rutaArchivo = $carpetaDestino . $nombreArchivo;

            // Se utiliza move_uploaded_file para mover el archivo desde su ubicación temporal a la carpeta de destino.
            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo);
            
            $nuevoTitulo = new GestionColeccion();
            $nuevoTitulo->nuevoTitulo($nombre, $genero, $plataforma, $rutaArchivo);

            /* IMPORTANTE: este código se encarga de procesar un formulario que incluye campos de texto y un campo de archivo de imagen. 
            Guarda la imagen en una carpeta específica en el servidor y luego llama a un método para agregar un nuevo título a la base de 
            datos, incluida la ruta de la imagen recién cargada.
            */
        }
    }

?>