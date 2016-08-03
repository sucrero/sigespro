<?php
    class Comunidad
    {
        private $_id;
        private $_parroquia;
        private $_nombre;
        private $_direccion;
       
        public function setPropiedades($id,$parroquia,$nombre,$direccion)
        {
            $this->_id = $id;
            $this->_parroquia = $parroquia;
            $this->_nombre = htmlspecialchars(strtoupper($nombre));
            $this->_direccion = htmlspecialchars(strtoupper($direccion));
        }

        function ingresar($acceso){
            $sql="insert into comunidad (idcomuni,idparroquia,nomcomuni,dircomuni) values ('".$this->_id."',
                '".$this->_parroquia."','".$this->_nombre."','".$this->_direccion."')";
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
                    $this->setPropiedades($consulta['idcomuni'],$consulta['idparroquia'], $consulta['nomcomuni'] ,
                            $consulta['dircomuni']);
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