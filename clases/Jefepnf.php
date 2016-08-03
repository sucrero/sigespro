<?php
    class Jefepnf
    {
        private $_id;
        private $_usuario;
        private $_pnf;
        private $_docente;
        private $_fechainicio;
        private $_fechafin;
        private $_status;
        
        public function setPropiedades($id,$usuario,$pnf,$docente,$fechainicio,$fechafin,$status)
        {
            $this->_id = $id;
            $this->_usuario = $usuario;
            $this->_pnf = $pnf;
            $this->_docente = $docente;
            $this->_fechainicio = $fechainicio;
            $this->_fechafin = $fechafin;
            $this->_status = $status;
        }

        public function ingresar($acceso){
            $sql="insert into jefe_pnf (idjefe,idusuario,idpnf,iddocente,fechainiciojefe,fechasalidajefe,statusjefe) values 
                ('".$this->_id."','".$this->_usuario."','".$this->_pnf."',
                 '".$this->_docente."','".$this->_fechainicio."','".$this->_fechafin."','".$this->_status."')";
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
                    $this->setPropiedades($consulta['idjefe'],$consulta['idusuario'],$consulta['idpnf'],$consulta['iddocente'],$consulta['fechainiciojfe'],$consulta['fechasalidajefe'],$consulta['statusjefe']);
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