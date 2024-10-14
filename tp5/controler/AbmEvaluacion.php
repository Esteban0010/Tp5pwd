<?php
class AbmEvaluacion {
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Evaluacion
     */
    private function cargarObjeto($param) {
        $obj = null;

        if( array_key_exists('id',$param) && array_key_exists('sentimiento',$param) && array_key_exists('entidades',$param) && array_key_exists('syntaxis',$param)  && array_key_exists('class_text',$param) && array_key_exists('fecha_creacion',$param)){

            $obj = new Evaluacion();            

            $obj->setear($param['id'], $param['sentimiento'], $param['entidades'], $param['syntaxis'],
            $param['class_text'],
            $param['fecha_creacion'],);

        }
        return $obj;;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Evaluacion
     */
    private function cargarObjetoConClave($param) {
        $obj = null;

        if (isset($param['id'])) {
            $obj = new Evaluacion();
            $obj->setear($param['id'], null, null, null, null, null);
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

            if (isset($param['sentimientos'])) {
                $where .= " sentimientos ='" . $param['sentimientos'] . "'";
            }

            if (isset($param['entidades'])) {
                $where .= " entidades ='" . $param['entidades'] . "'";
            }

            if (isset($param['syntaxis'])) {
                $where .= " syntaxis = '" . $param['syntaxis'] . "'";
            }

            if (isset($param['class_text'])) {
                $where .= " class_text ='" . $param['class_text'] . "'";
            }

            if (isset($param['fecha_creacion'])) {
                $where .= " fecha_creacion ='" . $param['fecha_creacion'] . "'";
            }
            
        }
        $arreglo = Evaluacion::listar($where);
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
                    'sentimiento' => $objComentario->getDescripcion(),
                    'entidades' => $objComentario->getPais(),
                    'syntaxis' => $objComentario->getId(),
                    'class_text' => $objComentario->getDescripcion(),
                    'fecha_creacion' => $objComentario->getPais()                     
                ];

                array_push($listadoArray, $arrayComentario);
            }
        }
        return  $listadoArray;
    }
}
