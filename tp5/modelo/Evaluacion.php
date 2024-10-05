<?php

class Evaluacion{

    private $aSentimiento;
    private $aEntidades;
    private $aSyntaxis;
    private $classText;
    private $mensajeoperacion;
    

	public function __construct($aSentimiento, $aEntidades, $aSyntaxis, $classText) {

		$this->aSentimiento = $aSentimiento;
		$this->aEntidades = $aEntidades;
		$this->aSyntaxis = $aSyntaxis;
		$this->classText = $classText;
	}

	public function getASentimiento() {
		return $this->aSentimiento;
	}

	public function setASentimiento($value) {
		$this->aSentimiento = $value;
	}

	public function getAEntidades() {
		return $this->aEntidades;
	}

	public function setAEntidades($value) {
		$this->aEntidades = $value;
	}

	public function getASyntaxis() {
		return $this->aSyntaxis;
	}

	public function setASyntaxis($value) {
		$this->aSyntaxis = $value;
	}

	public function getClassText() {
		return $this->classText;
	}

	public function setClassText($value) {
		$this->classText = $value;
	}

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setmensajeoperacion($valor)
    {
        $this->mensajeoperacion = $valor;
    }
    
    public function cargar($id)
    {
        $resp = false;
        $base = new BaseDatos(); // Asegúrate de que la clase BaseDatos esté correctamente configurada.
        
        // Ajusta la consulta SQL para la tabla "evaluacion" y busca por el campo adecuado, que en este caso sería el ID de la evaluación.
        $sql = "SELECT * FROM evaluacion WHERE id = " . $id;
        
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql); // Ejecuta la consulta
            
            if ($res > -1) { // Si la consulta se ejecuta sin errores
                if ($res > 0) { // Si se encontraron registros
                    $row = $base->Registro(); // Obtén el registro actual
                    
                    // Ajusta los campos según las columnas de tu tabla "evaluacion"
                    $this->setASentimiento($row['sentimiento']);
                    $this->setAEntidades($row['entidades']);
                    $this->setASyntaxis($row['syntaxis']);
                    $this->setClassText($row['class_text']);
                    $resp = true; // Carga exitosa
                }
            }
        } else {
            $this->setmensajeoperacion("Evaluacion->cargar: " . $base->getError());
        }
        
        return $resp;
    }

    public function insertar() {
        $resp = false;
        $base = new BaseDatos();
        
        $sql = "INSERT INTO evaluacion (sentimiento, entidades, syntaxis, class_text) VALUES (
            '" . $this->getASentimiento() . "',
            '" . $this->getAEntidades() . "',
            '" . $this->getASyntaxis() . "',
            '" . $this->getClassText() . "');";

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


    public function modificar($id)
{
    $resp = -1;
    $base = new BaseDatos(); // Asegúrate de que la clase BaseDatos esté correctamente configurada.

    // Verificar que los campos no sean null o vacíos (trim elimina espacios en blanco)
    if (
        trim($this->getASentimiento()) == "" || 
        trim($this->getAEntidades()) == "" || 
        trim($this->getASyntaxis()) == "" || 
        trim($this->getClassText()) == ""
    ) {
        // Si alguno de los campos requeridos es null o está vacío, retornamos un código de error
        $this->setmensajeoperacion("Evaluacion->modificar: Los campos no pueden estar vacíos.");
    } else {
        // Crear la sentencia SQL de actualización
        $sql = "UPDATE evaluacion SET 
                sentimiento='" . $this->getASentimiento() . 
                "', entidades='" . $this->getAEntidades() . 
                "', syntaxis='" . $this->getASyntaxis() . 
                "', class_text='" . $this->getClassText() . 
                "' WHERE id= '" . $id . "'";

        if ($base->Iniciar()) {                
            $filasAfectadas = $base->Ejecutar($sql); // Ejecuta la consulta SQL

            if ($filasAfectadas >= 0) {
                if ($filasAfectadas > 0) {
                    // Se modificó correctamente
                    $resp = 1;
                } else {
                    // No se realizaron cambios
                    $resp = 0;
                }
            }
        } else {
            $this->setmensajeoperacion("Evaluacion->modificar: " . $base->getError());
        }
    }

    return $resp; // Retorna 1 si se modificó correctamente, 0 si no se realizaron cambios, -1 si hubo un error
}


public function eliminar($id)
{
    $resp = false;
    $base = new BaseDatos();

    $sql = "DELETE FROM evaluacion WHERE id=" . $id;

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
                $obj = new Evaluacion(
                    $row['sentimiento'], 
                    $row['entidades'], 
                    $row['syntaxis'], 
                    $row['class_text']
                );
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