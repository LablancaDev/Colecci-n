<?php
// Paso 1: Incluimos el archivo que contiene el modelo
include '../models/modelGestionGeneros.php';

// Paso 2: Definición del Controlador
class ControladorGeneros {
    private $modelo; //La propiedad privada $modelo se utiliza para almacenar una instancia del modelo GestionGeneros

    // Constructor: Se ejecuta al crear una instancia del controlador
    public function __construct() {
        // Creamos una instancia del modelo
        $this->modelo = new GestionGeneros();
    }

    // Función que llama al modelo, esta función será llamada desde la vista (coleccion.php) para obtener los datos de los géneros
    public function mostrarGenerosEnVista() {
        // Paso 3: Obtener los géneros del modelo
        $generos = $this->modelo->obtenerGeneros();
        // Importante devolver los generos, por esto no funcionaba
        return $generos;
    }
}

?>

<!-- Al almacenar la instancia del modelo como una propiedad privada $modelo en la clase ControladorGeneros, te beneficias de varias maneras:

Reutilización del Código: Al crear la instancia del modelo en el constructor, solo necesitas hacerlo una vez. Luego, puedes utilizar esa
instancia en cualquier método de la clase sin tener que volver a crearla cada vez.

Encapsulación: Al declarar la propiedad $modelo como privada, limitas su acceso directo desde fuera de la clase. Esto es beneficioso
para controlar cómo se interactúa con el modelo desde el exterior y ayuda a mantener la integridad del objeto.

Flexibilidad: Si en el futuro necesitas cambiar la forma en que se crea o se gestiona la instancia del modelo, solo necesitas hacer modificaciones
en el constructor de ControladorGeneros, en lugar de tener que cambiar cada instancia individualmente en tu código. -->
