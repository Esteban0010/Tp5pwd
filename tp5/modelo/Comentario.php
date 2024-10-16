<?php

class Comentario{

    private $id;
    private $autor;
    private $comentario;
    private $fecha_creacion;
    private $pais; 
    private $mensajeoperacion;

    public function __construct()
    {
        $this->id = "";
        $this->autor = "";
        $this->comentario = "";
        $this->fecha_creacion;
        $this->pais = "";
        $this->mensajeoperacion = "";
    }

    public function setear($id,  $autor, $comentario, $fecha_creacion, $pais)
    {
        $this->setId($id);
        $this->setAutor($autor);
       
        $this->setComentario($comentario);
        $this->setFechaCreacion($fecha_creacion);
        $this->setPais($pais);        
    }

    /* get */
    public function getId()
    {
        return $this->id;
    }

    

    public function getAutor()
    {
        return $this->autor;
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

   

    public function setAutor($valor)
    {
        $this->autor = $valor;
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

    public function cargar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM comentarios WHERE id = " . $this->getId();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();     
                        $this->setear($row['id'], $row['autor'], $row['comentario'], $row['fecha_creacion'], $row['pais']);
                        $respuesta = true;
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
        if (!$this->getFechaCreacion()) {
            $this->setFechaCreacion(date('Y-m-d H:i:s'));
        }
        $sql = "INSERT INTO comentarios(autor, comentario, fecha_creacion, pais) VALUES(
            '" . $this->getAutor() . "',
            '" . $this->getComentario() . "',
            '" . $this->getFechaCreacion() . "',
            '" . $this->getPais() . "');";
        if ($base->Iniciar()) {
            if ($id = $base->Ejecutar($sql)) {
                $this->setId($id);
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
        $sql = "UPDATE comentarios SET autor='" . $this->getAutor() . 
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

                        $obj = new Comentario();

                        $obj->setear($row['id'], $row['autor'], $row['comentario'], $row['fecha_creacion'], $row['pais']);
                        
                        array_push($arreglo, $obj);
                                     
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