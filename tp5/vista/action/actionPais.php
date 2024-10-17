<?php
include_once '../../configuracion.php';

// Listar comentarios
$objComentario = new AbmComentario();
$arrayComentarios = $objComentario->darArray(); // Obtener el array de comentarios

$datos = data_submitted();

// Validar si se envió el país antes de intentar usar la función country.
if (isset($datos['pais'])) {
    $pais = country($datos['pais']);
    $nombrePais = $pais->getName();
} else {
    $nombrePais = '';
}

// Obtener todos los países
$paises = countries(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Comentarios</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
            background-color: #f9f9f9;
            width: 300px;
        }
        .card h3 {
            margin: 0;
            font-size: 1.2em;
        }
        .card p {
            margin: 5px 0;
        }
        .card .fecha {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>

<div>
    <form action="./actionEvaluacion.php" method="post">
        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" required>
        
        <label for="msj">Mensaje:</label>
        <input type="text" name="msj" id="msj" required>

        <!-- Campo oculto para el país -->
        <input type="hidden" name="pais" value="<?php echo htmlspecialchars($nombrePais); ?>">

        <button type="submit">Enviar</button>
    </form>

    <?php if ($nombrePais): ?>
        <p>El país seleccionado es: <?php echo $nombrePais; ?></p>
    <?php else: ?>
        <p>No se ha seleccionado ningún país.</p>
    <?php endif; ?>
</div>

<!-- Listado de comentarios en tarjetas (cards) -->
<h2>Comentarios</h2>
<div class="comentarios">
    <?php if (count($arrayComentarios) > 0): ?>
        <?php foreach ($arrayComentarios as $comentario): ?>
            <div class="card">
                <h3>Autor: <?php echo htmlspecialchars($comentario['autor']); ?></h3>
                <p>Comentario: <?php echo htmlspecialchars($comentario['comentario']); ?></p>
                <p class="fecha">Fecha: <?php echo htmlspecialchars($comentario['fecha_creacion']); ?></p>
                <p>País: <?php echo htmlspecialchars($comentario['pais']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay comentarios disponibles.</p>
    <?php endif; ?>
</div>

</body>
=======
    <title>Pais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">    
</head>

<body class="bg-light">

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-9"> <!-- antes era <div class="col-md-8">  -->
                <!-- Card para mostrar la información del país -->                
                <?php 

                    if($nombrePais){

                        echo "<div class='card shadow'>";
                            echo "<div class='card-header bg-primary text-white text-center'>";
                            echo "<h2>" . $nombrePais . "</h2>";
                        echo "</div>";

                        echo "<div class='card-body'>";                            
                            echo "<p><strong>Nombre: </strong>" . $pais->getName() . "</p>";
                            echo "<p><strong>Capital: </strong>" . $pais->getCapital() . "</p>";
                            //echo "<p><strong>Moneda: </strong>" . $moneda . "</p>";
                            //echo "<p><strong>Idioma(s): </strong>" . $idioma . "</p>";
                            //echo "<p><strong>Paises limitrofes(s): </strong>" . $limitrofes . "</p>";
                            echo "<p><strong>Emoji: </strong>" . $pais->getEmoji() . "</p>";
                            echo "<div><strong>Bandera(s): </strong><div>" . $pais->getFlag() . "</div></div>";
                            echo "</div>";
                        echo"</div>";
                    
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

                                        //echo "<div class='form-group mb-3'>";
                                            //echo "<textarea name='descripcion' id='descripcion' class='form-control comment-box' placeholder='Escribe tu comentario aquí...'></textarea>";
                                        //echo "</div>";

                                        // Campo oculto para el país    
                                        echo "<input type='hidden' id='pais' name='pais' value='" . $nombrePais . "'>";
                                                                            
                                        echo "<input type='submit' class='btn btn-primary w-100' value='Enviar'></input>";

                                        echo "<a href='../index.php' class='btn btn-secondary mt-2'>Volver Formulario</a>"; 

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
    </div>

</body>

>>>>>>> 81e7eb3df15aad1d0301c0f0c64245556d026c3a
</html>