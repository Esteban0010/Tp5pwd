<?php 
require 'vendor/autoload.php';

use Google\Cloud\Language\LanguageClient;

class NaturalLanguageController {
    private $languageClient;

    public function __construct() {
        $config = include('config/config.php');
        $this->languageClient = new LanguageClient([
            'projectId' => $config['google_project_id'],
            'keyFilePath' => '/path/to/your/keyfile.json' // ruta a tu archivo de credenciales
        ]);
    }

    public function analizarSentimiento($texto) {
        $documento = $this->languageClient->analyzeSentiment($texto);
        $sentimiento = $documento->sentiment();
        
        include_once('views/resultado_sentimiento.php');
    }
}