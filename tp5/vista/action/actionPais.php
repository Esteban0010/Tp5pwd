<?php
include_once '../../configuracion.php';

$datos = data_submitted();


$pais = country($datos['pais']);

// Get all countries                            
$paises = countries(); 
echo "<br><br><div>". count($paises) . " paises hay en la libreria con códigos de países según la norma ISO 3166</div><br>";

$texto = $_POST['msj'] ?? ''; // Obtener el valor del campo de formulario

$analyzer = new SentimentAnalyzer();
$sentimiento = $analyzer->analizarSentimiento($texto);
?>


<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pais</title>
</head>

<body>
    <div>
        <?php
        
         ?>
    </div>
</body>

</html>