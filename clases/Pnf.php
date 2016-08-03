<?php
    class Pnf
    {
        private $_descripcion;
        private $_fechainicio;
        private $_abreviado;


        public function setPropiedades($descripcion,$fechainicio,$abreviado)
        {
            $this->_descripcion = $descripcion;
            $this->_fechainicio = $fechainicio;
            $this->_abreviado = strtoupper($abreviado);
        }

        public function ingresar($acceso){
            $sql="insert into pnf (descripcionpnf,fechainiciopnf,abrevpnf) values ('".$this->_descripcion."','".$this->_fechainicio."','".$this->_abreviado."')";
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
                    $this->setPropiedades($consulta['idpnf'],$consulta['descripcionpnf'],$consulta['fechainiciopnf'],$consulta['abrevpnf']);
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