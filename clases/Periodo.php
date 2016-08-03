<?php
    class Periodo
    {
//        private $_id;
        private $_codigo;
        private $_inicio;
        private $_fin;       
        
        public function setPropiedades($codigo,$fin,$inicio)
        {
            $this->_codigo = $codigo;
            $this->_inicio = $inicio;
            $this->_fin = $fin;
        }

        public function ingresar($acceso){
            $sql="insert into periodo_academico (codperiodo,fechafinal,fechainicio) values ('".$this->_codigo."','".$this->_fin."','".$this->_inicio."')";
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
                    $this->setPropiedades($consulta['idperiodo'],$consulta['codperiodo'],$consulta['fechafinal'],$consulta['fechainicio']);
                    return true;
                 }
                 else
                 {
                    return false;
                 }
            }
        }

        function modificar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                if($acceso->registros > 0){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }