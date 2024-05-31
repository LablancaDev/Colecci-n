<?php

    //Voy a utilizar este archivo en conjunto de momento para dos funcionalidades, una es obtener todas las imágenes(url) de la base de datos 
    // mediante esta lógica y otra sólo las imágenes filtradas por plataforma por eso añado el condicional para evaluar cada caso, es una opción para compartir archivos y no tener que crear muchos   

    require ('../models/modelGestionImagenes.php');

    $control = new GestionImagenes();
    
    if(isset($_GET['plataforma'])){
        // Recupero la variable plataforma para enviarla a la query en model y poder así filtrar
        $plataforma = $_GET['plataforma'];
        $listaUrlImagenes = $control->obtenerImagenesPorPlataforma($plataforma);
    }else if (isset($_GET['genero'])){
        $genero = $_GET['genero'];
        $listaUrlImagenes = $control->obtenerImagenesPorGenero($genero);
    }else if(isset($_GET['nombre_titulo'])){
        $nombre_titulo = $_GET['nombre_titulo'];
        $listaUrlImagenes = $control->obtenerImagenesPorInicioTitulo($nombre_titulo);
    }else{
        $listaUrlImagenes = $control->obtenerImagenes();

    }

    // El manejo de datos en json lo utilizaré en los dos casos...

    // Establecer el encabezado Content-Type a application/json
    header("Content-Type: application/json");

    // Devolver los datos como JSON
    echo json_encode($listaUrlImagenes);

    
// <!-- Después de recuperar las url del servidor estoy estableciendo el encabezado Content-Type a application/json 
// y devolviendo los datos codificados en formato JSON. es MUY IMPORTANTE INDICARLO EN EL CONTROLADOR YA
// QUE LA VISTA ESPERA RECIBIR Y CODIFICAR LOS DATOS EN FORMATO JSON (espera una respuesta json)--> SI PONGO TEXTO DESPUÉS DE >? DA ERROR


?>
