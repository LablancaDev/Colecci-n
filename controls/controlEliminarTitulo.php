<?php

    include '../models/modelGestionTitulos.php';

    if(isset($_GET['id_titulo'])){
        $id_titulo = $_GET['id_titulo'];
        
        $eliminarTitulo = new GestionColeccion();
        $eliminarTitulo->eliminarTitulo($id_titulo);

    }else{
        echo 'Erro con el id del Título';
    }



?>