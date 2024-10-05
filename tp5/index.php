<?php


$config = include('config/config.php');
require 'vendor/autoload.php';

use Google\Cloud\Language\LanguageClient;


$languageClient = new LanguageClient([
    'projectId' => $config['google_project_id'],
    'keyFilePath' => '/configuracion.php' // ruta a tu archivo de credenciales
]);;
$documento = $languageClient->analyzeSentiment($texto);
$sentimiento = $documento->sentiment();
     function __construct() {
        $config = include('config/config.php');
      $languageClient = new LanguageClient([
            'projectId' => $config['google_project_id'],
            'keyFilePath' => '/path/to/your/keyfile.json' // ruta a tu archivo de credenciales
        ]);
    }

     function analizarSentimiento($texto) {
        $documento = $languageClient->analyzeSentiment($texto);
        $sentimiento = $documento->sentiment();
        
        include_once('views/resultado_sentimiento.php');
    }


?>