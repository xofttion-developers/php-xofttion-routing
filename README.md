## Xofttion Routing

Librería que proporciona mecanismos para configurar rutas de acceso (Endpoints) de nuestros API Services creados con Laravel de una manera sencilla y rápida

## Instalación

    composer require xofttion/routing

## Modo de uso

Primero debemos establecer en el `Controller` las funciones ha consumir en la solicitud del API Services, agregandole en la sección de documentación lo siguiente:

    class PhotosController extends Controller {
        
        /**
         *
         * @http(POST)
         * @route(photos)
         */
        public function store(Request $request) {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * @http(GET)
         * @route(photos)
         */
        public function index(Request $request) {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * @http(GET)
         * @route(photos\{id})
         */
        public function record(Request $request) {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * @http(PUT)
         * @route(photos\{id})
         */
        public function update(Request $request) {
            // Definir los procesos a realizar en la solicitud 
        }
        
        /**
         *
         * @http(DELETE)
         * @route(photos\{id})
         */
        public function destroy(Request $request) {
            // Definir los procesos a realizar en la solicitud 
        }
    }

Una vez realizado vamos a nuestro archivo donde se configuran las rutas de API de nuestro proyecto `Laravel` y agregamos el siguiento código

    \Xofttion\Routing\Builder::getInstance()->reader($router, PhotosController::class);

La función `reader` de la clase `\Xofttion\Routing\Builder` recibe como primer parámetro un objeto `Illuminate\Routing\Router` y de segundo la clase 
`Controller` en formato de string, para así realizar una lectura sobre sus métodos públicos, en caso tal de encontrar en la sección de la documentación 
de cada uno de estos las anotaciones de la librería, generará de manera automática las rutas de API Services del proyecto.

## Anotaciones

`@http`
Establece el método HTTP para acceso del API Endpoint. Valores posibles [POST, GET, PUT, DELETE].

`@route`
Establece el patrón URL para acceso del API Endpoint. Ejemplo (books/{book_id}).