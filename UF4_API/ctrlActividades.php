<?php

require 'db.php';

//Funcion que devuelve un array con todas las actividades de la base de datos. Sera la funcion que reciba (mediante un GET) desde POSTMAN en nuestro caso o desde la web en el caso de la aplicación
function listActivities()
{

    global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

    $sqlQuery = "SELECT * FROM actividades"; //Creamos la consulta sql

    $resultado = $conexion->query($sqlQuery); //Ejecutamos la consulta sql y guardamos el resultado en la variable $resultado

    $actividades = []; //Creamos un array vacío para guardar los datos de la consulta sql

    if ($resultado->num_rows > 0) { //Si el número de filas de la consulta sql es mayor que 0, es decir, si hay datos en la tabla actividades de la base de datos, se ejecuta el bucle while
        while ($fila = $resultado->fetch_assoc()) {
            array_push($actividades, $fila); //Añadimos cada fila de la consulta sql al array $actividades
        }

        header("HTTP/1.1 200 OK"); //Si todo ha ido bien, devolvemos el código de estado 200 OK
        echo json_encode($actividades); //Codificamos el array $actividades en formato JSON con la función json_encode  y lo devolvemos
    } else {
        header('HTTP/1.1 500 Internal Server Error'); //Si no hay datos en la tabla actividades de la base de datos, devolvemos el código de estado 500 Internal Server Error
    }



    return $actividades;
}


//Funcion para insertar una actividad. La funcion no recibe parametros de entrada y devuelve un array con el resultado de la operacion
function createActivity()
{ {
        global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

        $actividad = json_decode(file_get_contents('php://input'), true); //Recibimos los datos de la actividad en formato JSON con file_get_contents que lee el contenido de un fichero y lo devuelve como una cadena. Después decodificamos los datos de la actividad con json_decode y los guardamos en la variable $actividad como un objeto con las propiedades titulo, ciudad, tipo, fecha, precio y usuario. El parámetro true que le pasamos a json_decode nos devuelve un array asociativo en lugar de un objeto.

        $sqlQuery = "INSERT INTO actividades (titulo, ciudad, tipo,fecha, precio, usuario) VALUES (?, ?, ?, ?, ?, ?)"; //Creamos la consulta sql

        $resultado = $conexion->prepare($sqlQuery); //Ejecutamos la consulta sql y guardamos el resultado en la variable $resultado.

        
        //En la consulta sql, los valores que recibimos de la actividad los sustituimos por signos de interrogación. Los valores de la actividad los pasamos como parámetros a la función bind_param de la variable $resultado. bind_param recibe como primer parámetro los tipos de datos de los valores que vamos a pasar como parámetros. Los tipos de datos que podemos pasar son: s (string), i (integer), d (double), b (blob). Después de los tipos de datos, pasamos los valores de la actividad como parámetros. El número de parámetros que pasamos debe coincidir con el número de signos de interrogación que hay en la consulta sql.
        $resultado->bind_param('ssssds',             
                                $actividad["titulo"],
                                $actividad["ciudad"],
                                $actividad["tipo"],
                                $actividad["fecha"],
                                $actividad["precio"],
                                $actividad["usuario"]
        );

        $resultado->execute();
        if ($resultado->num_rows > 0) { //Si el número de filas de la consulta sql es mayor que 0, es decir, si hay datos en la tabla actividades de la base de datos, se ejecuta el bucle while
            
            header("HTTP/1.1 200 OK"); //Si todo ha ido bien, devolvemos el código de estado 200 OK
           
        } else {
            header('HTTP/1.1 500 Internal Server Error'); //Si no hay datos en la tabla actividades de la base de datos, devolvemos el código de estado 500 Internal Server Error
        }

    }
}


//Funcion para actualizar una actividad. Recibe la id de la actividad a actualizar mediante un get
function updateActivity()
{
    global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

    $id = $_GET['id']; //Recibimos la id de la actividad a actualizar mediante un get

    $actividad = json_decode(file_get_contents('php://input'), true); //Recibimos los datos de la actividad en formato JSON con file_get_contents y los decodificamos con json_decode

    $sqlQuery = "UPDATE actividades SET titulo = ?, ciudad = ?, tipo = ?, fecha = ?, precio = ?, usuario = ? WHERE id = ?";

    $resultado = $conexion->prepare($sqlQuery);
    $resultado->bind_param(
        'ssssdsi',
        $actividad["titulo"],
        $actividad["ciudad"],
        $actividad["tipo"],
        $actividad["fecha"],
        $actividad["precio"],
        $actividad["usuario"],
        $id
    );

    $resultado->execute();
    if ($resultado->num_rows > 0) { //Si el número de filas de la consulta sql es mayor que 0, es decir, si hay datos en la tabla actividades de la base de datos, se ejecuta el bucle while

        header("HTTP/1.1 200 OK"); //Si todo ha ido bien, devolvemos el código de estado 200 OK

    } else {
        header('HTTP/1.1 500 Internal Server Error'); //Si no hay datos en la tabla actividades de la base de datos, devolvemos el código de estado 500 Internal Server Error
    }
}


//Funcion para eliminar una actividad. Recibe la id de la actividad a eliminar mediante un get
function deleteActivity()
{
    global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

    $id = $_GET['id']; //Recibimos la id de la actividad a eliminar mediante un get

    $sqlQuery = "DELETE FROM actividades WHERE id = ?";

    $resultado = $conexion->prepare($sqlQuery); //Ejecutamos la consulta sql y guardamos el resultado en la variable $resultado
    $resultado->bind_param('i', $id); //Añadimos los parámetros a la consulta sql. Con bind_param indicamos el tipo de dato de cada parámetro y el valor de cada parámetro

    $resultado->execute();

    if ($resultado->num_rows > 0) { //Si el número de filas de la consulta sql es mayor que 0, es decir, si hay datos en la tabla actividades de la base de datos, se ejecuta el bucle while
        
        header("HTTP/1.1 200 OK"); //Si todo ha ido bien, devolvemos el código de estado 200 OK
       
    } else {
        header('HTTP/1.1 500 Internal Server Error'); //Si no hay datos en la tabla actividades de la base de datos, devolvemos el código de estado 500 Internal Server Error
    }
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