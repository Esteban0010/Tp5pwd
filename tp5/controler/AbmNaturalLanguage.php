<?php

use Google\Cloud\Language\LanguageClient;

class AbmNaturalLanguage
{

    private $languageClient;

    public function __construct()
    {
        // Configuracion del cliente de Google Cloud Natural Language
        $config = include('../../credencialesGoogle.php');
        $this->languageClient = new LanguageClient([
            'projectId' => $config['google_project_id'],
            'keyFilePath' => '../../../proyecto-libreria-439019-147e9f5a0b07.json'
        ]);
    }


    public function analizarTextoYGuardar($texto)
    {
        $response = $this->languageClient->analyzeSentiment($texto);
        $sentimiento = $response->sentiment();

        $entitiesResponse = $this->languageClient->analyzeEntities($texto);
        $entidades = $entitiesResponse->entities();

        $syntaxResponse = $this->languageClient->analyzeSyntax($texto);
        $syntaxis = $syntaxResponse->tokens();

        if ($entidades == []) {
            $valEntidades = "";
        } else {
            $valEntidades = $entidades[0]["name"];
        }

        return [
            'sentimiento' => $sentimiento['score'],
            'entidades' =>  $valEntidades,
            'syntaxis' => "prueba"
        ];
    }
}
