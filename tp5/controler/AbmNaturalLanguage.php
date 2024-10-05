<?php

use Google\Cloud\Language\LanguageClient;

class AbmNaturalLanguage {

    private $languageClient;

    public function __construct()
    {
        // Configuración del cliente de Google Cloud Natural Language
        $config = include('../configuracion.php');
        $this->languageClient = new LanguageClient([
            'projectId' => $config['google_project_id'],
            'keyFilePath' => '../../analisis-de-datos-437621-f4b9e9b5a2af.json' // Reemplaza con la ruta a tu archivo de credenciales
        ]);
    }

    /**
     * Analiza un texto usando Google Cloud Natural Language y guarda los resultados en la DB.
     */
    public function analizarTextoYGuardar($texto)
    {
        try {
            // Realiza el análisis del texto
            $response = $this->languageClient->analyzeSentiment($texto);
            $sentimiento = $response->sentiment();

            $entitiesResponse = $this->languageClient->analyzeEntities($texto);
            $entidades = $entitiesResponse->entities();

            $syntaxResponse = $this->languageClient->analyzeSyntax($texto);
            $syntaxis = $syntaxResponse->tokens();

            // Convertir los resultados en formato adecuado para la base de datos
            $sentimientoScore = $sentimiento['score'];
            $entidadesJson = json_encode($entidades); // Guardamos las entidades como un JSON
            $syntaxisJson = json_encode($syntaxis);   // Guardamos la sintaxis como un JSON

            // Crea un objeto de la clase Evaluacion para guardar los resultados
            $evaluacion = new Evaluacion($sentimientoScore, $entidadesJson, $syntaxisJson, $texto);

            // Inserta la evaluación en la base de datos
            if ($evaluacion->insertar()) {
                return true;
            } else {
                throw new Exception("Error al guardar la evaluación en la base de datos.");
            }

        } catch (Exception $e) {
            // Manejo de errores
            echo "Error al procesar el texto: " . $e->getMessage();
            return false;
        }
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