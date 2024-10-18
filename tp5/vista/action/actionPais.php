<?php
include_once '../../configuracion.php';

$datos = data_submitted();

// Validar si se envió el país antes de intentar usar la instancia de una clase AbmPais().
if (isset($datos['codigoPais'])) {
    $country = new AbmPais();
    $colPaisInfo = $country->paisInformacion($datos['codigoPais']); // Obtiene un array de informacion del pais
}

// creacion de instancias de clase AbmComentario y AbmEvaluacion
$objComentario = new AbmComentario();
$arrayComentarios = $objComentario->darArray(['pais' => $colPaisInfo['nombre']]); // Obtener el array de comentarios
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

        if ($colPaisInfo) {

            echo "<div class='card shadow'>";

            echo "<div class='card-header bg-primary text-white text-center'>";
            echo "<h2>" . $colPaisInfo['nombre'] . "</h2>";
            echo "</div>";

            echo "<div class='card-body'>";
            
            // Nombre
            echo "<p><strong>Nombre: </strong>" . $colPaisInfo['nombre'] . "</p>";
            
            // Capital
            echo "<p><strong>Capital: </strong>" . $colPaisInfo['capital'] . "</p>";
            
            // Nombre Oficial
            echo "<p><strong>Nombre Oficial: </strong>" . $colPaisInfo['nombreOficial'] . "</p>";
            
            // Gentilicio
            echo "<p><strong>Gentilicio: </strong>" . $colPaisInfo['gentilicio'] . "</p>";
            
            // Idiomas
            echo "<p><strong>Idioma(s):</strong>";
            foreach ($colPaisInfo['idioma'] as $idioma) {
                echo " " . $idioma . "";
            }

            // Si Tiene Codigo Postal
            echo "</p>";
            if ($colPaisInfo['codigoPostal'] > 0) {
                echo "<p><strong>Uso de Codigo Postal: </strong>Si";
            } else {
                echo "<p><strong>Uso de Codigo Postal: </strong>No";
            }
            
            // Numero ISO
            echo "<p><strong>Numero de ISO: </strong>" . $colPaisInfo['numeroIso'] . "</p>";
            
            // Continente
            echo "<p><strong>Continente: </strong>" . $colPaisInfo['continente'] . "</p>";

            // Limitrofe
            echo "<p><strong>Limitrofe:</strong>";
            foreach ($colPaisInfo['limitrofes'] as $limitePais) {
                echo " " . $limitePais . "";
            }
            echo "</p>";

            // Latitud Maxima
            echo "<p><strong>Latitud Maxima: </strong>" . $colPaisInfo['maxLatitud'] . "</p>";
            
            // Latitud Minima
            echo "<p><strong>Latitud Minima: </strong>" . $colPaisInfo['minLatitud'] . "</p>";

            // Area
            echo "<p><strong>Area: </strong>" . $colPaisInfo['area'] . "</p>";

            // Region
            echo "<p><strong>Region: </strong>" . $colPaisInfo['region'] . "</p>";
            
            // Litoral
            if ($colPaisInfo['sinLitoral']) {
                echo "<p><strong>Litoral con el Mar: </strong>No";
            } else {
                echo "<p><strong>Litoral con el Mar: </strong>Si";
            }

            // Emoji
            echo "<p><strong>Emoji: </strong>" . $colPaisInfo['emoji'] . "</p>";

            // Bandera
            echo "<div><strong>Bandera(s): </strong><div>" . $colPaisInfo['bandera'] . "</div></div>";
            echo "</div>";
            echo "</div>";

            // <!-- Sesión de comentarios -->
            echo "<div class='row justify-content-center mt-3'>";
            echo "<div class='col-md-12'>"; // <!-- antes era <div class="col-md-8">  -->

            echo "<div class='card shadow'>";
            echo "<div class='card-header bg-success text-white text-center'>";
            echo "<h3>Dejanos tu comentario si ya visitaste " . $colPaisInfo['nombre'] . "</h3>";
            echo "</div>";

            echo "<div class='card-body'>";

            // Formulario
            echo "<form id='comment-form' action='./actionEvaluacion.php' method='POST'>";

            // Input Autor
            echo "<div class='form-group mb-3'>";
            echo "<label for='autor' class='form-label'>Autor:</label>";
            echo "<input type='text' class='form-control' name='autor' id='autor' required>";
            echo "</div>";

            // Input Mensaje
            echo "<div class='form-group mb-3'>";
            echo "<label for='msj' class='form-label'>Mensaje:</label>";
            echo "<input type='text' class='form-control' name='msj' id='msj' required>";
            echo "</div>";

            // Campo oculto para el país     
            echo "<input type='hidden' id='pais' name='pais' value='" . $colPaisInfo['nombre'] . "'>";
            // Campo oculto para el codigo ISO del país  
            echo "<input type='hidden' id='codigo' name='codigo' value='" . $datos['codigoPais'] . "'>";

            // Input Submit
            echo "<input type='submit' class='btn btn-primary w-100' value='Enviar'></input>";

            // Boton Volver
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
                $bgColor = 'bg-pastel-red'; // Rojo pastel para score menor a 0.0 (malo)
            } elseif ($score <= 0.6) {
                $bgColor = 'bg-pastel-blue'; // Azul pastel para score entre 0.0 y 0.6 (moderado)
            } else {
                $bgColor = 'bg-pastel-green'; // Verde pastel para score mayor a 0.6 (bueno)
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