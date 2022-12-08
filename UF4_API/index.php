<?php 

//Requerimos el archivo db.php para poder usar las funciones de la base de datos
require 'ctrlActividades.php';

//Lo primero que necesitamos es el tipo de solicitud que se está haciendo get, post, put, delete. Lo haremos con $_SERVER['REQUEST_METHOD'] que nos devuelve el tipo de solicitud que se está haciendo.

$method = $_SERVER['REQUEST_METHOD']; //Guardamos el tipo de solicitud en la variable $method

//  echo $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        listActivities();
        break;
    case 'POST':
        $actividad = json_decode(file_get_contents('php://input')); //Recibimos los datos de la actividad en formato JSON y los decodificamos con json_decode
        createActivity($actividad); //Llamamos a la función createActivity y le pasamos como parámetro los datos de la actividad
        break;
    
    default:
        # code...
        break;
}

?>