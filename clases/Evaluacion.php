<?php
    class Evaluacion
    {
        private $_id;
        private $_idcomision;
        private $_idproyecto;
        private $_idpersona;
        private $_iddocente;
        private $_idgrupo;
        private $_doc_iddocente;
        private $_per_idpersona;
        private $_notadescriptiva;
        private $_observacion;
        private $_trayecto;
        
        function __construct(){}
        public function setPropiedades($id,$idcomision,$idproyecto,$idpersona,$iddocente,$idgrupo,$doc_iddocente,$per_idpersona,
                                       $nota,$observacion,$trayecto)
        {
            $this->_id = $id;
            $this->_idcomision = $idcomision;
            $this->_idproyecto = $idproyecto;
            $this->_idpersona = $idpersona;
            $this->_iddocente = $iddocente;
            $this->_idgrupo = $idgrupo;
            $this->_doc_iddocente = $doc_iddocente;
            $this->_per_idpersona = $per_idpersona;
            $this->_notadescriptiva = $nota;
            $this->_observacion = htmlspecialchars(strtoupper($observacion));
            $this->_trayecto = $trayecto;
        }

        function ingresar($acceso){
            $sql="insert into evaluacion_proyecto (idevaluacion,idcomision,idproyecto,idpersona,iddocente,idgrupo,doc_iddocente,
                                           per_idpersona,notadescriptiva,obserevaluacion,trayectoevaluacion) values 
                                           ('".$this->_id."','".$this->_idcomision."','".$this->_idproyecto."','".$this->_idpersona."',
                                            '".$this->_iddocente."','".$this->_idgrupo."','".$this->_doc_iddocente."','".$this->_per_idpersona."',
                                            '".$this->_notadescriptiva."','".$this->_observacion."','".$this->_trayecto."')";
            if(($consulta=$acceso->ejecutarSql($sql))){
                return $consulta;
            }
        }

        function buscar($sql,$acceso)
        {
//            die($sql);
            if(($consulta=$acceso->ejecutarSql($sql))){
                 if($acceso->registros>0){
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['idevaluacion'],$consulta['idcomision'],$consulta['idproyecto'],$consulta['idpersona'],
                                          $consulta['iddocente'],$consulta['idgrupo'],$consulta['doc_iddocente'], $consulta['per_idpersona'],
                                          $consulta['notadescriptiva'],$consulta['obserevaluacion'],$consulta['trayectoevaluacion']);
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
    }