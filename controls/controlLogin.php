<?php

include '../models/modelLogin.php';

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $user = $_POST['user'];
        $password = $_POST['password'];

        $modelLogin = new UserLogin();
        $modelLogin->verificarUsuario($user, $password); 
    }

?>