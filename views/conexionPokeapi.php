<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body class="bg-dark">
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
        <div class="container" id="imagenes">

        </div>
       
     
</body>
</html>



<script>
    window.addEventListener('DOMContentLoaded', (event) => {
       fetch('https://pokeapi.co/api/v2/pokemon?limit=100') 
       .then(response => response.json())
       .then(data =>{
            //Pruebas de acceso a diferentes datos del array impresos en consola, sólo son pruebas, abajo está el
            // ejercicio que recupera primero los 100 pokemons y luego se realiza otra solicitud para recuperar las url y mostrarlas en el document 

            //1º prueba: Filtro por posición del array
           console.log(data.results[3].name);
            //2º prueba: Filtro por nombre    
           console.log(data.results.find(pokemon => pokemon.name === 'pikachu'));
            //3º prueba: Filtro por nombres que incluyan 'er'
           console.log(data.results.filter(nombre => nombre.name.includes('er')));

            //4º prueba: Recorrer el array results, creando un nuevo array    
           const nuevoArray = data.results.map(pokemon => {
            // Realizar operaciones o transformaciones aquí
            return {
                // Estructura de un nuevo elemento en el array
                nombre: pokemon.name,
                url: pokemon.url,
                // Otros campos o transformaciones que desees realizar
                };
            });
            console.log(nuevoArray);

           
           data.results.forEach(pokemon=>{
               
               fetch(pokemon.url)
               .then(response => response.json())
               .then(Pokemondata => {
                   
                    const imagenUrl = Pokemondata.sprites.front_default;
        
                    let img = document.createElement('img');
                    img.src = imagenUrl;
        
                    document.getElementById("imagenes").appendChild(img);
                });
            });

       });
    });
</script>

<!-- En este ejemplo, se realiza una solicitud inicial para obtener la lista de los primeros 100 Pokémon. 
Luego, para cada Pokémon en la lista, se realiza otra solicitud para obtener los detalles del Pokémon, 
incluida la URL de la imagen frontal. Estas imágenes se añaden al elemento con id "imagenes" en tu HTML. -->
