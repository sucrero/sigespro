<?php
    class Estudiante
    {
//        private $_id;
        private $_comunidad;
        private $_usuario;
        private $_grupo;
        private $_pnf;
        private $_cedula;
        private $_nombre;
        private $_apellido;
        private $_sexo;
        private $_direccion;
        private $_fechanac;
        private $_telefono;
        private $_mail;
        
        public function setPropiedades($comunidad,$usuario,$grupo,$pnf,$cedula,$nombre,$apellido,$sexo,$direccion,$fechanac,$telefono,$mail)
        {
//            $this->_id = $id;
            $this->_comunidad = $comunidad;
            $this->_usuario = $usuario;
            $this->_grupo = $grupo;
            $this->_pnf = $pnf;
            $this->_cedula = $cedula;
            $this->_nombre = strtoupper($nombre);
            $this->_apellido = strtoupper($apellido);
            $this->_sexo = $sexo;
            $this->_direccion = htmlspecialchars(strtoupper($direccion));
            $this->_fechanac = $fechanac;
            $this->_telefono = $telefono;
            $this->_mail = strtoupper($mail);
        }

        function ingresar($acceso)
        {
            $sql="insert into estudiante (idcomuni,idusuario,idgrupo,idpnf,cedestudiante,nomestudiante,apeestudiante,
                                          sexestudiante,direstudiante,fnacimientoest,telefestudiante,mailestudiante) 
                values ('".$this->_comunidad."','".$this->_usuario."','".$this->_grupo."','".$this->_pnf."',
                        '".$this->_cedula."','".$this->_nombre."','".$this->_apellido."','".$this->_sexo."',
                        '".$this->_direccion."','".$this->_fechanac."','".$this->_telefono."','".$this->_mail."')";
            if(($consulta=$acceso->ejecutarSql($sql))){
                return $consulta;
            }
        }

        function buscar($sql,$acceso)
        {
            if(($consulta=$acceso->ejecutarSql($sql))){
                 if($acceso->registros>0){
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idestudiante'],$consulta['idcomuni'],$consulta['idusuario'],$consulta['idgrupo'],$consulta['idpnf'],
                            $consulta['cedestudiante'],$consulta['nomestudiante'],$consulta['apeestudiante'],$consulta['sexestudiante'],
                            $consulta['direstudiante'],$consulta['fnacimientoest'],$consulta['telefestudiante'],$consulta['mailestudiante']);
                    return true;
                 }else{
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
        
        function setCedula($sql,$acceso){
            if(($consulta = $acceso->ejecutarSql($sql))){
                if($acceso->registros > 0){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }