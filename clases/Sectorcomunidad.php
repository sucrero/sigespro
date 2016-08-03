<?php
    class Sectorcomunidad
    {
        private $_id;
        private $_comunidad;
        private $_nombre;
        private $_direccion;

        public function setPropiedades($id,$comunidad,$nombre,$direccion)
        {
            $this->_id = $id;
            $this->_comunidad = $comunidad;
            $this->_nombre = htmlspecialchars(strtoupper($nombre));
            $this->_direccion = htmlspecialchars(strtoupper($direccion));
        }

        public function ingresar($acceso){
            $sql="insert into sector_comunidad (idsectorcomunidad,idcomuni,descripsector,dirsector) values (
                '".$this->_id."','".$this->_comunidad."','".$this->_nombre."','".$this->_direccion."')";
            if(($consulta=$acceso->ejecutarSql($sql))){
                return $consulta;
            }
        }

        public function buscar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                 if($acceso->registros>0){
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idsectorcomunidad'],$consulta['idcomuni'],$consulta['descripsector'],
                            $consulta['dirsector']);
                    return true;
                 }
                 else{
                    return false;
                 }
            }
        }

        public function modificar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                if($acceso->registros>0){
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        public function mostrar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                    return $consulta;
            }
        }
    }