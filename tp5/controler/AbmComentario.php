<?php
class AbmComentario {
      /**
     * Carga un objeto Comentario con los parámetros provistos
     * @param array $param
     * @return Comentario|null
     */
    private function cargarObjeto($param) {
        $obj = null;
        if (array_key_exists('autor', $param) && array_key_exists('comentario', $param) && array_key_exists('fecha_creacion', $param) && array_key_exists('pais', $param)) {
            $obj = new Comentario();
            // El ID no es necesario al crear un nuevo comentario, ya que es autoincremental
            $obj->setear(null, $param['autor'], $param['comentario'], $param['fecha_creacion'], $param['pais']);
        }
        return $obj;
    }



    private function cargarObjetoConClave($param) {
        $obj = null;
        if (isset($param['id'])) {
            $obj = new Comentario();
            $obj->setId($param['id']);
            $obj->cargar();  // Carga el resto de los datos desde la DB
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return BOOLEAN
     */
    private function seteadosCamposClaves($param) {
        return isset($param['id']);
    }

    /**
     * Alta (A): Es el proceso de crear o agregar un nuevo objeto o registro a un sistema.
     * @param array $param
     */
    public function alta($param) { //agrega
        $resp = -1;
        $objComentario = $this->cargarObjeto($param);
        if ($objComentario != null && $objComentario->insertar()) { // no hay que poner datos nulos pienso
            $resp = $objComentario;
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

            if (isset($param['autor'])) {
                $where .= " autor ='" . $param['autor'] . "'";
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
    public function darArray($param="") {
        
        $arregloObjComentario = $this->buscar($param);
        $listadoArray = [];

        if (count($arregloObjComentario) > 0) {

            foreach ($arregloObjComentario as $objComentario) {
                $arrayComentario = [
                    'id' => $objComentario->getId(),
                    'autor' => $objComentario->getAutor(),   
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
