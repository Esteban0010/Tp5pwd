<?php
include_once '../../configuracion.php';

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

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pais</title>
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
</body>

</html>

</html>