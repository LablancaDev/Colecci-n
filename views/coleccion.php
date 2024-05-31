<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/coleccion.css">
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
        <!-- 2 Formas de crear los select, por plataforma de manera manual y generos realizando una consulta a la base de datos
            para recuperar los datos a través de diferentes archivo basados en el MVC y mostrándolos en la vista
            esta última forma tiene más escalabilidad a largo plazo. -->
        <div class="container">
            <h2 class="text-light mt-4">Mi Colección</h2>
            <div class="row">
                <div class="col-md-3 text-light">
                    <label for="plataforma" class="form-label">Filtrar por plataforma: </label>
                    <select name="plataforma" id="plataforma" class="form-control">
                        <option value="NintendoNes">Nintendo Nes</option>
                        <option value="SuperNintendo">Super Nintendo</option>
                        <option value="Play2">Playstation2</option>
                        <option value="Megadrive">Mega Drive</option>
                        <option value="GameBoy">Game Boy</option>
                    </select>
                </div>
                <div class="col-md-3 text-light me-4">
                    <label for="genero" class="form-label">Filtrar por Género: </label>
                   <select name="genero" id="genero" class="form-control">

                    <!-- Incluyo el archivo para realizar una instancia de clase que me permite recuperar el método y 
                        la variable que contiene el array de generos para mostrar los datos-->
                       <?php include '../controls/controlGestionGeneros.php';
                            $controlador = new ControladorGeneros();
                            $generos = $controlador->mostrarGenerosEnVista(); 

                              foreach($generos as $genero): ?>   
                            
                            <option value=" <?php echo $genero['nombre_genero'] ?> "><?php echo $genero['nombre_genero'] ?></option>
                            
                        <?php endforeach?>    
                   </select>         
                </div>
                <div class="col-md-5 text-light">
                    <label for="buscar" class="form-label">Busqueda por Título:</label>
                    <div class="d-flex ">
                        <input type="search" name="buscar" id="buscar" class="form-control me-2">
                        <button id="btnBuscar" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="contenido-imagenes" class="mt-4">
                    <!-- Contenido donde se muestran las imágenes de forma dinámica -->
                </div>
            </div>
        </div>
        <script>
            /*
            -EVENTO MOSTRAR TODAS LAS IMÁGENES-
            Evento que al cargarse la página realizar una petición fetch para cargar las imágenes de los títulos desde la base de datos*/ 
            window.addEventListener('DOMContentLoaded', (event) => {
              // Cuando la página cargue, realiza una solicitud para obtener las URLs de las imágenes  
                fetch('../controls/controlGestionImagenes.php')
                // Se espera una respuesta en formato Json
                .then(response => response.json())
                .then(data =>{
                    // console.log(data);

                    const imagenesContainer = document.getElementById("contenido-imagenes");
                    data.forEach(url =>{
                        const divElement = document.createElement('div');

                        // Establecer el estilo para que sea un elemento en línea y se posiciones en horizontal en lugar de forma vertical
                        // ya que los div son elementos de bloque
                        divElement.style.display = "inline-block";

                        // divElement.style.width = '250px';
                        // divElement.style.height = '350px';

                        // divElement.style.backgroundColor = 'white';

                        divElement.style.margin = '5px';

                        const imgElement = document.createElement('img');

                        imgElement.src = url;
                        imgElement.style.maxWidth = "200px";

                        divElement.appendChild(imgElement);
                        imagenesContainer.appendChild(divElement);
                    }); 
                })
                .catch(error => {
                    console.log('Error en la solicitud fetch' . error);
                });
                
            });

            // -EVENTO MOSTRAR LAS IMÁGENES POR FILTRO DE PLATAFORMA-

            document.getElementById("plataforma").addEventListener("change", function (event){ // uso el evento change en lugar de click para lograr capturar el cambio de selección 
                let plataformaSeleccionada = event.target.value;
                // console.log(plataformaSeleccionada);
                // Envío la plataforma por el méotodo GET 
                fetch(`../controls/controlGestionImagenes.php?plataforma=${plataformaSeleccionada}`)
                .then(response => response.json())
                .then(data =>{
                    // console.log(data);
                    /*cuando recibes la respuesta JSON en la solicitud fetch, debes asegurarte de que data sea un array de URLs. 
                    En tu caso, deberías poder acceder a las URLs directamente como data ya que estás devolviendo un array de URLs en JSON.*/ 
                    
                    // Limpiar el contenedor de imágenes antes de mostrar las nuevas imágenes filtradas por plataforma
                    const imagenesContainer = document.getElementById("contenido-imagenes");
                    imagenesContainer.innerHTML = '';
                        
                    data.forEach(url =>{
                        const divElement = document.createElement('div');

                        divElement.style.margin = '5px';
                        divElement.style.display = 'inline-block';

                        const imgElement = document.createElement('img');

                        imgElement.src = url;
                        imgElement.style.maxWidth = '200px';

                        divElement.appendChild(imgElement);
                        imagenesContainer.appendChild(divElement);

                    });
            

                })
                .catch(error => {
                    console.log('Error en la solicitud fetch' . error);
                });
            });

            //  -EVENTO MOSTRAR LAS IMÁGENES POR FILTRO DE GÉNERO-

            document.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById("genero").addEventListener("change", function(event){
                    let generoSeleccionado = event.target.value;
                    
                    fetch(`../controls/controlGestionImagenes.php?genero=${generoSeleccionado}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                    // Limpiar el div de nuevo 
                    const imagenesContainer = document.getElementById("contenido-imagenes")
                    imagenesContainer.innerHTML = '';
                        
                        data.forEach(url => {
                            const divElement = document.createElement('div');

                            const imgElement = document.createElement('img');

                            imgElement.src = url;

                            divElement.appendChild(imgElement);
                            imagenesContainer.appendChild(divElement);

                            //REVISAR: NO FUNCIONA PROBLEMA DE SINCRONISMO.. SI PONGO LAS OPTIONS EN MANUAL SI FUNCIONA
                        });
                    });
                });
            });


            // -BÚSQUEDA DE IMÁGENES DE FORMA DINÁMICA-

            // En lugar de utilizar fetch con then como en las peticiones anteriores, voy a uilizar async/await por cambiar y probar

    // Este evento se dispara cuando todo el contenido HTML del documento se ha cargado.        
    window.addEventListener('DOMContentLoaded', (event) => {
        const buscarInput = document.getElementById("buscar");
        const imagenesContainer = document.getElementById("contenido-imagenes");

        // Agregar un evento input para realizar la búsqueda dinámica mientras escribes
        buscarInput.addEventListener("input", async function (event) {
            // Obtiene el valor actual del campo de búsqueda (el título ingresado por el usuario)
            const tituloBusqueda = event.target.value;

            try {
                // Realizar la solicitud fetch para obtener las imágenes filtradas por título, con await se suspende la ejecución del código hasta que la promesa que está esperando se resuelva.
                const response = await fetch(`../controls/controlGestionImagenes.php?nombre_titulo=${tituloBusqueda}`);
                // Convierte la respuesta a formato JSON
                const data = await response.json();
                /*cada vez que uses await dentro de una función, asegúrate de que la función contenedora esté marcada como async.*/ 

                // console.log(data);

                // Limpiar el div de imágenes y mostrar las nuevas imágenes
                imagenesContainer.innerHTML = '';

                // Itera sobre cada URL de imagen en los datos recibidos
                data.forEach(url => {
                    const divElement = document.createElement('div');

                    divElement.style.display = 'inline-block';
                    divElement.style.padding = '5px';

                    const imgElement = document.createElement('img');
                    imgElement.src = url;
                    imgElement.style.maxWidth = '200px';

                    divElement.appendChild(imgElement);
                    imagenesContainer.appendChild(divElement);
                });

            } catch (error) {
                console.log('Error en la solicitud fetch de imágenes: ' + error);
            }
        });
    });
    /*Evento Input:
    
    El evento input se dispara cada vez que el usuario escribe, borra o modifica cualquier carácter en el campo de búsqueda (buscarInput). 
    La línea const tituloBusqueda = event.target.value; está obteniendo el valor actual del campo de búsqueda en ese momento, que representa 
    el título ingresado por el usuario.

    Entonces, si escribes "p", tituloBusqueda contendrá "p". Si sigues escribiendo "pa", tituloBusqueda contendrá "pa". En cada etapa, se 
    realiza una solicitud fetch a la base de datos para obtener las imágenes que coincidan con el título actual ingresado.
    
    
    Flujo de Ejecución del código:
    
    1.DOMContentLoaded Evento:

    Se agrega un evento DOMContentLoaded al objeto window. Este evento se dispara cuando todo el contenido de la página HTML y sus recursos asociados se han cargado.
    Cuando se dispara este evento, se ejecuta la función asincrónica asociada que realiza algunas configuraciones iniciales.
    
    2.Asignación de Evento input:

    Se obtiene el elemento del DOM con el id "buscar" (presumiblemente, un campo de entrada de texto) y se almacena en la variable buscarInput.
    Se obtiene el elemento del DOM con el id "contenido-imagenes" y se almacena en la variable imagenesContainer.
    Se agrega un evento input al campo de entrada de texto (buscarInput).
    La función asociada al evento input se ejecuta cada vez que el usuario escribe en el campo de entrada de texto.
    
    3.Función del Evento input:

    La función asincrónica del evento input se ejecuta cuando el usuario escribe en el campo de entrada de texto.
    Obtiene el valor actual del campo de búsqueda (tituloBusqueda) usando event.target.value.
    Realiza una solicitud asíncrona (fetch) a ../controls/controlGestionImagenes.php pasando el valor del título como parámetro en la URL (nombre_titulo=${tituloBusqueda}).
    Espera la respuesta de la solicitud (const response = await fetch(...);).
    Convierte la respuesta a formato JSON (const data = await response.json();).
    Limpia el contenedor de imágenes (imagenesContainer.innerHTML = '';).
    Itera sobre los datos recibidos y crea elementos de imagen para mostrar en el contenedor de imágenes.
    En resumen, el primer evento (DOMContentLoaded) se utiliza para realizar configuraciones iniciales cuando la página ha cargado completamente, 
    mientras que el segundo evento (input) se utiliza para responder a la entrada del usuario en tiempo real y realizar búsquedas dinámicas mientras escriben en el campo de búsqueda.
        */ 

        </script>
  
</body>
</html>

