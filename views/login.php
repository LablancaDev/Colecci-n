<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto my-5 border rounded p-4 text-white login">
                <img src="../assets/imgs/user.png" alt="Logo" class="img-fluid mb-4 d-block mx-auto" style="max-height: 100px;">
                <form action="../controls/controlLogin.php" method="post" id="loginForm">
                    <h2 class='text-center'>Login</h2>
                    <div class="mb-3">
                        <label for="user" class="form-label">User</label>
                        <input type="user" class="form-control" id="user" aria-describedby="emailHelp" name="user" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                    <!-- Se muestra mensaje de error si existe , 1º se comprueba si la variable de error está definida-->
                    <?php if(isset ($_SESSION['error'])) {?> 
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                        <?php unset($_SESSION['error']); ?><!--Limpia la variable de sesión después de mostrarla -->
                     <?php } ?>   
                    <button type="submit" class="btn btn-primary btn-block d-block mx-auto">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>