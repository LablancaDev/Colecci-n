<?php

    include '../models/modelGestionTitulos.php';

    if(isset($_GET['plataforma'])){

        $plataforma = $_GET['plataforma'];
        
        $obtenerPlataforma = new GestionColeccion();
        $listaTitulos = $obtenerPlataforma->obtenerPlataforma($plataforma);// Llama al método obtenerPlataforma con el valor de 'plataforma' y obtiene una lista de títulos.

        // Establece la cabecera de la respuesta como tipo de contenido JSON.
        header('Content-Type: application/json');
        // Convierte la lista de títulos a formato JSON y la imprime en la salida.
        echo json_encode($listaTitulos);
    }

?>