<?php

class Comentario{

    private $id;
    private $descripcion;
    private $pais; 
    private $mensajeoperacion;

    public function __construct()
    {
        $this->id = "";
        $this->descripcion = "";
        $this->pais = "";
        $this->mensajeoperacion = "";
    }

    public function setear($id, $descripcion, $pais)
    {
        $this->setid($id);
        $this->setDescripcion($descripcion);
        $this->setPais($pais);
    }

    /* get */
    public function getId()
    {
        return $this->id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }
    
    /* set */
    public function setId($valor)
    {
        $this->id = $valor;
    }

    public function setDescripcion($valor)
    {
        $this->descripcion = $valor;
    }

    public function setPais($valor)
    {
        $this->pais = $valor;
    }
    
    public function setmensajeoperacion($valor)
    {
        $this->mensajeoperacion = $valor;
    }

    /* Metodos del Objeto*/
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM comentario WHERE id = " . $this->getId();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $this->setear($row['id'], $row['descripcion'], $row['pais']);
                }
            }
        } else {
            $this->setmensajeoperacion("Comentario->listar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO comentario(descripcion, pais)  VALUES('" . $this->getDescripcion() . "','" . $this->getPais() ."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setId($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Comentario->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Comentario->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE comentario SET descripcion='" . $this->getDescripcion() . "', pais='" . $this->getPais() . "' WHERE id=" . $this->getId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Comentario->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Comentario->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM comentario WHERE id=" . $this->getId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Comentario->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Comentario->eliminar: " . $base->getError());
        }
        return $resp;
    }


    //retorna un array
    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM comentario ";
        
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        
        if ($res > -1) {
            
            if ($res > 0) {
                while ($row = $base->Registro()) {                    
                    // Objeto Comentario
                    $obj = new Comentario();
                    $obj->setear($row['id'], $row['descripcion'], $row['pais']);
                    array_push($arreglo, $obj);
                }                
            }  

        } else {
            //$this->setmensajeoperacion("Comentario->listar: " . $base->getError());
            throw new Exception("Comentario->listar: " . $base->getError());
        }

        return $arreglo;
    }

}
?>