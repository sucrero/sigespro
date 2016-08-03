<?php
    class Consejo
    {
        private $_id;
        private $_idsector;
        private $_rif;
        private $_sicom;
        private $_fechaeleccion;
        private $_nombre;
       
        public function setPropiedades($id,$idsector,$rif,$sicom,$fechaeleccion,$nombre)
        {
            $this->_id = $id;
            $this->_idsector = $idsector;
            $this->_rif = $rif;
            $this->_sicom = $sicom;
            $this->_fechaeleccion = $fechaeleccion;
            $this->_nombre = htmlspecialchars(strtoupper($nombre));
        }

        function ingresar($acceso){
            $sql="insert into consejo_comunal (idconsejo,idsectorcomunidad,rifconsejo,sicomconsejo,feculteleccion,nomconsejo) values ('".$this->_id."',
                '".$this->_idsector."','".$this->_rif."','".$this->_sicom."','".$this->_fechaeleccion."','".$this->_nombre."')";
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
                    $this->setPropiedades($consulta['idconsejo'],$consulta['idsectorcomunidad'],$consulta['rifconsejo'],
                            $consulta['sicomconsejo'],$consulta['feculteleccion'],$consulta['nomconsejo']);
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