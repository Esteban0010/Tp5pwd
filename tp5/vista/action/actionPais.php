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
</html>