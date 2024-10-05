<?php

require '../vendor/autoload.php';

use Google\Cloud\Language\LanguageClient;

class SentimentAnalyzer {
    private $languageClient;

    public function __construct() {
        $config = include('./configuracion.php');
        $this->languageClient = new LanguageClient([
            'projectId' => $config['google_project_id'],
            'keyFilePath' => '../analisis-de-datos-437621-f4b9e9b5a2af.json' // ruta a tu archivo de credenciales
        ]);
    }

    public function analizarSentimiento($texto) {
        $documento = $this->languageClient->analyzeSentiment($texto);
        return $documento->sentiment();
    }
}

$texto = $_GET['msj'] ?? ''; // Obtener el valor del campo de formulario

$analyzer = new SentimentAnalyzer();
$sentimiento = $analyzer->analizarSentimiento($texto);

?>

<div>
    <form action="" method="get">
        <label for="msj">Mensaje:</label>
        <input name="msj" type="text">
        <button type="submit">Enviar</button>
    </form>

    <p>
        <?php
        $sentimiento["magnitude"];
       print_r($sentimiento);
        if (isset($sentimiento["magnitude"])) {
            echo "El sentimiento es: " . $sentimiento["magnitude"];
        } else {
            echo "No se encontró la magnitud.";
        }
        ?>
    </p>
</div>