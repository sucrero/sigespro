<?php
    class Diagnostico
    {
        private $_iddiagnostico;
        private $_idpersona;
        private $_iddocente;
        private $_idPnf;
        private $_doc_iddocente;
        private $_idsectorcomunidad;
        private $_idgrupo;
        private $_idperiodo;
        private $_idJefe;
        private $_nomconsejocomunal;
        private $_fechadiagnostico;
        private $_observaciondiagnostico;
        private $_trayectodiagnostico;
        private $_trimestrediagnostico;
        private $_descripdiagnostico;
        private $_status;
        private $_codigo;
        
        function __construct(){}
        public function setPropiedades($iddiagnostico,
                                       $idpersona,
                                       $iddocente,
                                       $idPnf,
                                       $doc_iddocente,
                                       $idsectorcomunidad,
                                       $idgrupo,
                                       $idperiodo,
                                       $idJefe,
                                       $nomconsejocomunal,
                                       $fechadiagnostico,
                                       $observaciondiagnostico,
                                       $trayectodiagnostico,
                                       $trimestrediagnostico,
                                       $descripdiagnostico,
                                       $status,
                                       $codigo)
        {
            $this->_iddiagnostico = $iddiagnostico;
            $this->_idpersona = $idpersona;
            $this->_iddocente = $iddocente;
            $this->_idPnf = $idPnf;
            $this->_doc_iddocente = $doc_iddocente;
            $this->_idsectorcomunidad = $idsectorcomunidad;
            $this->_idgrupo = $idgrupo;
            $this->_idperiodo = $idperiodo;
            $this->_idJefe = $idJefe;
            $this->_nomconsejocomunal = htmlspecialchars(strtoupper($nomconsejocomunal));
            $this->_fechadiagnostico = $fechadiagnostico;
            $this->_observaciondiagnostico = htmlspecialchars(strtoupper($observaciondiagnostico));
            $this->_trayectodiagnostico = $trayectodiagnostico;
            $this->_trimestrediagnostico = $trimestrediagnostico;
            $this->_descripdiagnostico = htmlspecialchars(strtoupper($descripdiagnostico));
            $this->_status = $status;
            $this->_codigo = $codigo;
        }

        function ingresar($acceso){
            $sql="insert into diagnostico (iddiagnostico,
                                           idpersona,
                                           iddocente,
                                           idpnf,
                                           doc_iddocente,
                                           idsectorcomunidad,
                                           idgrupo,
                                           idperiodo,
                                           idjefe,
                                           nomconsejocomunal,
                                           fechadiagnostico,
                                           observaciondiagnostico,
                                           trayectodiagnostico,
                                           trimestrediagnostico,
                                           descripdiagnostico,
                                           statusdiagnostico,
                                           coddiag) values 
                                           ('".$this->_iddiagnostico."',
                                            '".$this->_idpersona."',
                                            '".$this->_iddocente."',
                                            '".$this->_idPnf."',
                                            '".$this->_doc_iddocente."',
                                            '".$this->_idsectorcomunidad."',
                                            '".$this->_idgrupo."',
                                            '".$this->_idperiodo."',
                                            '".$this->_idJefe."',
                                            '".$this->_nomconsejocomunal."',
                                            '".$this->_fechadiagnostico."',
                                            '".$this->_observaciondiagnostico."',
                                            '".$this->_trayectodiagnostico."',
                                            '".$this->_trimestrediagnostico."',
                                            '".$this->_descripdiagnostico."',
                                            '".$this->_status."',
                                            '".$this->_codigo."')";
            if(($consulta=$acceso->ejecutarSql($sql))){
                return $consulta;
            }
        }

        function buscar($sql,$acceso)
        {
//            print_r('sql: '.$sql);
            if(($consulta=$acceso->ejecutarSql($sql))){
                 if($acceso->registros>0){
                    $consulta=$acceso->devolver_recordset();
                    $this->setPropiedades($consulta['iddiagnostico'],
                                          $consulta['idpersona'],
                                          $consulta['iddocente'],
                                          $consulta['idpnf'],
                                          $consulta['doc_iddocente'],
                                          $consulta['idsectorcomunidad'],
                                          $consulta['idgrupo'],
                                          $consulta['idperiodo'],
                                          $consulta['idjefe'],
                                          $consulta['nomconsejocomunal'],
                                          $consulta['fechadiagnostico'],
                                          $consulta['observaciondiagnostico'],
                                          $consulta['trayectodiagnostico'],
                                          $consulta['trimestrediagnostico'],
                                          $consulta['descripdiagnostico'],
                                          $consulta['statusdiagnostico'],
                                          $consulta['codigo']);
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