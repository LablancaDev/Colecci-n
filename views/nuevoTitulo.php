<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/principal.css">
</head>
<body>
        <nav class="navbar navbar-expand-lg bg-warning">
            <div class="container-fluid">
                <a class="navbar-brand ps-3" href="../views/principal.php">Retrocollectiongame</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="principal.php">Gestión de la colección</a>
                        <a class="nav-link" href="coleccion.php">Colección</a>
                        <a class="nav-link" href="../controls/conexionPokeapi.php">PokeAPI</a>
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </div>
                    <div class="ms-auto"><!--Se muestra el usuario que inicia la sesión-->
                        <?php if(isset($_SESSION['user'])){ ?>
                            <div class="nav-item">
                                <div class="nav-item d-flex align-items-center me-3">
                                    <a class="nav-link text-danger me-3" href="../views/login.php">Cerra Sesión</a><!--en proyecto real, habría que aplicar la lógica de destruir sesión etc...-->
                                    <span class="navbar-text bg-success text-light rounded">
                                        <?php echo $_SESSION['user'];?>
                                    </span>
                                </div>
                            </div>
                        <?php }?>    
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <h3 class="mt-4">Añadir nuevo Titulo a la colección</h3>
            <div class="col-md-6 bg-black d-block mx-auto mt-4">
                <div class="card">
                   <form action="../controls/controlNuevoTitulo.php" method="POST" class="p-4" enctype="multipart/form-data"> <!--se permite la carga de archivos-->
                    <h4 class = "text-center">Nuevo Título</h4>
                      <div class="mb-4">
                         <label for="" class="form-label">Nombre del Título:</label>
                         <input type="text" class="form-control" id="nombre" name="nombre" required>   
                      </div>
                      <div class="mb-4">
                         <label for="genero" class="form-label">Genero:</label>
                         <select name="genero" id="genero" class="form-control">
                            <option value="aventura">Aventura</option>
                            <option value="deportes">Deportes</option>
                            <option value="Acción/Run & Gun">Acción/Run & Gun</option>
                            <option value="plataformas">Plataformas</option>
                            <option value="lucha">Lucha</option>
                            <option value="carreras">Carreras</option>
                            <option value="survivialHorror">Survival Horror</option>
                         </select>  
                      </div>
                      <div class="mb-4">
                        <label for="plataforna" class="form-label">Plataforma:</label>
                        <select name="plataforma" id="plataforma" class="form-control"> 
                            <option value="nintendoNes">Nintendo nes</option>
                            <option value="superNintendo">Super Nintendo</option>
                            <option value="play2">Playstation2</option>
                            <option value="megaDrive">Mega Drive</option>
                            <option value="gameboy">Game Boy</option>
                        </select>      
                      </div>
                      <div class="mb-4">
                        <label for="imagen">Imágen:</label>
                        <input type="file" name="imagen" id="imagen" class="form-control">
                      </div> 
                      <input type="submit" class="btn btn-success d-block mx-auto" value="Guardar">           
                   </form>         
                </div>
            </div>    
        </div>

 

        
</body>
</html>