<?php
include_once "../../configuracion.php";

$datos = data_submitted();
$comentarios = [];

// Procesar la acción de insertar si los datos son correctos
if  (isset($datos['accion']) && $datos['accion'] === 'insertar') {

    $autor = $datos['nombre'];
    $comentario = $datos['comentario'];
    $pais= $datos['pais'];
    $fecha_creacion = date('Y-m-d H:i:s');

    $objComentario = new Comentario();

    $objComentario->setear($autor,$comentario,$fecha_creacion,$pais);

    if ($objComentario->insertar()){
        echo "\nComentario insertado con éxito¡¡¡"."\n";
    } else {
        echo "\nError al insertar la comentario " . $objComentario->getmensajeoperacion() . "\n";
    }   

    
    $parametro = "pais = '" . $pais . "'";
    $comentarios = $objComentario->listar($parametro);

    // Mostrar los comentarios
    foreach ($comentarios as $comentario) {
    echo "\nAutor: " . $comentario->getAutor() . "<br>";
    echo "Comentario: " . $comentario->getComentario() . "<br>";
    echo "Fecha de creación: " . $comentario->getFechaCreacion() . "<br>";
    echo "País: " . $comentario->getPais() . "<br><br>";
    }

    


}
// Mostrar la página con el formulario y los comentarios
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    
</body>
</html>
