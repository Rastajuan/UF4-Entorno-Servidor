<?php

require "clases/actividad.php";

//Funcion para listar las actividades. Devuelve un array de objetos actividad con todas las actividades de la base de datos. Ahora estamos pidiendo las actividades a la api en vez de a la base de datos directamente. Este se ejecutara cuando se haga una solicitud GET a la api
function listActivities()
{

    $endpoint = 'http://' . $_SERVER['HTTP_HOST'] . '/UF4_API/index.php'; //Definimos la url del endpoint, en este caso es la misma que la del index de la api


    $curl = curl_init(); //Inicia una sesión cURL. curl_init() devuelve un manejador de sesión cURL en caso de éxito, FALSE en caso de error. 

    curl_setopt($curl, CURLOPT_URL, $endpoint); //Establece una opción para una transferencia cURL. CURLOPT_URL: La URL a la que se enviará la solicitud. 

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Establece una opción para una transferencia cURL. CURLOPT_RETURNTRANSFER: TRUE para devolver el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente.

    $response = curl_exec($curl); //Ejecuta una sesión cURL. curl_exec() devuelve el resultado de la transferencia en caso de éxito, FALSE en caso de error. El resultado de la transferencia se devuelve como string, a menos que CURLOPT_RETURNTRANSFER se establezca en TRUE en cuyo caso se devuelve el valor de TRUE.

    curl_close($curl); //Cierra una sesión cURL y libera los recursos. El recurso cURL dado por curl_init() se libera. Todos los recursos de sistema, memoria y archivos asociados con el recurso cURL se liberan.

    $listadoActividades = json_decode($response, true); //Decodifica un string de JSON. json_decode() toma un string de JSON y lo convierte en una variable de PHP. Devuelve un array asociativo o un objeto.

    $actividades = array(); //Creamos un array vacio

    foreach ($listadoActividades as $actividad) //Recorremos el array de actividades
    {
        $actividades[] = new Actividad($actividad["titulo"], $actividad["ciudad"], $actividad["tipo"], $actividad["fecha"], $actividad["precio"], $actividad["usuario"]); //Creamos un objeto actividad por cada actividad del array y lo añadimos al array de actividades
    }

    return $actividades; //Devolvemos el array de actividades
}


//Funcion para crear una actividad. Recibe un objeto actividad y lo añade a la base de datos. Ahora estamos pidiendo las actividades a la api en vez de a la base de datos directamente. Este se ejecutara cuando se haga una solicitud POST a la api

function createActivity($actividad)
{
    $endpoint = 'http://' . $_SERVER['HTTP_HOST'] . '/UF4_API/index.php'; //Definimos la url del endpoint, en este caso es la misma que la del index de la api

    $json = json_encode($actividad); //Codifica un valor de PHP a formato JSON. json_encode() toma una variable de PHP y la convierte a una representación JSON. Devuelve un string con la representación JSON de value si tiene éxito o FALSE si falla.

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $endpoint); //Establece una opción para una transferencia cURL. CURLOPT_URL: La URL a la que se enviará la solicitud.

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Establece una opción para una transferencia cURL. CURLOPT_RETURNTRANSFER: TRUE para devolver el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente. El parámetro POSTFIELDS se establece en un array de elementos clave/valor. El array se codifica como un string de consulta usando la codificación de caracteres aplicable y se usa como valor del parámetro POSTFIELDS. El parametro true es para que devuelva el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente.

    curl_setopt($curl, CURLOPT_POST, true); //Establece una opción para una transferencia cURL. CURLOPT_POST: TRUE para hacer una solicitud POST.

    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json')); //Establece una opción para una transferencia cURL. CURLOPT_HTTPHEADER: Un array de cabeceras a enviar con la solicitud. El tercer parámetro le dice que el contenido que le vamos a enviar es un json

    curl_setopt($curl, CURLOPT_POSTFIELDS, $json); //Establece una opción para una transferencia cURL. CURLOPT_POSTFIELDS: Los campos POST a enviar. El parámetro POSTFIELDS se establece en un array de elementos clave/valor. El array se codifica como un string de consulta usando la codificación de caracteres aplicable y se usa como valor del parámetro POSTFIELDS. 

    curl_exec($curl); //Ejecuta una sesión cURL. curl_exec() devuelve el resultado de la transferencia en caso de éxito, FALSE en caso de error. 

    curl_close($curl); //Cierra una sesión cURL y libera los recursos. El recurso cURL dado por ch será liberado. Todos los recursos de cURL, incluidos los de las opciones, los manejadores de archivos y los conjuntos de cookies, se liberarán. Se cierra la sesión cURL y se libera el recurso. Si ch es un recurso cURL múltiple, se cierran todas las sesiones cURL asociadas con el recurso y se liberan los recursos.
}

//Funcion para modificar una actividad. Recibe un objeto actividad y lo modifica en la base de datos. Ahora estamos pidiendo las actividades a la api en vez de a la base de datos directamente. Este se ejecutara cuando se haga una solicitud PUT a la api

function updateActivity($actividad)
{
    $endpoint = 'http://' . $_SERVER['HTTP_HOST'] . '/UF4_API/index.php' . $actividad->id; //Definimos la url del endpoint, en este caso es la misma que la del index de la api. Añaadimos el id de la actividad que queremos modificar al final de la url para que la api sepa que actividad queremos modificar

    $json = json_encode($actividad); //Codifica un valor de PHP a formato JSON. json_encode() toma una variable de PHP y la convierte a una representación JSON. Devuelve un string con la representación JSON de value si tiene éxito o FALSE si falla.

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $endpoint); //Establece una opción para una transferencia cURL. CURLOPT_URL: La URL a la que se enviará la solicitud.

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Establece una opción para una transferencia cURL. CURLOPT_RETURNTRANSFER: TRUE para devolver el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente. El parámetro POSTFIELDS se establece en un array de elementos clave/valor. El array se codifica como un string de consulta usando la codificación de caracteres aplicable y se usa como valor del parámetro POSTFIELDS. El parametro true es para que devuelva el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente.

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT'); //Establece una opción para una transferencia cURL. CURLOPT_CUSTOMREQUEST: Una cadena para especificar un método de solicitud diferente a GET o POST cuando se utiliza CURLOPT_POSTFIELDS para enviar una solicitud. No se admite el método GET. El método HEAD se puede utilizar para obtener solo la cabecera de una página.

    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json')); //Establece una opción para una transferencia cURL. CURLOPT_HTTPHEADER: Un array de cabeceras a enviar con la solicitud. El tercer parámetro le dice que el contenido que le vamos a enviar es un json

    curl_setopt($curl, CURLOPT_POSTFIELDS, $json); //Establece una opción para una transferencia cURL. CURLOPT_POSTFIELDS: Los campos POST a enviar. El parámetro POSTFIELDS se establece en un array de elementos clave/valor.

    curl_exec($curl); //Ejecuta una sesión cURL. curl_exec() devuelve el resultado de la transferencia en caso de éxito, FALSE en caso de error.

    curl_close($curl); //Cierra una sesión cURL y libera los recursos. El recurso cURL dado por ch será liberado. Todos los recursos de cURL, incluidos los de las opciones, los manejadores de archivos y los conjuntos de cookies, se liberarán. Se cierra la sesión cURL y se libera el recurso. Si ch es un recurso cURL múltiple, se cierran todas las sesiones cURL asociadas con el recurso y se liberan los recursos.

}

//Funcion para eliminar una actividad. Recibe un objeto actividad y lo elimina de la base de datos. Ahora estamos pidiendo las actividades a la api en vez de a la base de datos directamente. Este se ejecutara cuando se haga una solicitud DELETE a la api

function deleteActivity($actividad)
{
    $endpoint = 'http://' . $_SERVER['HTTP_HOST'] . '/UF4_API/index.php' . $actividad->id;  //Definimos la url del endpoint, en este caso es la misma que la del index de la api. Añadimos el id de la actividad que queremos eliminar al final de la url para que la api sepa que actividad queremos eliminar

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $endpoint); //Establece una opción para una transferencia cURL. CURLOPT_URL: La URL a la que se enviará la solicitud.

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Establece una opción para una transferencia cURL. CURLOPT_RETURNTRANSFER: TRUE para devolver el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente. El parámetro POSTFIELDS se establece en un array de elementos clave/valor. El array se codifica como un string de consulta usando la codificación de caracteres aplicable y se usa como valor del parámetro POSTFIELDS. El parametro true es para que devuelva el resultado de la transferencia como string del valor de curl_exec() en lugar de mostrarlo directamente.

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE'); //Establece una opción para una transferencia cURL. CURLOPT_CUSTOMREQUEST: Una cadena para especificar un método de solicitud diferente a GET o POST cuando se utiliza CURLOPT_POSTFIELDS para enviar una solicitud. No se admite el método GET. El método HEAD se puede utilizar para obtener solo la cabecera de una página.

    curl_exec($curl); //Ejecuta una sesión cURL. curl_exec() devuelve el resultado de la transferencia en caso de éxito, FALSE en caso de error.

    curl_close($curl); //Cierra una sesión cURL y libera los recursos. El recurso cURL dado por ch será liberado. Todos los recursos de cURL, incluidos los de las opciones, los manejadores de archivos y los conjuntos de cookies, se liberarán. Se cierra la sesión cURL y se libera el recurso. Si ch es un recurso cURL múltiple, se cierran todas las sesiones cURL asociadas con el recurso y se liberan los recursos.

}

//Funcion para comprobar actividad
function checkActivity()
{
    if (isset($_POST["botonEnviar"]) && $_SERVER["REQUEST_METHOD"] === 'POST') {
        $actividadNueva = new Actividad(
            $_POST["titulo"],
            $_POST["ciudad"],
            $_POST["tipo"],
            $_POST["fecha"],
            $_POST["precio"],
            $_SESSION["usuario"]["id"]
        );

        createActivity($actividadNueva);
    }
}