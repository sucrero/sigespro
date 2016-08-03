<?php
    class Problema
    {
        private $_id;
        private $_iddiagnostico;
        private $_idsectorcomunidad;
        private $_descripcion;
        private $_posiblesolucion;
        private $_seleccionado;

        public function setPropiedades($id,$iddiagnostico,$idsectorcomunidad,$descripcion,$posiblesolucion,$seleccionado)
        {
            $this->_id = $id;
            $this->_iddiagnostico = $iddiagnostico;
            $this->_idsectorcomunidad = $idsectorcomunidad;
            $this->_descripcion = htmlspecialchars(strtoupper($descripcion));
            $this->_posiblesolucion = htmlspecialchars(strtoupper($posiblesolucion));
            $this->_seleccionado = $seleccionado;
        }

        public function ingresar($acceso){
            $sql="insert into problema (idproblema,idsectorcomunidad,descripcionproblema,iddiagnostico,posiblesolucion,seleccionado) values ('".$this->_id."',
                '".$this->_idsectorcomunidad."','".$this->_descripcion."','".$this->_iddiagnostico."','".$this->_posiblesolucion."','".$this->_seleccionado."')";
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                return $consulta;
            }
        }

        public function buscar($sql,$acceso)
        {
//            die('sql: '.$sql);exit;
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                 if($acceso->registros>0)
                 {
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idproblema'],$consulta['idsectorcomunidad'],$consulta['descripcionproblema'],
                            $consulta['iddiagnostico'],$consulta['posiblesolucion'],$consulta['seleccionado']);
                    return true;
                 }
                 else
                 {
                    return false;
                 }
            }
        }

        public function modificar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                if($acceso->registros>0)
                {
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        public function mostrar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql)))
                {
                        return $consulta;
                }
        }
    }