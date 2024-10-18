<?php

use Google\Cloud\Language\LanguageClient;

class AbmNaturalLanguage {

    private $languageClient;

    public function __construct()
    {
        // Configuración del cliente de Google Cloud Natural Language
        $config = include('../../credencialesGoogle.php');
        $this->languageClient = new LanguageClient([
            'projectId' => $config['google_project_id'],
            'keyFilePath' => '../../../analisis-de-datos-437621-f4b9e9b5a2af.json' // Reemplaza con la ruta a tu archivo de credenciales
        ]);
    }

    /**
     * Analiza un texto usando Google Cloud Natural Language y guarda los resultados en la DB.
     */
    public function analizarTextoYGuardar($texto)
    {
       
            // Realiza el análisis del texto
            $response = $this->languageClient->analyzeSentiment($texto);
            $sentimiento = $response->sentiment();

            $entitiesResponse = $this->languageClient->analyzeEntities($texto);
            $entidades = $entitiesResponse->entities();
        
            $syntaxResponse = $this->languageClient->analyzeSyntax($texto);
            $syntaxis = $syntaxResponse->tokens();
            
            if($entidades == [] ){
$valEntidades = "";
            }else{
                $valEntidades = $entidades[0]["name"];
            }
            
            return [
                'sentimiento' => $sentimiento['score'],
                'entidades' =>  $valEntidades,
                'syntaxis' => "prueba"
            ];
        
    }

}