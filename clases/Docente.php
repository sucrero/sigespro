<?php
    class Docente
    {
        private $_id;
        private $_usuario;
        private $_pnf;
        private $_comunidad;
        private $_cedula;
        private $_nombre;
        private $_apellido;
        private $_sexo;
        private $_fechanac;
        private $_telefono;
        private $_gradoinstruccion;
        private $_profesion;
        private $_direccion;
        private $_mail;
                
        public function setPropiedades($id,$usuario,$pnf,$comunidad,$cedula,$nombre,$apellido,$sexo,$fechanac,$telefono,$gradoinstruccion,$profesion,$direccion,$mail)
        {
            $this->_id = $id;
            $this->_usuario = $usuario;
            $this->_pnf = $pnf;
            $this->_comunidad = $comunidad;
            $this->_cedula = $cedula;
            $this->_nombre = strtoupper($nombre);
            $this->_apellido = strtoupper($apellido);
            $this->_sexo = $sexo;
            $this->_fechanac = $fechanac;
            $this->_telefono = $telefono; 
            $this->_gradoinstruccion = htmlspecialchars(strtoupper($gradoinstruccion));
            $this->_profesion = htmlspecialchars(strtoupper($profesion));
            $this->_direccion = htmlspecialchars(strtoupper($direccion));
            $this->_mail = strtoupper($mail);            
        }

        public function ingresar($acceso){
            $sql="insert into docente (iddocente,
                                       idusuario,
                                       idpnf,
                                       idcomuni,
                                       ceddocente,
                                       nomdocente,
                                       apedocente,
                                       sexdocente,
                                       fnacimiento,
                                       telefdocente,
                                       gradoinstruccion,
                                       profesion,
                                       direccdocente,
                                       maildocente) values 
                                       ('".$this->_id."',
                                        '".$this->_usuario."',
                                        '".$this->_pnf."',
                                        '".$this->_comunidad."',
                                        '".$this->_cedula."',
                                        '".$this->_nombre."',
                                        '".$this->_apellido."',
                                        '".$this->_sexo."',
                                        '".$this->_fechanac."',
                                        '".$this->_telefono."',
                                        '".$this->_gradoinstruccion."',
                                        '".$this->_profesion."',
                                        '".$this->_direccion."',
                                        '".$this->_mail."')";
            if(($consulta=$acceso->ejecutarSql($sql))){
                return $consulta;
            }
        }

        public function buscar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                 if($acceso->registros>0){
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['iddocente'],$consulta['idusuario'],$consulta['idpnf'],$consulta['idcomuni'],$consulta['ceddocente'],$consulta['nomdocente'],$consulta['apedocente'],$consulta['sexdocente'],$consulta['fnacimiento'],$consulta['telefdocente'],$consulta['gradoinstruccion'],$consulta['profesion'],$consulta['direccdocente'],$consulta['maildocente']);
                    return true;
                 }else{
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
        function mostrar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                    return $consulta;
            }
        }
        
        function addDocente($sql,$acceso){
            if(($consulta = $acceso->ejecutarSql($sql))){
                if($acceso->registros > 0){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }