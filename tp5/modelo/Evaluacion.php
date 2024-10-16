<?php
class Evaluacion
{
    private $id;
    private $objComentario;
    private $aSentimiento;
    private $aEntidades;
    private $aSyntaxis;
   
    private $mensajeoperacion;

    public function __construct($objComentario = null, $aSentimiento = null, $aEntidades = null, $aSyntaxis = null)
    {
        $this->objComentario = $objComentario;
        $this->aSentimiento = $aSentimiento;
        $this->aEntidades = $aEntidades;
        $this->aSyntaxis = $aSyntaxis;
    }

    public function setear($objComentario, $aSentimiento, $aEntidades, $aSyntaxis, )
    {
        $this->setObjComentario($objComentario);
        $this->setASentimiento($aSentimiento);
        $this->setAEntidades($aEntidades);
        $this->setASyntaxis($aSyntaxis);
      
    }

    /* Getters */
    public function getId()
    {
        return $this->id;
    }

    public function getObjComentario()
    {
        return $this->objComentario;
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



    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /* Setters */
    public function setId($value)
    {
        $this->id = $value;
    }

    public function setObjComentario($value)
    {
        $this->objComentario = $value;
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



    public function setmensajeoperacion($valor)
    {
        $this->mensajeoperacion = $valor;
    }

    /* Métodos de operación con la base de datos */
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM evaluacion WHERE id = " . $this->getId();

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1 && $row = $base->Registro()) {
                $this->setear($row['id_comentario'], $row['sentimiento'], $row['entidades'], $row['syntaxis'], );
                $resp = true;
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

        $sql = "INSERT INTO evaluacion (id_comentario, sentimiento, entidades, syntaxis) VALUES (
            '" . $this->getObjComentario()->getId() . "',
            '" . $this->getASentimiento() . "',
            '" . $this->getAEntidades() . "',
            '" . $this->getASyntaxis() . "');";

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
        $base = new BaseDatos();

        $sql = "UPDATE evaluacion SET 
                id_comentario='" . $this->getObjComentario()->getId() . "',
                sentimiento='" . $this->getASentimiento() . "',
                entidades='" . $this->getAEntidades() . "',
                syntaxis='" . $this->getASyntaxis() .  "'
                WHERE id=" . $this->getId();

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
                $resp = true;
            } else {
                $this->setmensajeoperacion("Evaluacion->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Evaluacion->eliminar: " . $base->getError());
        }

        return $resp;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();

        $sql = "SELECT * FROM evaluacion";

        if ($parametro != "") {
            $sql .= ' WHERE ' . $parametro;
        }

        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                while ($row = $base->Registro()) {
                    $objComentario = new Comentario(); // Asumiendo que tienes una clase Comentario
                    $objComentario->setId($row['id_comentario']); // Asegúrate de que la clase Comentario esté bien definida
                    $objComentario->cargar();
                    $obj = new Evaluacion($objComentario, $row['sentimiento'], $row['entidades'], $row['syntaxis']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            throw new Exception("Evaluacion->listar: " . $base->getError());
        }

        return $arreglo;
    }
}
