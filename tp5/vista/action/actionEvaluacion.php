<?php
include_once '../../configuracion.php';

$datos = data_submitted();
if( isset($datos) && $_POST['msj']){
    $texto = $_POST['msj'] ?? ''; // Obtener el valor del campo de formulario
    echo$texto;
    $analyzer = new AbmNaturalLanguage();
    $sentimiento = $analyzer->analizarTextoYGuardar($texto);
    print_r($sentimiento);
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
    <div> asdasdsad</div>
    <?php
   
    ?>
</body>
</html>