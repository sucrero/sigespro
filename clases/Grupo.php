<?php
    class Grupo
    {
        private $_id;
        private $_seccion;
        public function setPropiedades($id,$seccion)
        {
            $this->_id = $id;
            $this->_seccion = $seccion;
        }

        public function ingresar($acceso){
            $sql="insert into grupo (idgrupo,seccion) values ('".$this->_id."',
                '".$this->_seccion."')";
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                return $consulta;
            }
        }

        public function buscar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                 if($acceso->registros>0)
                 {
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idgrupo'],$consulta['seccion']);
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