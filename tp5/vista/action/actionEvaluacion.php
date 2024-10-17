<?php
include_once '../../configuracion.php';

$datos = data_submitted();
$resp = null;

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
            $resp = true;
        } 
    } else {
        echo "Error al crear el comentario.";
    }
} else {
    echo "No se recibieron todos los datos necesarios.";
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentario Guardado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">
    <div class="container mt-5">
        <?php
        if ($resp) {
            echo "<div class='alert alert-success' role='alert'>";
            echo "<h4 class='alert-heading'>Comentario Guardado con Evaluacion Exitosamente!</h4>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "<h4 class='alert-heading'>Error al crear la evaluación.</h4>";
            echo "</div>";
        }
        echo "<a href='actionPais.php?pais=" . $datos['codigo'] . "&accion=accion' class='btn btn-secondary'>Volver</a>";
        ?>
    </div>
</body>
</html>