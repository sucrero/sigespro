<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of Anteproyecto
     *
     * @author osfran
     */
    class Anteproyecto
    {
        private $_idanteproyecto;
        private $_idjefe;
        private $_idperiodo;
        private $_idproblema;
        private $_idgrupo;
        private $_iddiagnostico;
        private $_idpersona;
        private $_iddocente;
        private $_idtutor;
        private $_idpnf;
        private $_nombre;
        private $_objetivo;
        private $_trayecto;
        private $_trimestre;
        private $_fecha;
        private $_observacion;
        private $_status;
        private $_codigo;
        
        public function setPropiedades($jefe,$periodo,$problema,$grupo,$diagnostico,$persona,$docente,$tutor,$pnf,$nombre,
                                       $objetivo,$trayecto,$trimestre,$fecha,$observacion,$status,$codigo)
        {
            $this->_idjefe = $jefe;
            $this->_idperiodo = $periodo;
            $this->_idproblema = $problema;
            $this->_idgrupo = $grupo;
            $this->_iddiagnostico = $diagnostico;
            $this->_idpersona = $persona;
            $this->_iddocente = $docente;
            $this->_idtutor = $tutor;
            $this->_idpnf = $pnf;
            $this->_nombre = htmlspecialchars(strtoupper($nombre));
            $this->_objetivo = htmlspecialchars(strtoupper($objetivo));
            $this->_trayecto = $trayecto;
            $this->_trimestre = $trimestre;
            $this->_fecha = $fecha;
            $this->_observacion = htmlspecialchars(strtoupper($observacion));
            $this->_status = $status;
            $this->_codigo = $codigo;
        }

        public function ingresar($acceso){
            $sql="insert into anteproyecto (idjefe,idperiodo,idproblema,idgrupo,iddiagnostico,idpersona,iddocente,doc_iddocente,idpnf,nomantep,objantep,trayectoante,trimestreante,fechaante,observante,statusante,codantep) values 
                                            ('".$this->_idjefe."','".$this->_idperiodo."','".$this->_idproblema."','".$this->_idgrupo."','".$this->_iddiagnostico."','".$this->_idpersona."','".$this->_iddocente."','".$this->_idtutor."','".$this->_idpnf."','".$this->_nombre."','".$this->_objetivo."','".$this->_trayecto."','".$this->_trimestre."','".$this->_fecha."','".$this->_observacion."','".$this->_status."','".$this->_codigo."')";
//            die('sql: '.$sql);exit;
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
                    $this->setPropiedades($consulta['idantep'],$consulta['idjefe'],$consulta['idperiodo'],
                                          $consulta['idproblema'],$consulta['idgrupo'],$consulta['iddiagnostico'],
                                          $consulta['idpersona'],$consulta['iddocente'],$consulta['doc_iddocente'],
                                          $consulta['idpnf'],$consulta['nomantep'],$consulta['objantep'],
                                          $consulta['trayectoante'],$consulta['trimestreante'],$consulta['fechaante'],
                                          $consulta['observante'],$consulta['statusante'],$consulta['codantep']);
                    return true;
                 }
                 else
                 {
                    return false;
                 }
            }
        }

        function modificar($sql,$acceso)
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