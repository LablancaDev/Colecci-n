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
                <a class="navbar-brand ps-3" href="principal.php">Retrocollectiongame</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" aria-current="page" href="principal.php">Gestión de la colección</a>
                        <a class="nav-link" href="coleccion.php">Colección</a>
                        <a class="nav-link" href="conexionPokeapi.php">PokeAPI</a>
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
            <h3 class="mt-4 text-light">Gestión de la colección</h3>
            <div class="row mt-4">
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar rounded">
                    <div class="position-sticky">
                        <ul class="nav flex-column text-center">
                            <li class="nav-item">
                                <h4 class="text-center p-2 text-black">Plataformas</h4>
                                <a class="nav-link plataforma" data-plataforma="nintendoNes" href="#">
                                    <img src="../assets/imgs/Nintendo.png" class="img-fluid" style="max-width:120px" alt="nes">
                                </a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link plataforma" data-plataforma="SuperNintendo" href="#">
                                    <img src="../assets/imgs/Logo_SNES.png" class="img-fluid" style="max-width:120px" alt="nes">
                                </a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link plataforma" data-plataforma="play2" href="#">
                                    <img src="../assets/imgs/Playstation2.png" class="img-fluid" style="max-width:120px" alt="nes">
                                </a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link plataforma" data-plataforma="megaDrive" href="#">
                                    <img src="../assets/imgs/Megadrive.svg" class="img-fluid" style="max-width:120px" alt="nes">
                                </a>
                            </li>
                            <li class="nav-item mt-3">
                                <a class="nav-link plataforma" data-plataforma="gameBoy" href="#">
                                    <img src="../assets/imgs/gameboy.png" class="img-fluid" style="max-width:100px" alt="nes">
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="col-md-9 fondo">
                    <button class="btn btn-success mt-3 btn-unstyled ms-3"><a href="../views/nuevoTitulo.php" class="text-light text-decoration-none">Añadir nuevo Título</a></button>
                    <div class="row m-2">
                       <div class="col-md-12 bg-white rounded shadow p-3 bg-opacity-75">
                          <div class="table-responsive mx-auto ">
                            <table class="table table-striped table-hover mt-3 text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nombre del Título</th>
                                        <th scope="col">Genero</th>
                                        <th scope="col">Plataforma</th>
                                        <th scope="col">Mostrar</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include '../models/modelGestionTitulos.php';
                                        $mostrarAlumnos = new GestionColeccion();
                                        $listaTitulos = $mostrarAlumnos->mostrarTitulos();
                                    ?>
                                        <?php foreach ($listaTitulos as $titulo): ?>
                                    <tr>
                                        <td><?php echo $titulo['id_titulo']; ?></td>
                                        <td><?php echo $titulo['nombre_titulo']; ?></td>
                                        <td><?php echo $titulo['genero']; ?></td>
                                        <td><?php echo $titulo['plataforma']; ?></td>
                                        <td><a href="../controls/controlMostrarTitulo.php?id_titulo=<?php echo $titulo['id_titulo']; ?>"><button class="btn btn-primary">Ver Título<i class="bi bi-eye"></i></button></a></td>
                                        <td><a href="../controls/controlEliminarTitulo.php?id_titulo=<?php echo $titulo['id_titulo']; ?>"><button class="btn btn-danger">Vender<i class="bi bi-trash"></i></button></a></td>
                                        <?php endforeach; ?>    
                                    </tr>
                                </tbody>
                            </table>
                          </div> 
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Este evento se dispara cuando el HTML y el DOM de la página se han cargado completamente.
            document.addEventListener('DOMContentLoaded', function () {
                // Selecciona todos los elementos con la clase CSS "plataforma" y los almacena en la variable enlacesPlataforma.
                const enlacesPlataforma = document.querySelectorAll('.plataforma');

                // Recorre cada elemento en enlacesPlataforma y ejecuta la función de devolución de llamada para cada uno.
                enlacesPlataforma.forEach(enlace => {
                    // Establece un evento de clic para cada enlace de plataforma. El parámetro event es el objeto de evento del clic.
                    enlace.addEventListener('click', function (event) {
                        event.preventDefault(); // Evitar que el enlace recargue la página
                        
                        // Usa this para referirse al enlace actual. dataset.plataforma recupera el valor del atributo de datos "data-plataforma".
                        const plataformaSeleccionada = this.dataset.plataforma;
                        // Llamada a la función actualizarTabla con la plataforma seleccionada
                        actualizarTabla(plataformaSeleccionada);
                    });
                });

                function actualizarTabla(plataforma) {

                    // Realizar una solicitud al servidor para obtener los títulos de la plataforma seleccionada.
                    fetch(`../controls/controlObtenerPlataforma.php?plataforma=${plataforma}`)
                        // Convierte la respuesta del servidor a JSON y luego maneja los datos resultantes.
                        .then(response => response.json())
                        .then(titulos => {//datos recuperados
                           console.log(titulos); 
                            // Limpiar la tabla: Selecciona la tabla y borra todo su contenido actual.
                            const tabla = document.querySelector('.table tbody');
                            tabla.innerHTML = '';

                            // Llenar la tabla con los nuevos datos
                            titulos.forEach(titulo => {
                                const fila = document.createElement('tr');
                                fila.innerHTML = `
                                    <td>${titulo.id_titulo}</td>
                                    <td>${titulo.nombre_titulo}</td>
                                    <td>${titulo.genero}</td>
                                    <td>${titulo.plataforma}</td>
                                    <td><a href="../controls/controlMostrarTitulo.php?id_titulo=${titulo.id_titulo}"><button class="btn btn-primary">Ver Título<i class="bi bi-eye"></i></button></a></td>
                                    <td><a href="../controls/controlEliminarTitulo.php?id_titulo=${titulo.id_titulo}"><button class="btn btn-danger">Vender<i class="bi bi-trash"></i></button></a></td>
                                `;
                                tabla.appendChild(fila);
                            });
                        })
                        .catch(error => {
                            console.error('Error al obtener datos del servidor:', error);
                        });
                }
            });
        </script>
                                   
 

        
</body>
</html>