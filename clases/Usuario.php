<?php
    class Usuario
    {
        private $_id;
        private $_clave;
        private $_usuario;
        private $_fecRegistro;
        private $_perfil;        

        public function setPropiedades($id,$clave,$usuario,$fecRegistro,$perfil)
        {
            $this->_id = $id;
            $this->_clave = $clave;
            $this->_usuario = strtoupper($usuario);
            $this->_fecRegistro = $fecRegistro;
            $this->_perfil = $perfil;
        }

        public function ingresar($acceso){
            $sql="insert into usuario (idusuario,clave,login,fecharegistro,perfilusuario) values ('".$this->_id."','".$this->_clave."','".$this->_usuario."','".$this->_fecRegistro."','".$this->_perfil."')";
//            die($sql);
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                return $consulta;
            }
        }

        public function buscar($sql,$acceso)
        { 
//             print_r('sql: '.$sql);
//        echo 'sql: '.$sql;
        
            if(($consulta=$acceso->ejecutarSql($sql)))
            {         
                 if($acceso->registros>0)
                 {
//                     print_r('registraos: '.$acceso->registros);
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idusuario'],$consulta['clave'],$consulta['login'],$consulta['fecharegistro'],$consulta['perfilusuario']);
                    return true;
                 }
                 else
                 {
                    return false;
                 }
            }
//            print_r('consulta: '.$consulta);
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