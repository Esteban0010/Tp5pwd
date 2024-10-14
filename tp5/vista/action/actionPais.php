<?php
include_once '../../configuracion.php';

$datos = data_submitted();


$pais = country($datos['pais']);
// echo $pais;
print_r($pais->getName());
// Get all countries                            
$paises = countries(); 
// echo "<br><br><div>". count($paises) . " paises hay en la libreria con códigos de países según la norma ISO 3166</div><br>";

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
            <label for="msj"></label>
            <input type="text" name="msj">
<button type="submit">enviar</button>
        </form>
        <?php
        
         ?>
    </div>
</body>

</html>