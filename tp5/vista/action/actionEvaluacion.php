<?php
include_once '../../configuracion.php';

$datos = data_submitted();

if (isset($datos) && isset($datos['msj']) && isset($datos['autor']) && isset($datos['pais'])) {
    // Obtener los valores del formulario
    $texto = $datos['msj'];
    $autor = $datos['autor'];
    $pais = $datos['pais'];

    // Crear un nuevo comentario
    $comentarioAbm = new AbmComentario();
    $paramComentario = [
        'autor' => $autor,
        'comentario' => $texto,
        'fecha_creacion' => date('Y-m-d H:i:s'), // Fecha actual
        'pais' => $pais
    ];
$objComentario="";
    // Alta de comentario y obtener el ID del comentario creado
    if ($objComentario = $comentarioAbm->alta($paramComentario)) {
        

        // Analizar el texto usando Google Natural Language
        $analyzer = new AbmNaturalLanguage();
        $sentimiento = $analyzer->analizarTextoYGuardar($texto);

        // Crear una evaluación con el ID del comentario y los resultados del análisis
        $evaluacionAbm = new AbmEvaluacion();
        $paramEvaluacion = [
            'objComentario' => $objComentario,
            'sentimiento' => $sentimiento['sentimiento'],
            'entidades' => $sentimiento['entidades'],
            'syntaxis' => $sentimiento['syntaxis'],
        ];

        if ($evaluacionAbm->alta($paramEvaluacion)) {
            echo "Evaluación creada correctamente con el comentario ";
        } else {
            echo "Error al crear la evaluación.";
        }
    } else {
        echo "Error al crear el comentario.";
    }
} else {
    echo "No se recibieron todos los datos necesarios.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>Evaluación completada</div>
</body>
</html>