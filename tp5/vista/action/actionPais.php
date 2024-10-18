<?php
include_once '../../configuracion.php';

$datos = data_submitted();

// Validar si se envió el país antes de intentar usar la función country.
if (isset($datos['codigoPais'])) {
    $pais = country($datos['codigoPais']);
    $nombrePais = $pais->getName();
} else {
    $nombrePais = '';
}



$objComentario = new AbmComentario();
$arrayComentarios = $objComentario->darArray(['pais' => $nombrePais]); // Obtener el array de comentarios
$objEvaluaciones = new AbmEvaluacion();
$arrayEvaluaciones = $objEvaluaciones->darArray();


// Unir cada comentario con su evaluación correspondiente
foreach ($arrayComentarios as $key => $comentario) {
    $arrayComentarios[$key]['score'] = null; // Inicializar score a null
    // Buscar la evaluación que corresponde a este comentario
    foreach ($arrayEvaluaciones as $evaluacion) {
        if ($evaluacion['id_comentario'] == $comentario['id']) {
            // Agregar el score de la evaluación al array de comentarios
            $arrayComentarios[$key]['score'] = $evaluacion['sentimiento'];
            break;
        }
    }
}

?>

<?php
include_once "../estructura/Header.php";
?>

    <!-- <div class="container mt-2"> -->
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- antes era <div class="col-md-8">  -->
                <!-- Card para mostrar la información del país -->
                <?php

                if ($pais) {

                    echo "<div class='card shadow'>";
                    echo "<div class='card-header bg-primary text-white text-center'>";
                    echo "<h2>" . $nombrePais . "</h2>";
                    echo "</div>";

                    echo "<div class='card-body'>";
                    echo "<p><strong>Nombre: </strong>" . $pais->getName() . "</p>";
                    echo "<p><strong>Capital: </strong>" . $pais->getCapital() . "</p>";
                    //echo "<p><strong>Moneda: </strong>" . $moneda . "</p>";

                    // idioma del país 
                    echo "<p><strong>Idioma(s):</strong>";
                    foreach ($pais->getLanguages() as $idioma) {
                        echo " " . $idioma . " ";
                    }
                    echo "</p>";

                    //echo "<p><strong>Paises limitrofes(s): </strong>" . $limitrofes . "</p>";
                    echo "<p><strong>Emoji: </strong>" . $pais->getEmoji() . "</p>";
                    echo "<div><strong>Bandera(s): </strong><div>" . $pais->getFlag() . "</div></div>";
                    echo "</div>";
                    echo "</div>";

                    // <!-- Sesión de comentarios -->
                    echo "<div class='row justify-content-center mt-3'>";
                    echo "<div class='col-md-12'>"; // <!-- antes era <div class="col-md-8">  -->

                    echo "<div class='card shadow'>";
                    echo "<div class='card-header bg-success text-white text-center'>";
                    echo "<h3>Dejanos tu comentario si ya visitaste " . $pais->getName() . "</h3>";
                    echo "</div>";

                    echo "<div class='card-body'>";

                    echo "<form id='comment-form' action='./actionEvaluacion.php' method='POST'>";

                    echo "<div class='form-group mb-3'>";
                    echo "<label for='autor' class='form-label'>Autor:</label>";
                    echo "<input  ut type='text' class='form-control' name='autor' id='autor' required>";
                    echo "</div>";

                    echo "<div class='form-group mb-3'>";
                    echo "<label for='msj' class='form-label'>Mensaje:</label>";
                    echo "<input type='text' class='form-control' name='msj' id='msj' required>";
                    echo "</div>";

                    // Campo oculto para el país     
                    echo "<input type='hidden' id='pais' name='pais' value='" . $nombrePais . "'>";
                    // Campo oculto para el coidgo ISO del país  
                    echo "<input type='hidden' id='codigo' name='codigo' value='" . $datos['codigoPais'] . "'>";

                    echo "<input type='submit' class='btn btn-primary w-100' value='Enviar'></input>";

                    echo "<a href='../indexPrincipal.php' class='btn btn-secondary mt-2'>Volver Formulario</a>";

                    echo "</form>";

                    echo "</div>";

                    echo "</div>";
                    echo "</div>";
                } else {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '<h4 class="alert-heading">Error:</h4>';
                    echo "<p>No se ha seleccionado ningún país</p>";
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    
        <h2 class="my-4">Comentarios</h2>
        <div class="comentarios">
            <?php if (count($arrayComentarios) > 0): ?>
                <?php foreach ($arrayComentarios as $comentario): ?>
                    <?php
                    $score = $comentario['score'];

                    if ($score < 0.0) {
                        $bgColor = 'bg-danger'; // Rojo para score menor a 0.0
                    } elseif ($score <= 0.3) {
                        $bgColor = 'bg-warning'; // Naranja para score entre 0.0 y 0.3
                    } elseif ($score <= 0.6) {
                        $bgColor = 'bg-warning'; // Amarillo para score entre 0.3 y 0.6
                    } elseif ($score <= 0.8) {
                        $bgColor = 'bg-success'; // Verde para score entre 0.6 y 0.8
                    } else {
                        $bgColor = 'bg-primary'; // Azul para score mayor a 0.8
                    }
                    ?>
                    <div class="col-12 mb-3">
                        <div class="card <?php echo $bgColor; ?>">
                            <div class="card-body">
                                <h5 class="card-title">Autor: <?php echo htmlspecialchars($comentario['autor']); ?></h5>
                                <p class="card-text">Comentario: <?php echo htmlspecialchars($comentario['comentario']); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Fecha: <?php echo htmlspecialchars($comentario['fecha_creacion']); ?></small><br>
                                <small class="text-muted">País: <?php echo htmlspecialchars($comentario['pais']); ?></small><br>
                                <small class="text-muted">Score: <?php echo htmlspecialchars($score); ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p>No hay comentarios disponibles.</p>
                </div>
            <?php endif; ?>
        </div>
    


<?php
include_once "../estructura/Footer.php";
?>
