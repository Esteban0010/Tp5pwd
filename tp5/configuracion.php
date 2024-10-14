<?php

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO ='tp5pwd/tp5';

//variable que almacena el directorio del proyecto
$ROOT =$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

// Incluye el autoloader de Composer
require_once($ROOT . '../vendor/autoload.php');

// Otras inclusiones necesarias
include_once($ROOT.'utils/funciones.php');


// Variable que define la pagina de autenticacion del proyecto
$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/login/login.php";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/principal.php";


$_SESSION['ROOT']=$ROOT;

?>