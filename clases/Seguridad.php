<?php
    
    class Seguridad
    {
        //private $_id;
        private $_usuario;
        private $_accion;
        private $_fecha;        

        public function setPropiedades($usuario,$accion,$fecha)
        {
            //$this->_id = $id;
            $this->_usuario = $usuario;
            $this->_accion = $accion;
            $this->_fecha = $fecha;
        }

        public function ingresar($acceso){
            $sql="insert into seguridad (idusuario,accionrealizada,fechaaccion) values ('".$this->_usuario."','".$this->_accion."','".$this->_fecha."')";
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
                    $this->setPropiedades($consulta['idseguridad'],$consulta['idusuario'],$consulta['accionrealizada'],$consulta['fechaaccion']);
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
    }