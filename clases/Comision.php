<?php
    class Comision
    {
//        private $_id;
        private $_idpersona;
        private $_iddocente;
        private $_fecha;
        private $_observacion;
        private $_identificador;
        private $_codigo;


        public function setPropiedades($idpersona,$iddocente,$fecha,$observacion,$identificador,$codigo)
        {
//            $this->_id = $id;
            $this->_idpersona = $idpersona;
            $this->_iddocente = $iddocente;
            $this->_fecha = $fecha;
            $this->_observacion = htmlspecialchars(strtoupper($observacion));
            $this->_identificador = $identificador;
            $this->_codigo = $codigo;
        }

        function ingresar($acceso){
            $sql="insert into comision_tecnica (idpersona,iddocente,fecha_creacion,obsercomision,identificador,codigoComision) values 
                ('".$this->_idpersona."','".$this->_iddocente."','".$this->_fecha."'
                 ,'".$this->_observacion."','".$this->_identificador."','".$this->_codigo."')";
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                return $consulta;
            }
        }

        function buscar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                 if($acceso->registros>0){
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idcomision'],$consulta['idpersona'],$consulta['iddocente'],
                            $consulta['fecha_creacion'],$consulta['obsercomision'],$consulta['identificador'],
                            $consulta['codigoComision']);
                    return true;
                 }
                 else{
                    return false;
                 }
            }
        }

        function modificar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                if($acceso->registros>0){
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        function mostrar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                    return $consulta;
            }
        }
    }