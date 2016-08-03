<?php
    class Denuncia
    {
        private $_id;
        private $_usuario;
        private $_descripcion;
        private $_tipo;
        private $_codigotipo;
        private $_fecha;
        private $_hora;

        public function setPropiedades($id,$usuario,$descripcion,$tipo,$codtipo,$fecha,$hora){
            $this->_id = $id;
            $this->_usuario = $usuario;
            $this->_descripcion = htmlspecialchars(strtoupper($descripcion));
            $this->_tipo = htmlspecialchars(strtoupper($tipo));
            $this->_codigotipo = $codtipo;
            $this->_fecha = $fecha;
            $this->_hora = $hora;
        }

        public function ingresar($acceso){
            $sql="insert into denuncia (iddenuncia,idusuario,descripdenuncia,tipodenuncia,codtipo,fechadenuncia,horadenuncia) values 
                ('".$this->_id."','".$this->_usuario."','".$this->_descripcion."','".$this->_tipo."','".$this->_codigotipo."','".$this->_fecha."','".$this->_hora."')";
//            die($sql);
            if(($consulta=$acceso->ejecutarSql($sql)))
            {
                return $consulta;
            }
        }

        public function buscar($sql,$acceso){ 
//             print_r($acceso);
//        echo 'sql: '.$sql;
            if(($consulta=$acceso->ejecutarSql($sql)))
            {         
                 if($acceso->registros>0)
                 {
//                     print_r('registraos: '.$acceso->registros);
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['iddenuncia'],$consulta['idusuario'],$consulta['descripdenuncia'],$consulta['tipodenuncia'],$consulta['codtipo'],$consulta['fechadenuncia'],$consulta['horadenuncia']);
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