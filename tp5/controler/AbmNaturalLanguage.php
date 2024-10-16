<?php

use Google\Cloud\Language\LanguageClient;

class AbmNaturalLanguage {

    private $languageClient;

    public function __construct()
    {
        // Configuración del cliente de Google Cloud Natural Language
        $config = include('../../configuracionn.php');
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
            // print_r($syntaxis);
            // Convertir los resultados en formato adecuado para la base de datos
            $sentimientoScore = $sentimiento['score'];
            $entidadesJson = $entidades[0]["name"]." ".$entidades[0]["name"]; 
            $syntaxisJson = "sss";  
            return [
                'sentimiento' => $sentimiento['score'],
                'entidades' =>  $entidades[0]["name"]." ".$entidades[0]["name"],
                'syntaxis' => "Imperialismo"
            ];
        
    }

    /**
     * Listar las evaluaciones almacenadas en la base de datos.
     */
    public function listarEvaluaciones($parametro = "")
    {
        try {
            $evaluaciones = Evaluacion::listar($parametro);
            return $evaluaciones;
        } catch (Exception $e) {
            echo "Error al listar las evaluaciones: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Eliminar una evaluación de la base de datos
     */
    public function eliminarEvaluacion($id)
    {
        $evaluacion = new Evaluacion("", "", "", ""); // Crea un objeto Evaluacion vacío
        return $evaluacion->eliminar($id); // Elimina la evaluación por ID
    }

    /**
     * Modificar una evaluación en la base de datos
     */
    public function modificarEvaluacion($id, $nuevoSentimiento, $nuevasEntidades, $nuevaSintaxis, $nuevoTexto)
    {
        $evaluacion = new Evaluacion($nuevoSentimiento, $nuevasEntidades, $nuevaSintaxis, $nuevoTexto);
        return $evaluacion->modificar($id); // Modifica la evaluación por ID
    }
}