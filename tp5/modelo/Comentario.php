<?php

class Comentario{

    private $id;
    private $objId_evaluacion; //obj evaluacion
    private $autor;
    private $email_autor;
    private $comentario;
    private $fecha_creacion;
    private $pais; 
    private $mensajeoperacion;

    public function __construct()
    {
        $this->id = "";
        $this->objId_evaluacion = new Evaluacion(); //obj evaluacion
        $this->autor = "";
        $this->email_autor = "";
        $this->comentario = "";
        $this->fecha_creacion;
        $this->pais = "";
        $this->mensajeoperacion = "";
    }

    public function setear($id, $objId_evaluacion, $autor, $email_autor, $comentario, $fecha_creacion, $pais)
    {
        $this->setId($id);
        $this->setObjIdEvaluacion($objId_evaluacion); // Objeto
        $this->setAutor($autor);
        $this->setEmailAutor($email_autor);
        $this->setComentario($comentario);
        $this->setFechaCreacion($fecha_creacion);
        $this->setPais($pais);        
    }

    /* get */
    public function getId()
    {
        return $this->id;
    }

    public function getObjIdEvaluacion()
    {
        return $this->objId_evaluacion;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getEmailAutor()
    {
        return $this->email_autor;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
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

    public function setObjIdEvaluacion($valor)
    {
        $this->objId_evaluacion = $valor;
    }

    public function setAutor($valor)
    {
        $this->autor = $valor;
    }

    public function setEmailAutor($valor)
    {
        $this->email_autor = $valor;
    }

    public function setComentario($valor)
    {
        $this->comentario = $valor;
    }

    public function setFechaCreacion($valor)
    {
        $this->fecha_creacion = $valor;
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
        $respuesta = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM comentarios WHERE id = " . $this->getId() . "'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();

                    // Se crea un objeto evaluacion 
                    $idEvaluacion = new Evaluacion();
                    $idEvaluacion->setId($row['id_evaluacion']); // Se asigna el id de evaluacion

                    if ($idEvaluacion->cargar()) { // Carga los datos del id evaluacion    
                        // Setea los datos del comentario junto con el objeto evaluacion                
                        $this->setear($row['id'], $row['id_evaluacion'], $row['autor'], $row['email_autor'], $row['comentario'], $row['fecha_creacion'], $row['pais']);
                        $respuesta = true;
                    }
                }
            }
        } else {
            $this->setmensajeoperacion("Comentarios->listar: " . $base->getError());
        }
        return $respuesta;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO comentarios(id_evaluacion, autor, email_autor, comentario, fecha_creacion, pais)  VALUES(
            '" . $this->getObjIdEvaluacion()->getId() . "',
            '" . $this->getAutor() . "',
            '" . $this->getEmailAutor() . "',
            '" . $this->getComentario() . "',
            '" . $this->getFechaCreacion() . "',
            '" . $this->getPais() ."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setId($elid);
                $resp = true;
            } else {
                $this->setmensajeoperacion("Comentarios->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Comentarios->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {        
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE comentarios SET 
            id_evaluacion='" . $this->getObjIdEvaluacion()->getId() . 
            "', autor='" . $this->getAutor() . 
            "', email_autor='" . $this->getEmailAutor() .
            "', comentario='" . $this->getComentario() .
            "', fecha_creacion='" . $this->getFechaCreacion() .
            "', pais='" . $this->getPais() .
            "' WHERE id=" . $this->getId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Comentarios->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Comentarios->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM comentarios WHERE id=" . $this->getId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Comentarios->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Comentarios->eliminar: " . $base->getError());
        }
        return $resp;
    }


    //retorna un array
    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM comentarios ";
        
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $res = $base->Ejecutar($sql);
        
        if ($res > -1) {
            
            if ($res > 0) {
                while ($row = $base->Registro()) {                 

                    // objeto Evaluacion
                    $idEvaluacion = new Evaluacion();
                    $idEvaluacion->setId($row['id_evaluacion']); // Se asigna el ID de la evaluacion

                    // Carga los datos del duenio desde la tabla Evaluacion
                    if ($idEvaluacion->cargar()) {

                        // Objeto Comentario
                        $obj = new Comentario();

                        // Se setea los datos del Comentario junto con el ID Evaluacion
                        $obj->setear($row['id'], $row['id_evaluacion'], $row['autor'], $row['email_autor'], $row['comentario'], $row['fecha_creacion'], $row['pais']);
                        
                        array_push($arreglo, $obj);
                    }                    
                }                
            }  

        } else {
            //$this->setmensajeoperacion("Comentario->listar: " . $base->getError());
            throw new Exception("Comentarios->listar: " . $base->getError());
        }

        return $arreglo;
    }

}
?>