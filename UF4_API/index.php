<?php 

//Estamos utilizando CRUD (Create, Read, Update, Delete) para las operaciones de la base de datos.


//Requerimos el archivo db.php para poder usar las funciones de la base de datos
require 'ctrlActividades.php';

//Lo primero que necesitamos es el tipo de solicitud que se está haciendo get, post, put, delete. Lo haremos con $_SERVER['REQUEST_METHOD'] que nos devuelve el tipo de solicitud que se está haciendo.

$method = $_SERVER['REQUEST_METHOD']; //Guardamos el tipo de solicitud en la variable $method

//  echo $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        listActivities(); //Si la solicitud es GET, ejecutamos la función listActivities
        break;
    case 'POST':
        createActivity(); //Si la solicitud es POST, ejecutamos la función createActivity
        break;
    case 'PUT':
        updateActivity(); //Si la solicitud es PUT, ejecutamos la función updateActivity
        break;

    case 'DELETE':
        deleteActivity(); //Si la solicitud es DELETE, ejecutamos la función deleteActivity    
        break;
    
   
}


?>