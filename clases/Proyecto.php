<?php
    class Proyecto
    {
        private $_idgrupo;
        private $_idanteproyecto;
        private $_idjefe;
        private $_iddocente;
        private $_idpnf;
        private $_idtutor;
        private $_idpersona;
        private $_idproblema;
        private $_iddiagnostico;
        private $_idperiodo;
        private $_codproyecto;
        private $_nombproyecto;
        private $_objproyecto;
        private $_areaconocimiento;
        private $_trimestreproy;
        private $_trayectoproy;
        private $_fechaproy;
        private $_observacion;
        private $_statusproy;
      
        public function setPropiedades($idgrupo,$idanteproyecto,$jefe,$iddocente,$pnf,$idtutor,$idpersona,$idproblema, $iddiagnostico,$idperiodo,$codproyecto,
                $nombproyecto,$objproyecto,$areaconocimiento,$trimestreproy,$trayectoproy,$fechaproy,$observacion,$status)
        {
            $this->_idgrupo = $idgrupo;
            $this->_idanteproyecto = $idanteproyecto;
            $this->_idjefe = $jefe;
            $this->_iddocente = $iddocente;
            $this->_idpnf = $pnf;
            $this->_idtutor = $idtutor;
            $this->_idpersona = $idpersona;
            $this->_idproblema = $idproblema;
            $this->_iddiagnostico = $iddiagnostico;
            $this->_idperiodo = $idperiodo;
            $this->_codproyecto = $codproyecto;
            $this->_nombproyecto = htmlspecialchars(strtoupper($nombproyecto));
            $this->_objproyecto = htmlspecialchars(strtoupper($objproyecto));
            $this->_areaconocimiento = htmlspecialchars(strtoupper($areaconocimiento));
            $this->_trimestreproy = $trimestreproy;
            $this->_trayectoproy = $trayectoproy;
            $this->_fechaproy = $fechaproy;
            $this->_observacion = htmlspecialchars(strtoupper($observacion));
            $this->_statusproy = $status;
        }

        public function ingresar($acceso){
            $sql="insert into proyecto (idgrupo,idantep,idjefe, iddocente,idpnf,doc_iddocente,idpersona,idproblema,iddiagnostico,idperiodo,codproy,nomproyecto,
                                        objproyecto,areaconocimi,trimestreproy,trayectoproy,fechaproy,observproy,statusproy) values 
                                           ('".$this->_idgrupo."',
                                            '".$this->_idanteproyecto."',
                                            '".$this->_idjefe."',
                                            '".$this->_iddocente."',
                                            '".$this->_idpnf."',
                                            '".$this->_idtutor."',
                                            '".$this->_idpersona."',
                                            '".$this->_idproblema."',
                                            '".$this->_iddiagnostico."',
                                            '".$this->_idperiodo."',
                                            '".$this->_codproyecto."',
                                            '".$this->_nombproyecto."',
                                            '".$this->_objproyecto."',
                                            '".$this->_areaconocimiento."',
                                            '".$this->_trimestreproy."',
                                            '".$this->_trayectoproy."',
                                            '".$this->_fechaproy."',
                                            '".$this->_observacion."',
                                            '".$this->_statusproy."')";
//            print_r('prueba: '.$acceso->ejecutarSql($sql));
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
                    $this->setPropiedades($consulta['idproyecto'],
                                          $consulta['idgrupo'],
                                          $consulta['idantep'],
                                          $consulta['idjefe'],
                                          $consulta['iddocente'],
                                          $consulta['idpnf'],
                                          $consulta['doc_iddocente'],
                                          $consulta['idpersona'],
                                          $consulta['idproblema'],
                                          $consulta['iddiagnostico'],
                                          $consulta['idperiodo'],
                                          $consulta['codproy'],
                                          $consulta['nomproyecto'],
                                          $consulta['objproyecto'],
                                          $consulta['areaconocimi'],
                                          $consulta['trimestreproy'],
                                          $consulta['trayectoproy'],
                                          $consulta['fechaproy'],
                                          $consulta['observproy'],
                                          $consulta['statusproy']);
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