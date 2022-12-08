<?php

require 'db.php';

//Funcion para insertar una actividad. La funcion no recibe parametros de entrada y devuelve un array con el resultado de la operacion
function createActivity()
{ {
        global $conexion;

        $actividad = json_decode(file_get_contents('php://input')); //Recibimos los datos de la actividad en formato JSON con file_get_contents y los decodificamos con json_decode

        $consulta = "INSERT INTO actividades (titulo, ciudad, tipo,fecha, precio, usuario) VALUES (?, ?, ?, ?, ?, ?)";

        $resultado = $conexion->prepare($consulta);
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
//Funcion que devuelve un array con todas las actividades de la base de datos
function listActivities()
{

    global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

    $sql = "SELECT * FROM actividades"; //Creamos la consulta sql

    $resultado = $conexion->query($sql); //Ejecutamos la consulta sql y guardamos el resultado en la variable $resultado

    $actividades = []; //Creamos un array vacío para guardar los datos de la consulta sql

    if ($resultado->num_rows > 0) { //Si el número de filas de la consulta sql es mayor que 0, es decir, si hay datos en la tabla actividades de la base de datos, se ejecuta el bucle while
        while ($fila = $resultado->fetch_assoc()) {
            array_push($actividades, $fila); //Añadimos cada fila de la consulta sql al array $actividades
        }

        header("HTTP/1.1 200 OK"); //Si todo ha ido bien, devolvemos el código de estado 200 OK
        echo json_encode($actividades); //Codificamos el array $actividades en formato JSON con la función json_encode  y lo devolvemos
    }
    else 
    {
       header('HTTP/1.1 500 Internal Server Error'); //Si no hay datos en la tabla actividades de la base de datos, devolvemos el código de estado 500 Internal Server Error
    }



    return $actividades;
}
