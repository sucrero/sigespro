<?php
    class Diagproblema
    {
        private $_idproblema;
        private $_iddiagnostico;
        private $_posibleSol;
        private $_seleccionado;
        
        public function setPropiedades($idproblema,$iddiagnostico,$posibleSol,$seleccionado)
        {
            $this->_idproblema = $idproblema;
            $this->_iddiagnostico = $iddiagnostico;
            $this->_posibleSol = htmlspecialchars(strtoupper($posibleSol));
            $this->_seleccionado = $seleccionado;
        }

        function ingresar($acceso){
            $sql="insert into diagnostico_problemas (idproblema,
                                                     iddiagnostico,
                                                     posiblesolucion,
                                                     seleccionado) values 
                                                     ('".$this->_idproblema."',
                                                      '".$this->_iddiagnostico."',
                                                      '".$this->_posibleSol."',
                                                      '".$this->_seleccionado."')";
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                return $consulta;
            }
        }

        function buscar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                 if($acceso->registros>0)
                 {
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idproblema'],
                                          $consulta['iddiagnostico'],
                                          $consulta['posiblesolucion'],
                                          $consulta['seleccionado']);
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
        
        function mostrar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql)))
                {
                        return $consulta;
                }
        }
    }