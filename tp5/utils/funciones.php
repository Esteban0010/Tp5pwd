<?php 
function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
        
} // muestra el $_GET, $_POST y $_AAux por print_r

function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}

spl_autoload_register(function ($class_name) {
    $directorys = array(
        $_SESSION['ROOT'] . 'modelo/',
        $_SESSION['ROOT'] . 'modelo/conector/',
        $_SESSION['ROOT'] . 'controler/'
    );

    foreach ($directorys as $directory) {
        if (file_exists($directory . $class_name . '.php')) {
            require_once($directory . $class_name . '.php');
            return;
        }
    }
});

/*spl_autoload_register(function ($class_name) {
    session_start(); // esto es para que este la sesion activa

    $directorys = array(
        $_SESSION['ROOT'] . 'Modelo/',
        $_SESSION['ROOT'] . 'Modelo/conector/',
        $_SESSION['ROOT'] . 'Control/',
    );

    foreach ($directorys as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            echo "Loading class from: $file<br>";
            require_once($file);
            return;
        } else {
            echo "File not found: $file<br>";
        }
    }
});*/


?>