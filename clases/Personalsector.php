<?php
    class Personalsector
    {
        private $_id;
        private $_sector;
        private $_usuario;
        private $_cedula;
        private $_nombre;
        private $_apellido;
        private $_telefono;
        private $_direccion;
        private $_email;
        private $_status;
        private $_sexo;

        public function setPropiedades($id,$sector,$usuario,$cedula,$nombre,$apellido,$telefono,$direccion,$email,$status,$sexo)
        {
            $this->_id = $id;
            $this->_sector = $sector;
            $this->_usuario = $usuario;
            $this->_cedula = $cedula;
            $this->_nombre = strtoupper($nombre);
            $this->_apellido = strtoupper($apellido);
            $this->_telefono = $telefono;
            $this->_direccion = htmlspecialchars(strtoupper($direccion));
            $this->_email = strtoupper($email);
            $this->_status = $status;
            $this->_sexo = $sexo;
        }

        public function ingresar($acceso)
        {
            $sql="insert into personal_sector_comunidad (idpersona,idsectorcomunidad,idusuario,cedpersona,nompersona,
                apepersona,telefpersona,dirpersona,emailpersona,statuspersona,sexopersona) values 
                ('".$this->_id."','".$this->_sector."','".$this->_usuario."','".$this->_cedula."','".$this->_nombre."',
                    '".$this->_apellido."','".$this->_telefono."','".$this->_direccion."','".$this->_email."','".$this->_status."','".$this->_sexo."')";
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
                    $this->setPropiedades($consulta['idpersona'],$consulta['idsectorcomunidad'],$consulta['idusuario'],$consulta['cedpersona'],$consulta['nompersona'],
                            $consulta['apepersona'],$consulta['telefpersona'],$consulta['dirpersona'],$consulta['emailpersona'],$consulta['statuspersona'],$consulta['sexopersona']);
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