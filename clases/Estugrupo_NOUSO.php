<?php
    class Estugrupo
    {
        private $_grupo;
        private $_estudiante;
        
        public function setPropiedades($grupo,$estudiante)
        {
            $this->_grupo = $grupo;
            $this->_estudiante = $estudiante;
        }

        public function ingresar($acceso){
            $sql="insert into grupoestu (idgrupo,idestudiante) values ('".$this->_grupo."',
                '".$this->_estudiante."')";
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
                    $this->setPropiedades($consulta['idgrupo'],$consulta['idestudiante']);
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