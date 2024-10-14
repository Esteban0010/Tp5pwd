<?php
class Evaluacion
{

    private $id;
    private $aSentimiento;
    private $aEntidades;
    private $aSyntaxis;
    private $classText;
    private $fecha_creacion;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->aSentimiento = "";
        $this->aEntidades = "";
        $this->aSyntaxis = "";
        $this->classText = "";
    }

    public function setear($id, $aSentimiento, $aEntidades, $aSyntaxis, $classText, $fecha_creacion)
    {
        $this->setId($id);
        $this->setASentimiento($aSentimiento);
        $this->setAEntidades($aEntidades);
        $this->setASyntaxis($aSyntaxis);
        $this->setClassText($classText);
        $this->setFechaCreacion($fecha_creacion);
    }

    /*get*/
    public function getId()
    {
        return $this->id;
    }

    public function getASentimiento()
    {
        return $this->aSentimiento;
    }

    public function getAEntidades()
    {
        return $this->aEntidades;
    }

    public function getASyntaxis()
    {
        return $this->aSyntaxis;
    }

    public function getClassText()
    {
        return $this->classText;
    }

    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /*set*/
    public function setId($value)
    {
        $this->id = $value;
    }

    public function setASentimiento($value)
    {
        $this->aSentimiento = $value;
    }

    public function setAEntidades($value)
    {
        $this->aEntidades = $value;
    }

    public function setASyntaxis($value)
    {
        $this->aSyntaxis = $value;
    }

    public function setClassText($value)
    {
        $this->classText = $value;
    }

    public function setFechaCreacion($value)
    {
        $this->fecha_creacion = $value;
    }

    public function setmensajeoperacion($valor)
    {
        $this->mensajeoperacion = $valor;
    }


    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos(); // Asegúrate de que la clase BaseDatos esté correctamente configurada.

        // Ajusta la consulta SQL para la tabla "evaluacion" y busca por el campo adecuado, que en este caso sería el ID de la evaluación.
        $sql = "SELECT * FROM evaluacion WHERE id = " . $this->getId() . "'";

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql); // Ejecuta la consulta

            if ($res > -1) { // Si la consulta se ejecuta sin errores
                if ($res > 0) { // Si se encontraron registros
                    $row = $base->Registro(); // Obtén el registro actual                    
                    // Ajusta los campos según las columnas de tu tabla "evaluacion"        
                    $this->setear($row['id'], $row['sentimiento'], $row['entidades'], $row['syntaxis'], $row['class_text'], $row['fecha_creacion']);
                    $resp = true; // Carga exitosa
                }
            }
        } else {
            $this->setmensajeoperacion("Evaluacion->cargar: " . $base->getError());
        }

        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "INSERT INTO evaluacion (sentimiento, entidades, syntaxis, class_text, fecha_creacion) VALUES (
            '" . $this->getASentimiento() . "',
            '" . $this->getAEntidades() . "',
            '" . $this->getASyntaxis() . "',
            '" . $this->getClassText() . "',
            '" . $this->getFechaCreacion() . "');";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Evaluacion->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Evaluacion->insertar: " . $base->getError());
        }

        return $resp;
    }


    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos(); // Asegúrate de que la clase BaseDatos esté correctamente configurada.

        // Crear la sentencia SQL de actualización
        $sql = "UPDATE evaluacion SET 
                sentimiento='" . $this->getASentimiento() .
            "', entidades='" . $this->getAEntidades() .
            "', syntaxis='" . $this->getASyntaxis() .
            "', class_text='" . $this->getClassText() .
            "', fecha_creacion='" . $this->getClassText() .
            "' WHERE id= '" . $this->getId() . "'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Evaluacion->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Evaluacion->modificar: " . $base->getError());
        }
        return $resp;
    }


    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();

        $sql = "DELETE FROM evaluacion WHERE id=" . $this->getId();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                // Si la eliminación fue exitosa
                $resp = true;
            } else {
                // Si ocurre un error al ejecutar la consulta
                $this->setmensajeoperacion("Evaluacion->eliminar: " . $base->getError());
            }
        } else {
            // Si ocurre un error al iniciar la conexión a la base de datos
            $this->setmensajeoperacion("Evaluacion->eliminar: " . $base->getError());
        }

        return $resp; // Retorna true si la eliminación fue exitosa, de lo contrario false
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos(); // Asegúrate de que la clase BaseDatos esté correctamente configurada.

        // Sentencia SQL para seleccionar todas las filas de la tabla "evaluacion"
        $sql = "SELECT * FROM evaluacion";

        // Si hay un parámetro, se agrega a la consulta como condición WHERE
        if ($parametro != "") {
            $sql .= ' WHERE ' . $parametro;
        }

        $res = $base->Ejecutar($sql); // Ejecuta la consulta

        if ($res > -1) {
            if ($res > 0) {
                // Itera sobre cada registro y crea un objeto Evaluacion con los datos obtenidos
                while ($row = $base->Registro()) {
                    $obj = new Evaluacion();
                    $obj->setear($row['id'], $row['sentimiento'], $row['entidades'], $row['syntaxis'], $row['class_text'], $row['fecha_creacion']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            // Lanza una excepción en caso de error
            throw new Exception("Evaluacion->listar: " . $base->getError());
        }

        return $arreglo; // Retorna un arreglo con los objetos Evaluacion
    }
}
