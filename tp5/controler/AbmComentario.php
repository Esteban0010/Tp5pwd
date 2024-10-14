<?php
class AbmComentario {
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Comentario
     */
    private function cargarObjeto($param) {
        $obj = null;

        if( array_key_exists('id',$param) && array_key_exists('id_evaluacion',$param) && array_key_exists('email_autor',$param) && array_key_exists('comentario',$param) && array_key_exists('fecha_creacion',$param) && array_key_exists('pais',$param)){

            $objEvaluacion=new Evaluacion();
            $objEvaluacion->setId($param['id_evaluacion']);
            $objEvaluacion->cargar();

            $obj = new Comentario();
            $obj->setear($param['id'],$objEvaluacion, $param['autor'], $param['email_autor'], $param['comentario'], $param['fecha_creacion'], $param['pais']);

        }
        return $obj;;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Comentario
     */
    private function cargarObjetoConClave($param) {
        $obj = null;

        if (isset($param['id'])) {
            $obj = new Comentario();
            $obj->setear($param['id'], null, null, null, null, null, null);
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return BOOLEAN
     */
    private function seteadosCamposClaves($param) {
        $resp = false;
        if (isset($param['id']))
            $resp = true;
        return $resp;
    }

    /**
     * Alta (A): Es el proceso de crear o agregar un nuevo objeto o registro a un sistema.
     * @param array $param
     */
    public function alta($param) { //agrega
        $resp = false;
        $objComentario = $this->cargarObjeto($param);
        if ($objComentario != null && $objComentario->insertar()) { // no hay que poner datos nulos pienso
            $resp = true;
        }
        return $resp;
    }

    /**
     * Baja (B): Se refiere a eliminar un objeto o registro existente.
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param) { //elimina
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objComentario = $this->cargarObjetoConClave($param);
            if ($objComentario!=null && $objComentario->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Modificación (M): Es la actualización de la información de un objeto o registro existente.
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objComentario = $this->cargarObjeto($param);
            if ($objComentario != null && $objComentario->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * permite buscar un objeto
     * @param array $param
     * @return ARRAY
     */
    public function buscar($param) {
        $where = "";
        if ($param <> NULL) {

            if (isset($param['id'])) {
                $where .= " id = '" . $param['id'] . "'";
            }

            if (isset($param['id_evaluacion'])) {
                $where .= " id_evaluacion ='" . $param['id_evaluacion'] . "'";
            }

            if (isset($param['autor'])) {
                $where .= " autor ='" . $param['autor'] . "'";
            }

            if (isset($param['email_autor'])) {
                $where .= " email_autor = '" . $param['email_autor'] . "'";
            }

            if (isset($param['comentario'])) {
                $where .= " comentario ='" . $param['comentario'] . "'";
            }

            if (isset($param['fecha_creacion'])) {
                $where .= " fecha_creacion ='" . $param['fecha_creacion'] . "'";
            }

            if (isset($param['pais'])) {
                $where .= " pais ='" . $param['pais'] . "'";
            }
            
        }
        $arreglo = Comentario::listar($where);
        return $arreglo;
    }

    /**
     * permite dar un array de los datos del objeto
     * @param array $param
     * @return ARRAY
     */
    public function darArray($param) {
        
        $arregloObjComentario = $this->buscar($param);
        $listadoArray = [];

        if (count($arregloObjComentario) > 0) {

            foreach ($arregloObjComentario as $objComentario) {
                $arrayComentario = [
                    'id' => $objComentario->getId(),
                    'objEvaluacion' => [
                        'NroDni' => $objComentario->objEvaluacion()->getId(),
                        'Apellido' => $objComentario->objEvaluacion()->getASentimiento(),
                        'Nombre' => $objComentario->objEvaluacion()->getAEntidades(),
                        'fechaNac' => $objComentario->objEvaluacion()->getASyntaxis(),
                        'Telefono' => $objComentario->objEvaluacion()->getClassText(),
                        'Domicilio' => $objComentario->objEvaluacion()->getFechaCreacion(),
                    ],
                    'autor' => $objComentario->getAutor(),   
                    'email_autor' => $objComentario->getEmailAutor(),
                    'comentario' => $objComentario->getComentario(),
                    'fecha_creacion' => $objComentario->getFechaCreacion(),                  
                    'pais' => $objComentario->getPais()
                ];

                array_push($listadoArray, $arrayComentario);
            }
        }
        return  $listadoArray;
    }
}
