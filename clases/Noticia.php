<?php
    class Noticia
    {
        private $_idNoticia;
        private $_idUsuario;
        private $_descripcion;
        private $_horaPub;
        private $_fechaPub;   
        private $_status;
        private $_titular;

        public function setPropiedades($idNoticia,$idUsuario,$descripcion,$horaPub,$fechaPub,$status,$titular)
        {
            $this->_idNoticia = $idNoticia;
            $this->_idUsuario = $idUsuario;
            $this->_descripcion = htmlspecialchars(strtoupper($descripcion));
            $this->_horaPub = $horaPub;
            $this->_fechaPub = $fechaPub;
            $this->_status = $status;
            $this->_titular = htmlspecialchars(strtoupper($titular));
        }

        public function ingresar($acceso){
            $sql="insert into noticia (idnoticia,idusuario,descripnoticia,horapubli,fechapubli,statusnoticia,titularnoticia) values 
                ('".$this->_idNoticia."','".$this->_idUsuario."','".$this->_descripcion."','".$this->_horaPub."','".$this->_fechaPub."','".$this->_status."','".$this->_titular."')";
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
                    $this->setPropiedades($consulta['idnoticia'],$consulta['idusuario'],$consulta['descripnoticia'],$consulta['horapubli'],$consulta['fechapubli'],$consulta['statusnoticia'],$consulta['titularnoticia']);
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