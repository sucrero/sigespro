<?php
    session_start();
    include_once 'clases/JSON.php';
    include_once 'conexion/conexion.php';//1
    include_once 'clases/Docente.php';//3
    include_once 'clases/Estado.php';//4
    include_once 'clases/Municipio.php';//5
    include_once 'clases/Parroquia.php';//6
    include_once 'clases/Comunidad.php';//7
    include_once 'clases/Diagnostico.php';//8
    include_once 'clases/Sectorcomunidad.php';//9
    include_once 'clases/Jefepnf.php';//10
    include_once 'clases/Pnf.php';//11
    include_once 'clases/Seguridad.php';//12
    include_once 'clases/Usuario.php';//13
    include_once 'clases/Estudiante.php';//14
    include_once 'clases/Personalsector.php';//15
    include_once 'clases/Periodo.php';//16
    include_once 'clases/Problema.php';//17
    include_once 'clases/Grupo.php';//19
    include_once 'clases/Proyecto.php';//20
    include_once 'clases/Noticia.php';//21
    include_once 'clases/Seguridad.php';//22
    include_once 'clases/Anteproyecto.php';//23
    include_once 'clases/Evaluacion.php';
    include_once 'clases/Comision.php';
    include_once 'clases/Consejo.php';
    include_once 'clases/Denuncia.php';
    require_once('lib/nusoap/nusoap.php');
    require_once('lib/utils.php');

    function cambiarFormatoFecha($f,$op)
    {
        $fecha='';
        if($op==1){
            $dia=substr($f,8,2);//1982/12/05
            $mes=substr($f,5,2);
            $anio=substr($f,0,4);
            $fecha = $dia."/".$mes."/".$anio;
        }else{
            $dia=substr($f,0,2); //05/05/1982
            $mes=substr($f,3,2);
            $anio=substr($f,6,4);
            $fecha = $anio."/".$mes."/".$dia;
        }
        return $fecha;
    }
    function convUTF($tipo,$str){
        if($tipo==1){// para guardar en la bdd
            $cadena = htmlentities($str,ENT_QUOTES,'UTF-8');
        }else{//para mostrar desde la bdd
            $cadena = html_entity_decode($str,ENT_QUOTES,'UTF-8');
        }
        return $cadena;
    }
    
	switch($_POST['op'])
	{
            case buscarDocente:
                $objDoc = new Docente();
                if($objDoc->buscar("SELECT * FROM docente WHERE ceddocente='".$_POST['cedula']."'", $acceso)){
                    echo 1;
                }else{
                    echo 0;
                }
            break;
            case guardarDocente:
                    $objDoc = new Docente();
                    /*  0       NACIONALIDAD
                     *  1	CEDULA
                        2	NOMBRE
                        3	APELLIDO
                        4	SEXO
                        5	FECHA DE NACIMIENTO                     
                        7	TELEFONO
                        8	PNF
                        9	ESTADO
                        10	MUNICIPIO
                        11	PARROQUIA
                        11	COMUNIDAD     NOOOOOOOOOOOO
                        12	GRADO DE INSTRUCCION
                        14	PROFESION
                        15	DIRECCION
                        16      EMAIL
                     * jefe = SI ES JEFE O NO
                     */
                if($_POST['5'] != ''){
                    $fecha = cambiarFormatoFecha($_POST['5'], 0);
                }else{
                    $fecha = '1900-01-01';
                }
                if($objDoc->buscar("select * from docente where ceddocente='".$_POST['0'].$_POST['1']."'", $acceso)){
                    echo 2;//EXISTE UN DOCENTE CON LA MISMA CEDULA
                }else{
                    if($objDoc->buscar("select * from docente where maildocente='".$_POST['16']."'", $acceso)){
                        echo 3;//EXISTE UN DOCENTE CON EL MISMO EMAIL
                    }else{
                        if($objDoc->buscar("SELECT MAX(iddocente) AS maximo FROM docente",$acceso)){
                                 if($acceso->registros>0){
                                         $fila = $acceso->devolver_recordset();
                                         $codigoDoc = $fila['maximo'] + 1;
                                 }else{
                                         $codigoDoc = 1;
                                 }
                         }
                        $objDoc->setPropiedades($codigoDoc,'0', $_POST['8'], '1', $_POST['0'].$_POST['1'], $_POST['2'], $_POST['3'], $_POST['4'], $fecha, $_POST['7'], $_POST['12'], $_POST['14'], $_POST['15'],$_POST['16']); 
                        if($objDoc->ingresar($acceso)){
                            $objSeguridad = new Seguridad();
                            $fecha = date('Y-m-d H:i:s');
                            $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE DOCENTE CON CEDULA: '.$_POST['0'].$_POST['1'], $fecha);
                            $objSeguridad->ingresar($acceso);

                            if($_POST['jefe'] == 1){
                                $objJefe = new Jefepnf();
                                $hoy = date('Y-m-d');
                                $objJefe->modificar("UPDATE jefe_pnf SET statusjefe='0',fechasalidajefe='".$hoy."' WHERE statusjefe='1' AND idpnf='".$_POST['8']."'", $acceso);
                                if($objJefe->buscar("SELECT MAX(idjefe) AS maximo FROM jefe_pnf",$acceso)){
                                   if($acceso->registros>0){
                                           $fila = $acceso->devolver_recordset();
                                           $codigoJefe = $fila['maximo'] + 1;
                                   }else{
                                           $codigoJefe = 1;
                                   }
                                }
                                $objJefe->setPropiedades($codigoJefe, '0', $_POST['8'], $codigoDoc, $hoy, '1900-01-01', '1');
                                $objJefe->ingresar($acceso);
                            }
                            echo 1;//INGRESADO EXITOSAMENTE
                         }else{
                            echo 0;//HUBO UN ERROR
                         } 
                    }
                }
            break;  
            case buscarTodosDoc:
               $objDoc = new Docente();
               if($objDoc->buscar("select * from docente ORDER BY nomdocente, apedocente",$acceso)){
                    if($acceso->registros>0){
                        $i=0;
                        do{
                            $fila[$i] = $acceso->devolver_recordset();
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        $json=new Services_JSON();
                        $resp=$json->encode($fila);
                        echo $resp;
                    }else{
                        echo 0;
                    }
                }else{
                    echo 0;
                }
            break;
           case buscarDoc:
               $objDoc = new Docente();
               $objCom = new Comunidad();
               $objPar = new Parroquia();
               $objMun = new Municipio();
               $objPar = new Parroquia();
               $objJefe = new Jefepnf();
               if($objDoc->buscar("select * from docente where iddocente='".$_POST['codigo']."'", $acceso)){
                   if($acceso->registros>0){
                       $fila[0] = $acceso->devolver_recordset();
                       $objCom->buscar("select * from comunidad where idcomuni='".$fila[0]['idcomuni']."'", $acceso);
                       $fila[1] = $acceso->devolver_recordset();
                       if(strlen($fila[1]['idparroquia']) == 8){
                            $est = substr($fila[1]['idparroquia'], 0, 2);
                            $mun = substr($fila[1]['idparroquia'], 0, 5);
                       }else{
                           $est = substr($fila[1]['idparroquia'], 0, 1);
                           $mun = substr($fila[1]['idparroquia'], 0, 4);
                       }
                       $objMun->buscar("select * from municipio where idestado='".$est."' ORDER BY descripmunicipio ASC", $acceso);
                       $i=0;
                         do{
                            $temp = $acceso->devolver_recordset();
                            $fila[2][$i]=$temp;
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                       
                       $objPar->buscar("select * from parroquia where idmunicipio='".$mun."' ORDER BY descripparroquia ASC", $acceso);
                       $i=0;
                         do{
                            $temp = $acceso->devolver_recordset();
                            $fila[3][$i]=$temp;
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));

                       $objPar->buscar("select * from estado ORDER BY descripestado ASC", $acceso);
                       $i=0;
                         do{
                            $temp = $acceso->devolver_recordset();
                            $fila[4][$i]=$temp;
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        
                        $objCom->buscar("select * from comunidad where idparroquia='".$fila[1]['idparroquia']."' ORDER BY nomcomuni ASC", $acceso);
                       $i=0;
                         do{
                            $temp = $acceso->devolver_recordset();
                            $fila[5][$i]=$temp;
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        $objJefe->buscar("SELECT * FROM jefe_pnf WHERE iddocente='".$_POST['codigo']."'", $acceso);
                        $fila[6] = $acceso->devolver_recordset();
                        
//                        $objSeguridad = new Seguridad();
//                        $fecha = date('Y-m-d H:i:s');
//                        $objSeguridad->setPropiedades($codUsu, 'CONSULTAR DOCENTE PARA MODIFICAR', $fecha);
//                        $objSeguridad->ingresar($acceso);
                       $json=new Services_JSON();
                       $resp=$json->encode($fila);
                       echo $resp;
                   }else{
                       echo 2;
                   }
               }else{
                   echo 1;
               }
               break;
           case modificarDocente:
               $objDoc = new Docente();

               /*
                0       NACIONALIDAD
                1	CEDULA
                2	NOMBRE
                3	APELLIDO                
                4	SEXO
                5	FECHA NACIMIENTO
                7	TELEFONO
                8	PNF
                9	ESTADO
                10	MUNICIPIO
                11	PARROQUIA
                11	COMUNIDAD    NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
                12	GRADO DE INSTRUCCION
                14	PROFESION
                15	DIRECCION
                16      EMAIL
                */
                if($_POST['5'] != ''){
                         $fecha = cambiarFormatoFecha($_POST['5'], 0);
                     }else{
                         $fecha = '1900-01-01';
                     }
                if($_POST['cedOld'] == $_POST['0'].$_POST['1']){
                    //$w=true;
                    $w = 1;//LA CEDULA NO FUE MODIFICADA
                }else{
                    if($objDoc->buscar("select * from docente where ceddocente='".$_POST['0'].$_POST['1']."'", $acceso)){
                       // $w=false;//EXISTE UN DOCENTE CON LA MISMA CEDULA
                        $w = 2;
                    }else{
                        //$w=true;
                        $w = 1;//LA CEDULA MODIFICADA NO EXISTE
                    }
                }
                if($w == 1){
                    if(strtoupper($_POST['mailOld']) == strtoupper($_POST['16'])){
                        $w = 1;//EL EMAIL NO FUE MODIFICADO
                    }else{
                         if($objDoc->buscar("select * from docente where maildocente='".strtoupper($_POST['16'])."'", $acceso)){
                           //$w=false;//EXISTE UN DOCENTE CON EL MISMO EMAIL
                            $w = 3;
                         }else{
                             //$w=true;
                            $w = 1;//EL EMAIL MODIFICADO NO EXISTE
                         } 
                    } 
                }
                
               
               if($w == 1){
                   if($objDoc->buscar("select * from docente where iddocente='".$_POST['id']."'", $acceso)){
//                       $objDoc->modificar("update docente set ceddocente='".$_POST['0']."',idpnf='".$_POST['7']."',idcomuni='".$_POST['11']."',nomdocente='".strtoupper($_POST['1'])."',apedocente='".strtoupper($_POST['2'])."', sexdocente='".$_POST['3']."',fnacimiento='".cambiarFormatoFecha($_POST['4'], '0')."',gradoinstruccion='".strtoupper($_POST['12'])."',profesion='".strtoupper($_POST['13'])."',direccdocente='".strtoupper($_POST['14'])."',telefdocente='".$_POST['6']."',maildocente='".strtoupper($_POST['15'])."' where iddocente='".$_POST['id']."'", $acceso);
                       $objDoc->modificar("update docente set ceddocente='".$_POST['0'].$_POST['1']."',idpnf='".$_POST['8']."',idcomuni='1',nomdocente='".strtoupper($_POST['2'])."',apedocente='".strtoupper($_POST['3'])."', sexdocente='".$_POST['4']."',fnacimiento='".$fecha."',gradoinstruccion='".htmlspecialchars(strtoupper($_POST['12']))."',profesion='".htmlspecialchars(strtoupper($_POST['14']))."',direccdocente='".htmlspecialchars(strtoupper($_POST['15']))."',telefdocente='".$_POST['7']."',maildocente='".strtoupper($_POST['16'])."' where iddocente='".$_POST['id']."'", $acceso);
                        $objSeguridad = new Seguridad();
                        $fecha = date('Y-m-d H:i:s');
                        $objSeguridad->setPropiedades($_SESSION['codUsu'], 'MODIFICACION DE DOCENTE CON CEDULA: '.$_POST['0'].$_POST['1'], $fecha);
                        $objSeguridad->ingresar($acceso);
                        if($_POST['jefe'] == 1){
                            $objJefe = new Jefepnf();
                            $hoy = date('Y-m-d');
                            $objJefe->modificar("UPDATE jefe_pnf SET statusjefe='0',fechasalidajefe='".$hoy."' WHERE statusjefe='1' AND idpnf='".$_POST['8']."'", $acceso);
                            if($objJefe->buscar("SELECT MAX(idjefe) AS maximo FROM jefe_pnf",$acceso)){
                               if($acceso->registros>0){
                                       $fila = $acceso->devolver_recordset();
                                       $codigoJefe = $fila['maximo'] + 1;
                               }else{
                                       $codigoJefe = 1;
                               }
                            }
                            $objJefe->setPropiedades($codigoJefe, '0', $_POST['8'], $_POST['id'], $hoy, '1900-01-01', '1');
                            $objJefe->ingresar($acceso);
                        }
                       echo 1;
                   }else{
                       echo 0;
                   }
               }else{
                   echo $w;
               }
               
               break;
               case bMunicipios:
                   $objMun = new Municipio();
                   if($objMun->buscar("select * from municipio WHERE idestado='".$_POST['codEstado']."' ORDER BY descripmunicipio ASC", $acceso)){
                       if($acceso->registros>0){
                            $result='[';
                            do{
                                    $fila = $acceso->devolver_recordset();
                                    $result.='{"ID":"'.$fila["idmunicipio"].'","DESCRIP":"'.$fila["descripmunicipio"].'"}';
                                    if(($acceso->registros) > ++$cont)
                                    {
                                            $result.=",";
                                    }
                                    $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                            $result.="]";
                            echo $result;
                        }else{
                            echo 0;
                        }
                   }
                   break;
              case eliminarDocente:
                  $objDoc = new Docente();
                  $w=false;
                  if($objDoc->buscar("select count(*) as cantidad from diagnostico where iddocente='".$_POST['id']."'", $acceso)){
                        $fila=$acceso->devolver_recordset();
                        if($fila['cantidad']>0){
                            $w=true;
                        }
                    }
                    if($objDoc->buscar("select count(*) as cantidad from diagnostico where doc_iddocente='".$_POST['id']."'", $acceso)){
                        $fila=$acceso->devolver_recordset();
                        if($fila['cantidad']>0){
                            $w=true;
                        }
                    }
                if($objDoc->buscar("select count(*) as cantidad from jefe_pnf where iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from anteproyecto where iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from anteproyecto where doc_iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from docente where idusuario<>0 and iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from evaluacion_proyecto where iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from evaluacion_proyecto where doc_iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from proyecto where iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from proyecto where doc_iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($objDoc->buscar("select count(*) as cantidad from comision_tecnica where iddocente='".$_POST['id']."'", $acceso)){
                    $fila=$acceso->devolver_recordset();
                    if($fila['cantidad']>0){
                        $w=true;
                    }
                }
                if($w){
                    echo 2;
                }else{
                    $objDoc->modificar("delete from docente where iddocente='".$_POST['id']."'", $acceso);
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'ELIMINACION DE DOCENTE CON ID: '.$_POST['id'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    echo 1;
                }  
              break;
                   
              case bParroquia:
                  $objPar = new Parroquia();
                   if($objPar->buscar("select * from parroquia WHERE idmunicipio='".$_POST['codMunicipio']."' ORDER BY descripparroquia ASC", $acceso)){
                       if($acceso->registros>0){
                            $result='[';
                            do{
                                    $fila = $acceso->devolver_recordset();
                                    $result.='{"ID":"'.$fila["idparroquia"].'","DESCRIP":"'.$fila["descripparroquia"].'"}';
                                    if(($acceso->registros) > ++$cont)
                                    {
                                            $result.=",";
                                    }
                                    $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                            $result.="]";
                            echo $result;
                        }else{
                            echo 0;
                        }
                   }
                  break;
              case bComunidad:
                  $objCom = new Comunidad();
                   if($objCom->buscar("select * from comunidad WHERE idparroquia='".$_POST['codParroquia']."' ORDER BY nomcomuni ASC", $acceso)){
                       if($acceso->registros>0){
                            $result='[';
                            do{
                                    $fila = $acceso->devolver_recordset();
                                    $result.='{"ID":"'.$fila["idcomuni"].'","DESCRIP":"'.$fila["nomcomuni"].'"}';
                                    if(($acceso->registros) > ++$cont)
                                    {
                                            $result.=",";
                                    }
                                    $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                            $result.="]";
                            echo $result;
                        }else{
                            echo 0;
                        }
                   }
              break;
          case buscarTodosDiag:
              $objDiag = new Diagnostico();
              if($objDiag->buscar("SELECT * FROM diagnostico WHERE idpnf='".$_POST['pnf']."' AND statusdiagnostico='INICIADO' ORDER BY descripdiagnostico ASC", $acceso)){
                    if($acceso->registros>0){
                        $i=0;
                        do{
                            $fila[$i] = $acceso->devolver_recordset();
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    }else{
                        $fila[0] = 0;
                    }
                }else{
                    $fila[0] = 0;
                }
                $json=new Services_JSON();
                $resp=$json->encode($fila);
                echo $resp;
              break;
            case buscarTodosCom:
                $objCom = new Comunidad();
              if($objCom->buscar("select * from comunidad ORDER BY nomcomuni ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                            $json=new Services_JSON();
                            $resp=$json->encode($fila);
                            echo $resp;
                        }else{
                            echo 0;
                        }
                    }else{
                        echo 0;
                    }
              break;
            case guardarComunidad:
                $objCom = new Comunidad();
                $objRes = new Personalsector();
                $objSec = new Sectorcomunidad();
                $objSeguridad = new Seguridad();
                   //VERIFICA QUE EL EMAIL NO ESTE REGISTRADO PARA OTRA PERSONA
                if($objRes->buscar("select * from personal_sector_comunidad where emailpersona='".strtoupper($_POST['emailresp'])."'", $acceso)){
                    echo 2;
                }else{
                    if($objCom->buscar("select max(idcomuni) as maximo from comunidad",$acceso)){
                        if($acceso->registros>0){
                            $row = $acceso->devolver_recordset();
                            $codigo = $row['maximo'] + 1;
                        }else{
                            $codigo = 1;
                        }
                        $fila[0][0]=$codigo;// CODIGO COMUNIDAD INGRESADA
                        $objCom->setPropiedades($fila[0][0], $_POST['parroquia'], $_POST['nomcomuni'], $_POST['dircomuni']);
                        if($objCom->ingresar($acceso)){
                            
                            $fecha = date('Y-m-d H:i:s');
                            $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE COMUNIDAD CON CODIGO: '.$fila[0][0], $fecha);
                            $objSeguridad->ingresar($acceso);
                            
                            if($objSec->buscar("select max(idsectorcomunidad) as maximo from sector_comunidad", $acceso)){
                                if($acceso->registros>0){
                                    $row = $acceso->devolver_recordset();
                                    $codigo = $row['maximo'] + 1;
                                }else{
                                        $codigo = 1;
                                }
                                $fila[1][0]=$codigo;// CODIGO SECTOR INGRESADO
                            }
                            $objSec->setPropiedades($fila[1][0], $fila[0][0], strtoupper($_POST['nomsect']), strtoupper($_POST['dirsect']));
                            if($objSec->ingresar($acceso)){
                                $fecha = date('Y-m-d H:i:s');
                                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE SECTOR CON CODIGO: '.$fila[1][0], $fecha);
                                $objSeguridad->ingresar($acceso);
                                if($objRes->buscar("select max(idpersona) as maximo from personal_sector_comunidad", $acceso)){
                                    if($acceso->registros>0){
                                        $row = $acceso->devolver_recordset();
                                        $codigo = $row['maximo'] + 1;
                                    }else{
                                            $codigo = 1;
                                    }
                                    $fila[2][0]=$codigo;// CODIGO RESPONSABLE INGRESADO
                                }
    //                                    $objRes->setPropiedades($id, $comunidad, $usuario, $cedula, $nombre, $apellido, $telefono, $direccion, $email)
//                                $objResp->setPropiedades($id, $sector, $usuario, $cedula, $nombre, $apellido, $telefono, $direccion, $email, $status, $sexo)
                                $objRes->setPropiedades($fila[2][0], $fila[1][0],0, $_POST['cedresp'], $_POST['nomresp'], $_POST['aperesp'], $_POST['telfresp'], $_POST['dirresp'], $_POST['emailresp'],'2',$_POST['sexo']);
                                if($objRes->ingresar($acceso)){
                                    
                                    $fecha = date('Y-m-d H:i:s');
                                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: '.$_POST['cedresp'], $fecha);
                                    $objSeguridad->ingresar($acceso);
                                    //OJO CAMBIO 01092012
                                    if($objCom->buscar("select * from comunidad  where idparroquia='".$_POST['parroquia']."' ORDER BY nomcomuni ASC", $acceso)){
                                        if($acceso->registros>0){
                                            $i=0;
                                            do{
                                               $fila[3][$i] = $acceso->devolver_recordset();
                                                $i++;
                                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
//                                                $json=new Services_JSON();
//                                                $resp=$json->encode($fila);
//                                                echo $resp;
                                        }
                                    }
                                    if($objSec->buscar("select * from sector_comunidad where idcomuni='".$fila[0][0]."' ORDER BY descripsector ASC", $acceso)){
                                        if($acceso->registros>0){
                                            $i=0;
                                            do{
                                               $fila[4][$i] = $acceso->devolver_recordset();
                                                $i++;
                                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
//                                                $json=new Services_JSON();
//                                                $resp=$json->encode($fila);
//                                                echo $resp;
                                        }
                                    }
                                    if($objRes->buscar("select * from personal_sector_comunidad where idsectorcomunidad='".$fila[1][0]."' AND statuspersona='1' ORDER BY nompersona,apepersona ASC", $acceso)){
                                        if($acceso->registros>0){
                                            $i=0;
                                            do{
                                               $fila[5][$i] = $acceso->devolver_recordset();
                                                $i++;
                                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                        }
                                    }
                                    $json=new Services_JSON();
                                    $resp=$json->encode($fila);
                                    echo $resp;
                                }
                            }else{
                                echo 0;
                            }                               
                        }else{
                            echo 0;
                        }
                    }
                    
                }
                  
              break;
              case bSectorComunidad:
                   $objSector = new Sectorcomunidad();
                  if($objSector->buscar("select * from sector_comunidad WHERE idcomuni='".$_POST['codComunidad']."' ORDER BY descripsector ASC", $acceso)){
                       if($acceso->registros>0){
                            $result='[';
                            do{
                                    $fila = $acceso->devolver_recordset();
                                    $result.='{"ID":"'.$fila["idsectorcomunidad"].'","DESCRIP":"'.$fila["descripsector"].'","DIRECCION":"'.$fila["dirsector"].'"}';
                                    if(($acceso->registros) > ++$cont)
                                    {
                                            $result.=",";
                                    }
                                    $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                            $result.="]";
                            echo $result;
                        }else{
                            echo 0;
                        }
                   }
              break;
              case buscarTodosSect:
                  $objSector = new Sectorcomunidad();
                  if($objSector->buscar("select * from sector_comunidad ORDER BY descripsector ASC", $acceso)){
                            if($acceso->registros>0){
                                $i=0;
                                do{
                                    $fila[$i] = $acceso->devolver_recordset();
                                    $i++;
                                }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                $json=new Services_JSON();
                                $resp=$json->encode($fila);
                                echo $resp;
                            }else{
                                echo 0;
                            }
                        }else{
                            echo 0;
                        }
              break;
              case guardarSector:
                  $objSector = new Sectorcomunidad();
                  $objRes = new Personalsector();
                  $objSeguridad = new Seguridad();
                  if($objSector->buscar("select max(idsectorcomunidad) as maximo from sector_comunidad",$acceso))
                    {
                            if($acceso->registros>0)
                            {
                                    $fila = $acceso->devolver_recordset();
                                    $codigo = $fila['maximo'] + 1;
                            }else{
                                    $codigo = 1;
                            }
                            $fila[0][0]=$codigo;//CODIGO SECTOR INGRESADO
                            $objSector->setPropiedades($codigo, $_POST['comunidad'], $_POST['nombre'], $_POST['direccion']);
                            if($objSector->ingresar($acceso)){
                                $fecha = date('Y-m-d H:i:s');
                                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE SECTOR COMUNIDAD CON CODIGO: '.$fila[0][0], $fecha);
                                $objSeguridad->ingresar($acceso);
                                
                                if($objRes->buscar("select max(idpersona) as maximo from personal_sector_comunidad", $acceso)){
                                    if($acceso->registros>0){
                                        $row = $acceso->devolver_recordset();
                                        $codigo = $row['maximo'] + 1;
                                    }else{
                                            $codigo = 1;
                                    }
                                    $fila[1][0]=$codigo;// CODIGO RESPONSABLE INGRESADO
                                }
                                $objRes->setPropiedades($fila[1][0], $fila[0][0],0, $_POST['cedresp'], $_POST['nomresp'], $_POST['aperesp'], $_POST['telfresp'], $_POST['dirresp'], $_POST['emailresp'],'2',$_POST['sexo']);
                                if($objRes->ingresar($acceso)){
                                    $fecha = date('Y-m-d H:i:s');
                                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: '.$_POST['cedresp'], $fecha);
                                    $objSeguridad->ingresar($acceso);
                                }
                                    
                                if($_POST['destino']==1){
                                    $objRes->buscar("select * from personal_sector_comunidad where idsectorcomunidad='".$fila[0][0]."' AND statuspersona='1'", $acceso);
                                    $i=0;
                                    do{
                                        $fila[2][$i] = $acceso->devolver_recordset();
                                        $i++;
                                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                    $sql="select * from sector_comunidad where idcomuni='".$_POST['comunidad']."' ORDER BY descripsector ASC";
                                }else{
                                    $sql="select * from sector_comunidad ORDER BY descripsector ASC";
                                }
                                
                                if($objSector->buscar($sql, $acceso)){
                                    if($acceso->registros>0){
                                        $i=0;
                                        do{
                                            $fila[3][$i] = $acceso->devolver_recordset();
                                            $i++;
                                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                        $json=new Services_JSON();
                                        $resp=$json->encode($fila);
                                        echo $resp;
//                            var_dump($fila);
                                    }
                                }
                            }else{
                                    echo 0;
                            }
                    }
              break;
              case buscarDoce:
                  $objUsuario = new Usuario();
                  $objJefe = new Jefepnf();
                  $objDoc = new Docente();
                  $objPnf = new Pnf();
                  $objComuni = new Comunidad();
                  if($objDoc->buscar("select * from docente where ceddocente='".$_POST['cedula']."'", $acceso)){
                      $fila[0][0] = $acceso->devolver_recordset();
                      
                      
                      
                      
                      $objPnf->buscar("select * from pnf", $acceso);
                      $i=0;
                      do{
                         $fila[1][$i] = $acceso->devolver_recordset();
                         $i++;
                      }while(($acceso->siguiente())&&($i!=$acceso->registros));
                      
                      $objComuni->buscar("select * from comunidad", $acceso);
                      $i=0;
                      do{
                         $fila[0][$i] = $acceso->devolver_recordset();
                         $i++;
                      }while(($acceso->siguiente())&&($i!=$acceso->registros));
                      
                      
                      $json=new Services_JSON();
                      $resp = $json->encode($fila);
                  }else{
                      $resp = 0;
                  }
                  echo $resp;
              break;
              case guardarJefeUsu:
                  $objUsuario = new Usuario();
                  $objJefe = new Jefepnf();
                  $objDoc = new Docente();
//                  0 = NACIONALIDAD
//                  1 = CEDULA
//                  2 = NOMBRE
//                  3 = APELLIDO
//                  4 = SEXO
//                  5 = FECHA DE NACIMIENTO
//                  7 = TELEFONO
//                  8 = COMUNIDAD
//                  9 = DIRECCION
//                  10 = CORREO
//                  11 = GRADO DE INSTRUCCION
//                  12 = PROFESION
//                  13 = PNF
//                  14 = FECHA INICIO
//                  16 = FECHA FIN
//                  18 = LOGIN
//                  CLAVE
                    
                if ($objUsuario->buscar("SELECT * FROM usuario WHERE login='".strtoupper($_POST['18'])."'", $acceso)){
                    echo 'Login registrado , verifique';
                }else{
                    if($objUsuario->buscar("SELECT MAX(idusuario) AS maximo FROM usuario WHERE idusuario!='0'",$acceso)){
                        $codigoUsu = '';
                        if($acceso->registros>0)
                        {
                                $fila = $acceso->devolver_recordset();
                                $codigoUsu = $fila['maximo'] + 1;
                        }else{
                                $codigoUsu = 1;
                        }
                    }
//                    die('usu: '.$codigoUsu);exit;
                    $objUsuario->setPropiedades($codigoUsu,$_POST['clave'], $_POST['18'], date("Y-n-j"), '1');
                    if($objUsuario->ingresar($acceso)){
                        $cedulaDoc = $_POST['0'].$_POST['1'];
                        if($objDoc->buscar("SELECT * FROM docente WHERE ceddocente='".$cedulaDoc."'", $acceso)){
                            echo 'Cedula del Docente duplicada, verifique';
                        }else{
                            if($objDoc->buscar("SELECT MAX(iddocente) AS maximo FROM docente",$acceso))
                            {
                                    if($acceso->registros>0)
                                    {
                                            $fila = $acceso->devolver_recordset();
                                            $codigoDoc = $fila['maximo'] + 1;
                                    }else{
                                            $codigoDoc = 1;
                                    }
                            }
                            $objDoc->setPropiedades($codigoDoc,
                                                    $codigoUsu, 
                                                    $_POST['13'], 
                                                    $_POST['8'], 
                                                    $cedulaDoc,
                                                    $_POST['2'], 
                                                    $_POST['3'], 
                                                    $_POST['4'], 
                                                    cambiarFormatoFecha($_POST['5'], 0), 
                                                    $_POST['7'],
                                                    $_POST['11'], 
                                                    $_POST['12'], 
                                                    $_POST['9'], 
                                                    $_POST['10']);

                            if($objDoc->ingresar($acceso)){
                                if($objJefe->buscar("SELECT MAX(idjefe) AS maximo FROM jefe_pnf",$acceso)){
                                        if($acceso->registros>0){
                                                $fila = $acceso->devolver_recordset();
                                                $codigoJef = $fila['maximo'] + 1;
                                        }else{
                                                $codigoJef = 1;
                                        }
                                }
                                $objJefe->setPropiedades($codigoJef, $codigoUsu, $_POST['13'], $codigoDoc, cambiarFormatoFecha($_POST['14'], 0), cambiarFormatoFecha($_POST['16'], 0), '1');
                                if($objJefe->ingresar($acceso)){
                                    echo 1;
                                }else{
                                    echo 'Error al ingresar JEFE DEL PNF';
                                }
                            }else{
                                echo 'Error al guardar el DOCENTE';
                            }
                        }
                    }else{
                        echo 'Error al guardar USUARIO';
                    }
                }
            break;
          case buscarLogin:
              $objUsuario = new Usuario();
              if($objUsuario->buscar("SELECT * FROM usuario WHERE login='".strtoupper($_POST['login'])."'", $acceso)){
                  echo 1;
              }else{
                  echo 0;
              }
          break;
          case validar_entrada:
            $objUsuario = new Usuario();
            $objDoc = new Docente();
            $objEstu = new Estudiante();
            $objJefe = new Jefepnf();
            $objCom = new Comunidad();
            if($objUsuario->buscar("SELECT * FROM usuario WHERE login='".strtoupper($_POST['login'])."' and clave='".$_POST['clave']."'", $acceso)){
                $fila = $acceso->devolver_recordset();
                $nivel = $fila['perfilusuario'];
                $_SESSION['codUsu'] = $fila['idusuario'];
                if($objDoc->buscar("select * from docente where idusuario='".$_SESSION['codUsu']."'", $acceso)){
                    $fila = $acceso->devolver_recordset();
                    $nombre = $fila['nomdocente'];
                    $apellido = $fila['apedocente'];
                    $comunidad = '';
                    $sector = '';
                }else if($objEstu->buscar("select * from estudiante where idusuario='".$_SESSION['codUsu']."'", $acceso)){
                    $fila = $acceso->devolver_recordset();
                    
                    $cedula = $fila['cedestudiante'];
                    
                    ///////////////////
                     $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                    //dominio del directorio de personal y estudiantes
                    $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                    // crea cliente soap para buscar persona
                    $client = new nusoap_client($wsdl, true);

                    $ldap = $client->getProxy();

                    if($client->fault) {
                            die('Error grave');
                    } else {
                            if($client->getError())
                                    die($client->getError());
                    }
                   // servicio para la busqueda de personas en el directorio
                    $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);

                    ////////////////
                    
                    $nombre = $data[0]['data'][0]['firstnames'];
                    $apellido = $data[0]['data'][0]['lastnames'];
                    $comunidad = '';
                    $sector = '';
                }else if($objCom->buscar("select P.*,C.nomcomuni from comunidad as C,personal_sector_comunidad as P 
                    where C.idcomuni IN(select S.idcomuni from sector_comunidad as S where S.idsectorcomunidad IN(select P.idsectorcomunidad from 
                    personal_sector_comunidad as P where P.idusuario='".$_SESSION['codUsu']."')) AND P.idusuario='".$_SESSION['codUsu']."'", $acceso)){
                    $fila = $acceso->devolver_recordset();
                    $nombre = $fila['nompersona'];
                    $apellido = $fila['apepersona'];
                    $comunidad = $fila['nomcomuni'];
                    $sector = $fila['idsectorcomunidad'];
                }
                
                $_SESSION['varEntrante'] = strtoupper($nombre).' '.strtoupper($apellido);
                $_SESSION['varNivel'] = $nivel;
                $_SESSION['varId'] = $_POST['login'];
                $_SESSION['idsectorentrante'] = $sector;
                
                if($_SESSION['varNivel'] == 1){
                    $_SESSION['entrada'] = 'admin';
                    //session_register('admin');
                }else if ($_SESSION['varNivel'] == 3){
                    $_SESSION['entrada'] = 'comunidad';
//                    session_register('comunidad');
                }
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'ENTRADA AL SISTEMA', $fecha);
                $objSeguridad->ingresar($acceso);
                
                echo 1;
            }else{
                echo 0;
            }
        break;
        case buscarComu:
            $objComuni = new Comunidad();
            $objEst = new Estado();
            $objMun = new Municipio();
            $objPar = new Parroquia();
            $objResp = new Personalsector();
            $objSector = new Sectorcomunidad();
            if($objComuni->buscar("select * from comunidad where idcomuni='".$_POST['codigo']."'", $acceso)){
                $fila[0]=$acceso->devolver_recordset();  
                if(strlen($fila[0]['idparroquia']) == 8){
                        $est = substr($fila[0]['idparroquia'], 0, 2);
                        $mun = substr($fila[0]['idparroquia'], 0, 5);
                   }else{
                       $est = substr($fila[0]['idparroquia'], 0, 1);
                       $mun = substr($fila[0]['idparroquia'], 0, 4);
                   }
                   $objMun->buscar("select * from municipio where idestado='".$est."' ORDER BY descripmunicipio ASC", $acceso);
                   $i=0;
                     do{
                        $temp = $acceso->devolver_recordset();
                        $fila[1][$i]=$temp;
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));

                   $objPar->buscar("select * from parroquia where idmunicipio='".$mun."' ORDER BY descripparroquia ASC", $acceso);
                   $i=0;
                     do{
                        $temp = $acceso->devolver_recordset();
                        $fila[2][$i]=$temp;
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    
                    $objEst->buscar("select * from estado ORDER BY descripestado ASC", $acceso);
                   $i=0;
                     do{
                        $temp = $acceso->devolver_recordset();
                        $fila[3][$i]=$temp;
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    
                    $objSector->buscar("select idsectorcomunidad from sector_comunidad where idcomuni='".$_POST['codigo']."'", $acceso);
                    
                    
                   $json=new Services_JSON();
                   $resp=$json->encode($fila);
                

            }else{
                $resp = 0;
            }
            echo $resp;
        break;
        case modificarComunidad:
            $objComuni = new Comunidad();
            if($objComuni->buscar("select * from comunidad where idcomuni='".$_POST['id']."'", $acceso)){
                $objComuni->modificar("update comunidad set idparroquia='".$_POST['parroquia']."', nomcomuni='".htmlspecialchars(strtoupper($_POST['nombre']))."',dircomuni='".htmlspecialchars(strtoupper($_POST['direccion']))."' where idcomuni='".$_POST['id']."'", $acceso);
                echo 1;
            }else{
                echo 0;
            }
        break;
        case eliminarComunidad:
            $objComuni = new Comunidad();
            $w=false;
            if($objComuni->buscar("select count(*) as cantidad from sector_comunidad where idcomuni='".$_POST['id']."'", $acceso)){
               $fila=$acceso->devolver_recordset();
               if($fila['cantidad']>0){
                   $w=true;
               }
               
            }
            if($objComuni->buscar("select count(*) as cantidad from docente where idcomuni='".$_POST['id']."'", $acceso)){
               $fila=$acceso->devolver_recordset();
               if($fila['cantidad']>0){
                   $w=true;
               }

            }
//            if($objComuni->buscar("select count(*) as cantidad from estudiante where idcomuni='".$_POST['id']."'", $acceso)){
//               $fila=$acceso->devolver_recordset();
//               if($fila['cantidad']>0){
//                   $w=true;
//               }
//
//            }
            if($w){
                echo 1;
            }else{
                $objComuni->modificar("delete from comunidad where idcomuni='".$_POST['id']."'", $acceso);
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'ELIMINACION DE LA COMUNIDAD CON CODIGO: '.$_POST['id'], $fecha);
                $objSeguridad->ingresar($acceso);
                echo 0;
            }
        break;
        case bResponsableSector:
            $objResponsable = new Personalsector();
            $sql = "SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['codSector']."' AND statuspersona='2'";
            if($objResponsable->buscar($sql, $acceso)){
                if($acceso->registros>0){
                     $temp[0] = $acceso->devolver_recordset();
                 }else{
                     $temp[0] = 0;
                 }
            }else{
                $temp[0] = 0;
            }
            $sql = "SELECT * FROM consejo_comunal WHERE idsectorcomunidad='".$_POST['codSector']."'";
            if($objResponsable->buscar($sql, $acceso)){
                if($acceso->registros>0){
                     $temp[1] = $acceso->devolver_recordset();
                 }else{
                     $temp[1] = 0;
                 }
            }else{
                $temp[1] = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($temp);
            echo $resp;
        break;
        case buscarTodosResp:
            $objResponsable = new Personalsector();
            $objResponsable->buscar("select * from personal_sector_comunidad where idsectorcomunidad='".$_POST['sector']."' ORDER BY nompersona,apepersona ASC", $acceso);
            if($acceso->registros>0){
                $i=0;
                do{
                    $fila[$i] = $acceso->devolver_recordset();
                    $i++;
                }while(($acceso->siguiente())&&($i!=$acceso->registros));
                $json=new Services_JSON();
                $resp=$json->encode($fila);
                echo $resp;
            }else{
                echo 0;
            }
        break;
        case buscarRepon:
            $objResponsable = new Personalsector();
            if($objResponsable->buscar("select * from personal_sector_comunidad where idpersona='".$_POST['codigo']."'", $acceso)){
                $fila = $acceso->devolver_recordset();
                $json=new Services_JSON();
                $resp=$json->encode($fila);
                echo $resp;
            }else{
                echo 0;
            }
        break;
        case modificarPersona:
            $objResponsable = new Personalsector();
            $objSeguridad = new Seguridad();
            if($_POST['cedOld'] == $_POST['cedula']){
                    //$w=true;
                    $w = 1;//LA CEDULA NO FUE MODIFICADA
            }else{
                if($objResponsable->buscar("SELECT * FROM personal_sector_comunidad WHERE cedpersona='".$_POST['cedula']."'", $acceso)){
                   // $w=false;//EXISTE UNA PERSONA CON LA MISMA CEDULA
                    $w = 3;
                }else{
                    //$w=true;
                    $w = 1;//LA CEDULA MODIFICADA NO EXISTE
                }
            }
            
            if($w == 1){
                if(strtoupper($_POST['emailOld']) == strtoupper($_POST['email'])){
                    $w = 1;//EL EMAIL NO FUE MODIFICADO
                }else{
                     if($objResponsable->buscar("SELECT * FROM personal_sector_comunidad WHERE emailpersona='".strtoupper($_POST['email'])."'", $acceso)){
                       //$w=false;//EXISTE UNA PERSONA CON EL MISMO EMAIL
                        $w = 2;
                     }else{
                         //$w=true;
                        $w = 1;//EL EMAIL MODIFICADO NO EXISTE
                     } 
                } 
            }
            if($w == 1){
                if($objResponsable->buscar("SELECT * FROM personal_sector_comunidad WHERE idpersona='".$_POST['id']."'", $acceso)){
                    $objResponsable->modificar("UPDATE personal_sector_comunidad SET cedpersona='".$_POST['cedula']."',nompersona='".strtoupper($_POST['nombre'])."',apepersona='".strtoupper($_POST['apellido'])."',telefpersona='".$_POST['telefono']."',dirpersona='".htmlspecialchars(strtoupper($_POST['direccion']))."', emailpersona='".strtoupper($_POST['email'])."' WHERE idpersona='".$_POST['id']."'", $acceso);
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'MODIFICACION DE PERSONA SECTOR CON CODIGO: '.$_POST['id'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    $fila[0][0]=$_POST['id'];
//                    if($_POST['destino']==1){
                        $sql="SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' ORDER BY nompersona,apepersona ASC";
//                    }else{
//                        $sql="select * from personal_sector_comunidad ORDER BY nompersona,apepersona ASC";
//                    }
                    if($objResponsable->buscar($sql, $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[1][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                            $json=new Services_JSON();
                            $resp=$json->encode($fila);
                            echo $resp;
                        }
                    }
//                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo $w;
            }
            
        break;
        case buscarReponsable:
            $objResponsable = new Personalsector();
            if($objResponsable->buscar("SELECT * FROM personal_sector_comunidad WHERE cedpersona='".$_POST['cedula']."'", $acceso)){
                echo 1;
            }else{
                echo 0;
            }
        break;
        case guardarReponsable:
            $objResponsable = new Personalsector();
            $objSeguridad = new Seguridad();
            if($objResponsable->buscar("SELECT * FROM personal_sector_comunidad WHERE cedpersona='".$_POST['cedula']."'", $acceso)){
                echo 3;// LA CEDULA INGRESADA EXISTE
            }else{
                if($objResponsable->buscar("SELECT * FROM personal_sector_comunidad WHERE emailpersona='".strtoupper($_POST['email'])."'", $acceso)){
                    echo 2;// EL EMAIL INGRESADO EXISTE
                }else{
                    if($objResponsable->buscar("SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' AND statuspersona='1'", $acceso)){
                        if($acceso->registros > 0){
                            $objResponsable->modificar("UPDATE personal_sector_comunidad SET statuspersona='1' WHERE idsectorcomunidad='".$_POST['sector']."'", $acceso);
                        }
                    }
                    if($objResponsable->buscar("SELECT max(idpersona) as maximo FROM personal_sector_comunidad",$acceso)){
                            if($acceso->registros>0){
                                    $fila = $acceso->devolver_recordset();
                                    $codigo = $fila['maximo'] + 1;
                            }else{
                                    $codigo = 1;
                            }
                    }
                    $fila[0][0]=$codigo;
                    $objResponsable->setPropiedades($codigo, $_POST['sector'], '0',$_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['direccion'], $_POST['email'],'2');
                    if($objResponsable->ingresar($acceso)){
                        $objSeguridad = new Seguridad();
                        $fecha = date('Y-m-d H:i:s');
                        $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE PERSONA SECTOR CON CODIGO: '.$fila[0][0], $fecha);
                        $objSeguridad->ingresar($acceso);
                        if($_POST['destino']==1){
                            $sql="SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' AND statuspersona='1' ORDER BY nompersona,apepersona ASC";
                        }else{
                            $sql="SELECT * FROM personal_sector_comunidad ORDER BY nompersona,apepersona ASC";
                        }
                        if($objResponsable->buscar($sql, $acceso)){
                            if($acceso->registros>0){
                                $i=0;
                                do{
                                    $fila[1][$i] = $acceso->devolver_recordset();
                                    $i++;
                                }while(($acceso->siguiente())&&($i!=$acceso->registros));
                                $json=new Services_JSON();
                                $resp=$json->encode($fila);
                                echo $resp;
                            }
                        }
                    }else{
                        echo 0;
                    }
                }
                
            }
        break;
        case buscarEstudiante:
            $objEst = new Estudiante();
            if($objEst->buscar("select * from estudiante where cedestudiante='".$_POST['cedula']."'", $acceso)){
                echo 1;
            }else{
                echo 0;
            }
        break;
        case guardarEstudiante:
            $objEst = new Estudiante();
            /*  0       NACIONALIDAD
             *  1	CEDULA
                2	NOMBRE
                3	APELLIDO
                4	SEXO
                5	FECHA DE NACIMIENTO                     
                7	TELEFONO
                8	PNF
                9	ESTADO
                10	MUNICIPIO
                11	PARROQUIA
                11	COMUNIDAD NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
                12	DIRECCION
                14      COREO ELECTRONICO
             */
//                    $objEst->setPropiedades($_POST['11'], '0', '0', $_POST['7'], $_POST['0'], strtoupper($_POST['1']), strtoupper($_POST['2']), $_POST['3'], strtoupper($_POST['12']), cambiarFormatoFecha($_POST['4'],0), $_POST['6'], strtoupper($_POST['13']));
                
                if($_POST['5'] != ''){
                    $fecha = cambiarFormatoFecha($_POST['5'],0);
                }else{
                    $fecha = '1900-01-01';
                }
                $objEst->setPropiedades('1', '0', '0', $_POST['8'], $_POST['0'].$_POST['1'], $_POST['2'], $_POST['3'], $_POST['4'], $_POST['12'], $fecha, $_POST['7'], $_POST['14']);
                if($objEst->ingresar($acceso)){
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE ESTUDIANTE CON CEDULA: '.$_POST['0'].$_POST['1'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    echo 1;
                }else{
                    echo 0;
                }
        break;
        case buscarTodosEst:
            $objEst = new Estudiante();
           if($objEst->buscar("select * from estudiante ORDER BY nomestudiante,apeestudiante ASC",$acceso)){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                    echo $resp;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        break;
        case buscarEst:
           $objEst = new Estudiante();
           $objCom = new Comunidad();
           $objPar = new Parroquia();
           $objMun = new Municipio();
           $objPar = new Parroquia();
           if($objEst->buscar("select * from estudiante where idestudiante='".$_POST['codigo']."'", $acceso)){
               if($acceso->registros>0){
                   $fila[0] = $acceso->devolver_recordset();
                   $objCom->buscar("select * from comunidad where idcomuni='".$fila[0]['idcomuni']."'", $acceso);
                   $fila[1] = $acceso->devolver_recordset();
                   if(strlen($fila[1]['idparroquia']) == 8){
                        $est = substr($fila[1]['idparroquia'], 0, 2);
                        $mun = substr($fila[1]['idparroquia'], 0, 5);
                   }else{
                       $est = substr($fila[1]['idparroquia'], 0, 1);
                       $mun = substr($fila[1]['idparroquia'], 0, 4);
                   }
                   $objMun->buscar("select * from municipio where idestado='".$est."' ORDER BY descripmunicipio ASC", $acceso);
                   $i=0;
                     do{
                        $temp = $acceso->devolver_recordset();
                        $fila[2][$i]=$temp;
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));

                   $objPar->buscar("select * from parroquia where idmunicipio='".$mun."' ORDER BY descripparroquia ASC", $acceso);
                   $i=0;
                     do{
                        $temp = $acceso->devolver_recordset();
                        $fila[3][$i]=$temp;
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));

                   $objPar->buscar("select * from estado ORDER BY descripestado ASC", $acceso);
                   $i=0;
                     do{
                        $temp = $acceso->devolver_recordset();
                        $fila[4][$i]=$temp;
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));

                    $objCom->buscar("select * from comunidad where idparroquia='".$fila[1]['idparroquia']."' ORDER BY nomcomuni ASC", $acceso);
                   $i=0;
                     do{
                        $temp = $acceso->devolver_recordset();
                        $fila[5][$i]=$temp;
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                   $json=new Services_JSON();
                   $resp=$json->encode($fila);
                   echo $resp;
               }else{
                   echo 2;
               }
           }else{
               echo 1;
           }
        break;
        case modificarEstudiante:
            $objEst = new Estudiante();
           /*
            0   NACIONALIDAD
            1	CEDULA
            2	NOMBRE
            3	APELLIDO                
            4	SEXO
            5	FECHA NACIMIENTO
            7	TELEFONO
            8	PNF
            9	ESTADO
            10	MUNICIPIO
            11	PARROQUIA
            11	COMUNIDAD noooooooooooooooooooooooooooooooo
            12	DIRECCION
            14  CORREO ELECTRONICO
            */

            if($_POST['5'] != ''){
                    $fecha = cambiarFormatoFecha($_POST['5'],0);
                }else{
                    $fecha = '1900-01-01';
                }
            if($_POST['cedOld'] == $_POST['0'].$_POST['1']){
//               $w=true;
                $w = 1;//LA CEDULA NO FUE MODIFICADA
            }else{
                if($objEst->buscar("select * from estudiante where cedestudiante='".$_POST['0'].$_POST['1']."'", $acceso)){
 //                   $w=false;
                    $w = 2;//EXISTE UN ESTUDIANTE CON LA MISMA CEDULA
                }else{
 //                   $w=true;
                    $w = 1;//LA CEDULA MODIFICADA NO EXISTE
                }
            }
            if($w == 1){
                if(strtoupper($_POST['mailOld'])  == strtoupper($_POST['14'])){
                    $w = 1;//EL EMAIL NO FUE MODIFICADO
                }else{
                    if($objEst->buscar("select * from estudiante where mailestudiante='".strtoupper($_POST['14'])."'", $acceso)){
                        $w = 3;//EXISTE UN ESTUDIANTE CON EL EMAIL MODIFICADO
                    }else{
                        $w = 1;//EL EMAIL MODIFICADOP NO EXISTE
                    }
                } 
            }
            
            
            if($w == 1){
                if($objEst->buscar("select * from estudiante where idestudiante='".$_POST['id']."'", $acceso)){
                    $objEst->modificar("update estudiante set idcomuni='1',idpnf='".$_POST['8']."',cedestudiante='".$_POST['0'].$_POST['1']."',nomestudiante='".strtoupper($_POST['2'])."',apeestudiante='".strtoupper($_POST['3'])."', sexestudiante='".$_POST['4']."',direstudiante='".htmlspecialchars(strtoupper($_POST['12']))."',fnacimientoest='".$fecha."',telefestudiante='".$_POST['7']."',mailestudiante='".strtoupper($_POST['14'])."' where idestudiante='".$_POST['id']."'", $acceso);
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'MODIFICACION DE ESTUDIANTE CON CODIGO: '.$_POST['id'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo $w;
            }
        break;
        
        case buscarPeriodo:
            $objPeriodo = new Periodo();
            if($objPeriodo->buscar("SELECT * FROM periodo_academico WHERE codperiodo='".$_POST['codigo']."'", $acceso)){
                echo 1;
            }else{
                echo 0;
            }
        break;
        case buscarTodosPer:
            $objPeriodo = new Periodo();
            if($objPeriodo->buscar("SELECT * FROM periodo_academico ORDER BY codperiodo ASC",$acceso)){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                    echo $resp;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        break;
        case guardarPeriodo:
            $objPeriodo = new Periodo();
            if($objPeriodo->buscar("select * from periodo_academico where codperiodo='".$_POST['periodo']."'", $acceso)){
                echo 2;//EXISTE UN PERIODO ACADEMICO CON EL MISMO CODIGO
            }else{
                $objPeriodo->setPropiedades($_POST['periodo'], cambiarFormatoFecha($_POST['fin'], 2), cambiarFormatoFecha($_POST['inicio'], 2));
                if($objPeriodo->ingresar($acceso)){
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE PERIODO CON CODIGO: '.$_POST['periodo'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    if($objPeriodo->buscar("select * from periodo_academico ORDER BY codperiodo ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[1][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                            $json=new Services_JSON();
                            $resp=$json->encode($fila);
                            echo $resp;
                        }
                    }
                }else{
                    echo 0;
                }
            }
        break;
        case buscarPer:
            $objPeriodo = new Periodo();
            if($objPeriodo->buscar("select * from periodo_academico WHERE idperiodo='".$_POST['codigo']."'", $acceso)){
               if($acceso->registros>0){
                    $fila = $acceso->devolver_recordset();
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                    echo $resp;
                }else{
                    echo 0;
                }
           }
        break;
        case modificarPeriodo:
            $objPeriodo = new Periodo();
            $w = 1;
            if($objPeriodo->buscar("select count(*) as cantidad from diagnostico where idperiodo='".$_POST['id']."'", $acceso)){
                $fila = $acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w = 4;
                }
            }
            if($objPeriodo->buscar("select count(*) as cantidad from anteproyecto where idperiodo='".$_POST['id']."'", $acceso)){
                $fila = $acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w=4;
                }
            }

            if($objPeriodo->buscar("select count(*) as cantidad from proyecto where idperiodo='".$_POST['id']."'", $acceso)){
                $fila = $acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w = 4;
                }
            }
            if($w == 1){
                if($_POST['codigo'] == $_POST['codOld']){
                    $w = 1;//NO MODIFICARON EL CODIGO DEL PERIODO
                }else{
                    if($objPeriodo->buscar("select * from periodo_academico where codperiodo='".$_POST['codigo']."'", $acceso)){
                        $w = 3;//EL CODIGO MODIFICADO EXISTE
                    }else{
                        $w = 1;//EL CODIGO MODIFICADO NO EXISTE
                    }
                }
            }
            
            if($w != 1){
                echo $w;
            }else{
                if($_POST['tipo'] == "modificar"){
                    $sql = "update periodo_academico set codperiodo='".$_POST['codigo']."',fechafinal='".cambiarFormatoFecha($_POST['fin'], 2)."',fechainicio='".cambiarFormatoFecha($_POST['inicio'], 2)."' where idperiodo='".$_POST['id']."'";
                    $accion = 'MODIFICACION';
                }else{
                    $sql = "delete from periodo_academico where idperiodo='".$_POST['id']."'";
                    $accion = 'ELIMINACION';
                }
//                var_dump($objPeriodo->modificar($sql, $acceso));
                if(!$objPeriodo->modificar($sql, $acceso)){
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], $accion.' DE PERIODO CON CODIGO: '.$_POST['id'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    echo 2;
                }else{
                    echo 0;
                }
            }
        break;
        case bEstGrupo:
            /*################# NUEVO UPTOS ############################*/
//                $cedula='16818597';
//                //token de seguridad
//                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';
//
//                //dominio del directorio de personal y estudiantes
//                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';
//
//                // crea cliente soap para buscar persona
//                $client = new nusoap_client($wsdl, true);
//
//
//                $ldap = $client->getProxy();
//
//                if($client->fault) {
//                        die('Error grave');
//                } else {
//                        if($client->getError())
//                                die($client->getError());
//                }
//               // servicio para la busqueda de personas en el directorio
//               $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
//               $json = new Services_JSON();
//                $resp = $json->encode($data);
//               echo $resp;
            /*################# NUEVO UPTOS ############################*/
            
//            $objEstud = new Estudiante();
//            if($objEstud->buscar("select * from estudiante where idgrupo=0 and idpnf='".$_POST['pnf']."' ORDER BY nomestudiante,apeestudiante ASC", $acceso)){
//                if($acceso->registros>0){
//                    $resp = $acceso->registros;
//                    $i = 0;
//                    do{
//                        $fila[$i] = $acceso->devolver_recordset();
//                        $i++;
//                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
//                }else{
//                    $fila[0] = 0;
//                }
//            }else{
//                $fila[0] = -1;
//            }
//            $json=new Services_JSON();
//            $resp=$json->encode($fila);
//            echo $resp;
        break;
        case buscarTodosPro:
            $objProblema = new Problema();
            if($_POST['destino'] == 1 || $_POST['destino'] == 4){
                $sql = "select * from problema where idsectorcomunidad='".$_POST['comuni']."' ORDER BY descripcionproblema ASC";
            }else{
                $sql = "select * from problema where idsectorcomunidad='".$_POST['comuni']."' and seleccionado='0' ORDER BY descripcionproblema ASC";
            }
            $resp = $objProblema->buscar($sql,$acceso);
            if($resp){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
//            print_r($fila);
            $json = new Services_JSON();
            $resp2 = $json->encode($fila);
            echo $resp2;
        break;
        case buscarProfesores:
            $objDocente = new Docente();
            $cedula = $_POST['ced'];
            /*################# NUEVO UPTOS ############################*/
//                $cedula='16818597';
                //token de seguridad
                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                //dominio del directorio de personal y estudiantes
                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';
                

                // crea cliente soap para buscar persona
                $client = new nusoap_client($wsdl, true);
                
                $ldap = $client->getProxy();
                
                if($client->fault) {
                        die('Error grave');
                } else {
                        if($client->getError())
                                die($client->getError());
                }
               // servicio para la busqueda de personas en el directorio
               $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
               
//               print_r('cedula: '.$data[0]['data'][0]['pin']);
               
               $sql = "SELECT * FROM docente WHERE ceddocente='".$data[0]['data'][0]['nationality'].$data[0]['data'][0]['pin']."'";
//               if($objEstudiante->buscar($sql, $acceso)){
               $objDocente->buscar($sql, $acceso);
                   if($acceso->registros > 0){
                       // NO HACE NADA
                   }else{
                       if($objDocente->buscar("SELECT MAX(iddocente) AS maximo FROM docente",$acceso)){
                            if($acceso->registros>0){
                                $row = $acceso->devolver_recordset();
                                $iddoc = $row['maximo'] + 1;
                            }else{
                                $iddoc = 1;
                            }
                       }
                       
                       $sql = "INSERT INTO docente (iddocente,idusuario,ceddocente,nomdocente,apedocente,sexdocente) VALUES ('".$iddoc."','0','".$data[0]['data'][0]['nationality'].$data[0]['data'][0]['pin']."','".$data[0]['data'][0]['firstnames']."','".$data[0]['data'][0]['lastnames']."','".$data[0]['data'][0]['sex']."')";
                       $objDocente->addDocente($sql, $acceso);
                       $data[0]['data'][0]['idInterno'] = $iddoc;
                   }
                
               $json = new Services_JSON();
               $resp = $json->encode($data[0]['data'][0]);
               echo $resp;
/*################# NUEVO UPTOS ############################*/
        break;
        case eliDiag:
            $objDiag = new Diagnostico();
            $objEstu = new Estudiante();
            $objGrupo = new Grupo();
            $objProblema = new Problema();
            if($objDiag->buscar("SELECT * FROM anteproyecto WHERE iddiagnostico='".$_POST['cod']."'", $acceso)){
                $resp = 2;//existen regitros asociados al diagnostico en anteproyecto
            }else{
                if($objDiag->buscar("select * from proyecto where iddiagnostico='".$_POST['cod']."'", $acceso)){
                    $resp = 3;//existen regitros asociados al diagnostico en proyecto
                }else{
                    if($objDiag->buscar("SELECT * FROM diagnostico WHERE iddiagnostico='".$_POST['cod']."'", $acceso)){
                        if($acceso->registros>0){
                            $fila = $acceso->devolver_recordset();
                            $codGrupo = $fila['idgrupo'];
                            $objEstu->modificar("UPDATE estudiante SET idgrupo='0' WHERE idgrupo='".$codGrupo."'", $acceso);
                            $objProblema->modificar("UPDATE problema SET seleccionado='0',iddiagnostico='0' WHERE iddiagnostico='".$_POST['cod']."'", $acceso);
                            if($objDiag->mostrar("delete from diagnostico where iddiagnostico='".$_POST['cod']."'", $acceso)){
                                $objGrupo->modificar("DELETE FROM grupo WHERE idgrupo='".$codGrupo."'", $acceso);
                                $resp = 1;
                            }else{
                                $resp = 0;
                            }
                        }
                    }
                }
            }
            echo $resp;
        break;
        case guardarProblema:
            $objProblema = new Problema();
            if($objProblema->buscar("select max(idproblema) as maximo from problema",$acceso)){
                if($acceso->registros>0){
                        $fila2 = $acceso->devolver_recordset();
                        $codigo = $fila2['maximo'] + 1;
                }else{
                        $codigo = 1;
                }
            }
            $fila[0][0] = $codigo;
            $objProblema->setPropiedades($fila[0][0],0, $_POST['sector'],  $_POST['desc'], $_POST['solucion'],'0');
            if($objProblema->ingresar($acceso)){
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE PROBLEMA CON CODIGO: '.$fila[0][0].' PARA EL SECTOR: '.$_POST['sector'], $fecha);
                $objSeguridad->ingresar($acceso);
                echo 1;
            }else{
                    echo 0;
            }
        break;
        case buscarProbMod:
            $objProblema = new Problema();
            if($objProblema->buscar("select * from problema where idproblema='".$_POST['codigo']."'", $acceso)){
                $fila = $acceso->devolver_recordset();
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case modificarProblem:
            $objProblema = new Problema();
            $sql = "update problema set descripcionproblema='".htmlspecialchars(strtoupper($_POST['desc']))."',posiblesolucion='".htmlspecialchars(strtoupper($_POST['solucion']))."' where idproblema='".$_POST['codigo']."' and idsectorcomunidad='".$_POST['sector']."'";
            if(!$objProblema->modificar($sql, $acceso)){
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'MODIFICACION DE PROBLEMA CON CODIGO: '.$_POST['codigo'].' PARA EL SECTOR: '.$_POST['sector'], $fecha);
                $objSeguridad->ingresar($acceso);
                echo 1;
            }else{
                echo 0;
            }
        break;
        case gdiagnostico:
            $objGrupo = new Grupo();
            $objDia = new Diagnostico();
            $objEstu = new Estudiante();
            $objJefePnf = new Jefepnf();
            $objProblema = new Problema();
            $objPnf = new Pnf();
            $grupo = explode('-', $_POST['gru']);
            if($objGrupo->buscar("select max(idgrupo) as maximo from grupo", $acceso)){
                if($acceso->registros > 0){
                    $fila = $acceso->devolver_recordset();
                    $codGrupo = $fila['maximo'] + 1;
                }else{
                    $codGrupo = 1;
                }
            }
            
            
            $objGrupo->setPropiedades($codGrupo, $_POST['seccion']);
            if($objGrupo->ingresar($acceso)){//PRIMERO SE INSERTA EL GRUPO
                for($i=0;$i<count($grupo);$i++){//LUEGO SE MODIFICA EL ESTUDIANTE INGRESANDOLE EL GRUPO
                    $objEstu->modificar("update estudiante set idgrupo='".$codGrupo."' where idestudiante='".$grupo[$i]."'", $acceso);
                }
            }else{
                echo 2;//ERROR AL INGRESAR GRUPO
            }
            $sql = "select * from jefe_pnf where statusjefe='1'";
            if($objJefePnf->buscar($sql, $acceso)){
                $fila = $acceso->devolver_recordset();
                $codJefe = $fila['idjefe'];
            }
            /*
             * STATUS
             * 0 = ELIMINADO
             * 1 = INICIADO
             * 
             */
            ///////////////////////////////////////////////////////// ARMAR CODIGO DEL DIAGNOSTICO
           $romanos = array("I","II","III","IV","V","VI","VII","VIII","IX","X");
           $tra = $romanos[$_POST['tra']-1];
            $datos[1] = 0;
            if($objPnf->buscar("select abrevpnf from pnf where idpnf='".$_POST['pnf']."'",$acceso)){
               if($acceso->registros>0){
                       $fila = $acceso->devolver_recordset();
                       $pnf = $fila['abrevpnf'];
               }else{
                      $pnf = 0;
               }
            }
            
            if($objDia->buscar("select max(iddiagnostico) as maximo from diagnostico where idpnf='".$_POST['pnf']."'",$acceso)){
               if($acceso->registros>0){
                       $fila = $acceso->devolver_recordset();
                       $diag = $fila['maximo'] + 1;
               }else{
                       $diag = 1;
               }
            }
            
            $relleno = '00000';
            $codDiag = $pnf."DIT".$tra.substr($relleno, count($diag)).$diag;
          
            $objDia->setPropiedades($diag, $_POST['res'], $_POST['doc'], $_POST['pnf'], $_POST['tut'], $_POST['sec'], $codGrupo, $_POST['per'], 
                                    $codJefe, $_POST['con'], cambiarFormatoFecha($_POST['fec'],0),$_POST['obs'], 
                                    $_POST['tra'], $_POST['tri'], $_POST['tit'], 'INICIADO',$codDiag);
//            $objDia->setPropiedades($codDiag, $_POST['res'], $_POST['doc'], $_POST['pnf'], $_POST['tut'], $_POST['sec'], $codGrupo, $_POST['per'], $codJefe, $_POST['con'], $_POST['fec'], $_POST['obs'], $_POST['tra'], $_POST['tri'], $_POST['tit'], '1');
            if($objDia->ingresar($acceso)){
                $sql = "update problema set seleccionado='1', iddiagnostico='".$diag."' where idproblema='".$_POST['prosel']."'";
                $objProblema->modificar($sql, $acceso);
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE DIAGNOSTICO CON CODIGO: '.$diag, $fecha);
                $objSeguridad->ingresar($acceso);
                $fila[0] = $diag;
                $fila[1] = $codGrupo;
                $json=new Services_JSON();
                $resp=$json->encode($fila);
                echo $resp;
            }else{
                echo 0;
            }
        break;
        case mdiagnostico:
            $objDia = new Diagnostico();
            $objProblema = new Problema();
            $objGrupo = new Grupo();
            $codigo = $_POST['codigo'];
            if($_POST['prosel'] != $_POST['proold']){
                $objProblema->modificar("UPDATE problema SET seleccionado='0',iddiagnostico='0' WHERE idproblema='".$_POST['proold']."'", $acceso);
                $objProblema->modificar("UPDATE problema SET seleccionado='1',iddiagnostico='".$codigo."' WHERE idproblema='".$_POST['prosel']."'", $acceso);
            }
            if($objGrupo->buscar("SELECT * FROM grupo WHERE idgrupo='".$_POST['idGrupo']."'", $acceso)){
                $objGrupo->modificar("UPDATE grupo SET seccion='".$_POST['seccion']."' WHERE idgrupo='".$_POST['idGrupo']."'", $acceso);
            }
            
            if($objDia->buscar("SELECT * FROM diagnostico WHERE iddiagnostico='".$codigo."'", $acceso)){
                $objDia->modificar("UPDATE diagnostico SET idpersona='".$_POST['res']."',
                iddocente='".$_POST['doc']."',doc_iddocente='".$_POST['tut']."',
                idsectorcomunidad='".$_POST['sec']."',idgrupo='".$_POST['idGrupo']."'
                ,idperiodo='".$_POST['per']."',nomconsejocomunal='".$_POST['con']."'
                ,fechadiagnostico='".$_POST['fec']."',observaciondiagnostico='".$_POST['obs']."'
                ,trayectodiagnostico='".$_POST['tra']."',trimestrediagnostico='".$_POST['tri']."'
                ,descripdiagnostico='".$_POST['tit']."'
                WHERE iddiagnostico='".$codigo."'", $acceso);
            }
            echo 5;
        break;

        case guadarProy:
            $objProyecto = new Proyecto();
            $objAntepro = new Anteproyecto();
            $objJefe = new Jefepnf();
            $objSeguridad = new Seguridad();
            $objPnf = new Pnf();
            if ($objAntepro->buscar("select * from anteproyecto where idantep='".$_POST['ant']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[1] = $acceso->devolver_recordset();
                }else{
                    $fila = -1;
                }
            }else{
                $fila = -1;
            }
            
            if($objJefe->buscar("SELECT * FROM jefe_pnf WHERE idpnf='".$_POST['pnf']."' AND statusjefe='1'", $acceso)){
                if($acceso->registros > 0){
                    $fila[4] = $acceso->devolver_recordset();
                }else{
                    $fila[4] = -1;
                }
            }else{
                $fila[4] = -1;
            }
            $romanos = array("I","II","III","IV","V","VI","VII","VIII","IX","X");
            $tra = $romanos[$_POST['tra']-1];
            if($objPnf->buscar("select abrevpnf from pnf where idpnf='".$_POST['pnf']."'",$acceso)){
               if($acceso->registros>0){
                       $fila[2] = $acceso->devolver_recordset();
                       $pnf = $fila[2]['abrevpnf'];
               }else{
                      $pnf = 0;
               }
            }
            if($objProyecto->buscar("select max(idproyecto) as maximo from proyecto where idpnf='".$_POST['pnf']."'",$acceso)){
               if($acceso->registros>0){
                       $fila[3] = $acceso->devolver_recordset();
                       $proy = $fila[3]['maximo'] + 1;
               }else{
                       $proy = 1;
               }
            }
            $relleno = '00000';
            $codProy = $pnf."PROT".$tra.substr($relleno, count($proy)).$proy;
            
            $objProyecto->setPropiedades($_POST['gru'], $_POST['ant'], $fila[4]['idjefe'], $_POST['doc'], $_POST['pnf'], $_POST['tut'], $fila[1]['idpersona'],
                    $_POST['pro'], $fila[1]['iddiagnostico'],$_POST['per'], $codProy, $_POST['tit'], $_POST['obj'], 
                    $_POST['are'], $_POST['tri'], $_POST['tra'], cambiarFormatoFecha($_POST['fec'],2), $_POST['obs'], 'INICIADO');

            if($objProyecto->ingresar($acceso)){
                $objAntepro->modificar("UPDATE anteproyecto SET statusante='PROCESADO' where idantep='".$_POST['ant']."'",$acceso);
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objAntepro->buscar("select max(idproyecto) from proyecto", $acceso);
                $cod = $acceso->devolver_recordset();
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE PROYECTO CON CODIGO: '.$cod['idproyecto'], $fecha);
                $objSeguridad->ingresar($acceso);
                echo 1;
            }else{
                echo 0;
            }
            
//            if($resp){
//                echo 1;
//            }else{
//                echo 0;
//            }
        break;
        case buscarTodosProy:
            $objProyecto =new Proyecto();
            if($objProyecto->buscar("select * from proyecto WHERE idproyecto NOT IN (select idproyecto from evaluacion_proyecto) AND idpnf = '".$_POST['pnf']."' ORDER BY nomproyecto ASC", $acceso)){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                }else{
                    $resp = 0;
                }
            }else{
                $resp = 0;
            }
            echo $resp;
        break;
        case busDiag:
            $objDiag = new Diagnostico();
            $objDoc = new Docente();
            $objSector = new Sectorcomunidad();
            $objComuni = new Comunidad();
            $objPar = new Parroquia();
            $objMun = new Municipio();
            $objGru = new Grupo();
            $objProb = new Problema();
            $objEstu = new Estudiante();
            $objPnf = new Pnf();
            $w = TRUE;
            if($objDiag->buscar("SELECT * FROM anteproyecto WHERE iddiagnostico='".$_POST['cod']."'", $acceso)){
                if($acceso->registros > 0){
                    $w = FALSE;
                    $resp = -1;
                }
            }
            if($objDiag->buscar("SELECT * FROM proyecto WHERE iddiagnostico='".$_POST['cod']."'", $acceso)){
                if($acceso->registros > 0){
                    $w = FALSE;
                    $resp = -2;
                }
            }
            
            if($w){
                if($objDiag->buscar("select * from diagnostico where iddiagnostico='".$_POST['cod']."'", $acceso)){
                    $fila[0] = $acceso->devolver_recordset();
                    if($objDoc->buscar("select iddocente,nomdocente,apedocente from docente ORDER BY nomdocente,apedocente ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[1][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }else{
                        $fila[1]=0;
                    }

                    if($objComuni->buscar("select idcomuni,nomcomuni from comunidad ORDER BY nomcomuni ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[2][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }else{
                        $fila[2]=0;
                    }          

                    if($objSector->buscar("select A.idsectorcomunidad,A.descripsector,A.idcomuni from sector_comunidad as A where A.idcomuni in(
                                        select B.idcomuni from sector_comunidad as B where idsectorcomunidad='".$fila[0]['idsectorcomunidad']."') ORDER BY A.descripsector ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[3][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }else{
                        $fila[3]=0;
                    }

                    if($objSector->buscar("select idpersona,nompersona,apepersona from personal_sector_comunidad where idsectorcomunidad='".$fila[0]['idsectorcomunidad']."' ORDER BY nompersona,apepersona ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[4][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }else{
                        $fila[4]=0;
                    }

                    if($objGru->buscar("select * from grupo ORDER BY idgrupo ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[5][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }else{
                        $fila[5]=0;
                    }

                    //if($objGru->buscar("select A.idproblema,A.descripcionproblema,B.seleccionado from problema as A INNER JOIN diagnostico_problemas as B on A.idproblema=B.idproblema where B.iddiagnostico='".$_POST['cod']."'", $acceso)){
                    if($objGru->buscar("SELECT idproblema,descripcionproblema,seleccionado,iddiagnostico FROM problema WHERE idsectorcomunidad='".$fila[0]['idsectorcomunidad']."'", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[7][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }else{
                        $fila[7]=0;
                    }
                    
                    
/////////////////////////////
                    //token de seguridad
                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                //dominio del directorio de personal y estudiantes
                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                // crea cliente soap para buscar persona
                $client = new nusoap_client($wsdl, true);
                
                $ldap = $client->getProxy();
                
                if($client->fault) {
                        die('Error grave');
                } else {
                        if($client->getError())
                                die($client->getError());
                }
                
                
                if($objEstu->buscar("select * from estudiante WHERE idgrupo='".$fila[0]['idgrupo']."'", $acceso)){
                    if($acceso->registros > 0){
                        $i=0;
                        do{
                            $fila = $acceso->devolver_recordset();
                            $cedula = $fila['cedestudiante'];
                            $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
                            $fila[8][$i] = $data[0]['data'][0];
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    }
                }else{
                    $fila[8]=0;
                }
               // servicio para la busqueda de personas en el directorio
//               $data = 
///////////////////////////////////////////////////               
//                    if($objEstu->buscar("select idestudiante,cedestudiante,nomestudiante,apeestudiante,idgrupo from estudiante WHERE idgrupo='".$fila[0]['idgrupo']."' ORDER BY cedestudiante,nomestudiante,apeestudiante ASC", $acceso)){
//                        if($acceso->registros>0){
//                            $i=0;
//                            do{
//                                $fila[8][$i] = $acceso->devolver_recordset();
//                                $i++;
//                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
//                        }
//                    }else{
//                        $fila[8]=0;
//                    }

                    if($objPnf->buscar("SELECT * FROM pnf", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila[9][$i] = $acceso->devolver_recordset();
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }else{
                        $fila[9] = 0;
                    }
                    $objComuni->buscar("SELECT * FROM comunidad WHERE idcomuni='".$fila[3][0]['idcomuni']."'", $acceso);
                    $fila[11] = $acceso->devolver_recordset();
                    if(strlen($fila[11]['idparroquia']) == 8){
                         $est = substr($fila[11]['idparroquia'], 0, 2);
                         $mun = substr($fila[11]['idparroquia'], 0, 5);
                    }else{
                        $est = substr($fila[11]['idparroquia'], 0, 1);
                        $mun = substr($fila[11]['idparroquia'], 0, 4);
                    }
                    $fila[10] = $est;
                    $fila[16] = $mun;
                    $objMun->buscar("select * from municipio where idestado='".$est."' ORDER BY descripmunicipio ASC", $acceso);
                    $i=0;
                    do{
                       $temp = $acceso->devolver_recordset();
                       $fila[12][$i]=$temp;
                       $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $objPar->buscar("select * from parroquia where idmunicipio='".$mun."' ORDER BY descripparroquia ASC", $acceso);
                    $i=0;
                    do{
                       $temp = $acceso->devolver_recordset();
                       $fila[13][$i]=$temp;
                       $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $objPar->buscar("select * from estado ORDER BY descripestado ASC", $acceso);
                    $i=0;
                      do{
                         $temp = $acceso->devolver_recordset();
                         $fila[14][$i]=$temp;
                         $i++;
                     }while(($acceso->siguiente())&&($i!=$acceso->registros));

                     $objComuni->buscar("select * from comunidad where idparroquia='".$fila[11]['idparroquia']."' ORDER BY nomcomuni ASC", $acceso);
                    $i=0;
                      do{
                         $temp = $acceso->devolver_recordset();
                         $fila[15][$i]=$temp;
                         $i++;
                     }while(($acceso->siguiente())&&($i!=$acceso->registros));
                     for($i = 0;$i < count($fila[5]);$i++){
                         if($fila[5]['idgrupo'] == $fila[0]['idgrupo']){
                             $fila[16] = $fila[5]['seccion'];
                             $i = count($fila[5]);
                         }
                     }
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                }else{
                    $resp = 0;
                }
            }
            echo $resp;
        break;
        /////////////////prueba
        case buscarEstGrupo:
            
        break;
        
        
        //////
        case ElimEstGrupo:
            $objEstudiante = new Estudiante();
            if($objEstudiante->buscar("SELECT * FROM estudiante WHERE idestudiante='".$_POST['idEstu']."'", $acceso)){
                if($acceso->registros > 0){
                    $estu = $acceso->devolver_recordset();
                    $objEstudiante->modificar("UPDATE estudiante SET idgrupo=0 WHERE idestudiante='".$_POST['idEstu']."'", $acceso);
                    
                    if($objEstudiante->buscar("select idestudiante,cedestudiante,nomestudiante,apeestudiante,idgrupo from estudiante WHERE idgrupo='".$estu['idgrupo']."' ORDER BY cedestudiante,nomestudiante,apeestudiante ASC", $acceso)){
                        if($acceso->registros>0){
                            $i=0;
                            do{
                                $fila = $acceso->devolver_recordset();
                                $cedula = $fila['cedestudiante'];
///////////////////////////////////////////////////////////////////////
                                //token de seguridad
                                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                                //dominio del directorio de personal y estudiantes
                                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                                // crea cliente soap para buscar persona
                                $client = new nusoap_client($wsdl, true);

                                $ldap = $client->getProxy();

                                if($client->fault) {
                                        die('Error grave');
                                } else {
                                        if($client->getError())
                                                die($client->getError());
                                }
                               

                                // servicio para la busqueda de personas en el directorio
                                
                                $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
//////////////////////////////////////////////////////////////////////////////////////               
                                
                                $fila[$i] = $data[0]['data'][0];
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }else{
                            $fila = 0;
                        }
                    }else{
                        $fila = 0;
                    }
                }else{
                    $fila=-2;
                }
            }else{
                $fila=-3;
            }
            $json = new Services_JSON();
            $resp = $json->encode($fila);
            echo $resp;
        break;
        case guardarNoticia:
            $objNoticia = new Noticia();
            $objUsuario = new Usuario();
            if($objNoticia->buscar("select max(idnoticia) as maximo from noticia",$acceso))
            {
                if($acceso->registros>0)
                {
                        $row = $acceso->devolver_recordset();
                        $codigo = $row['maximo'] + 1;
                }else{
                        $codigo = 1;
                }
                $login = $_SESSION['varId'];
                $hora = date("H:i:s");
                $fecha = date("d-m-Y");
                $objNoticia->setPropiedades($codigo,$_SESSION['codUsu'], $_POST['descrip'], $hora,cambiarFormatoFecha($fecha,0),'1', $_POST['titu']);
                if($objNoticia->ingresar($acceso)){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        break;
        case eliminarNoticia:
            $objNoticia = new Noticia();
            if($objNoticia->buscar("select * from noticia where idnoticia='".$_POST['id']."'", $acceso)){
                $objNoticia->modificar("delete from noticia where idnoticia='".$_POST['id']."'", $acceso);
                echo 1;
            }else{
                echo 0;
            }
        break;
        case buscarTodasNot:
            $objNoticia = new Noticia();
            if($objNoticia->buscar("select * from noticia where statusnoticia='1' ORDER BY titularnoticia ASC",$acceso)){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                    echo $resp;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        break;
        case buscarNoticia:
            $objNoticia = new Noticia();
            if($objNoticia->buscar("select * from noticia where idnoticia='".$_POST['id']."'", $acceso)){
                $fila = $acceso->devolver_recordset();
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case modificarNoticia:
            $objNoticia = new Noticia();
            if($objNoticia->buscar("select * from noticia where idnoticia='".$_POST['codigo']."'", $acceso)){
                $objNoticia->modificar("update noticia set titularnoticia='".htmlspecialchars(strtoupper($_POST['titu']))."', descripnoticia='".htmlspecialchars(strtoupper($_POST['descrip']))."' where idnoticia='".$_POST['codigo']."'", $acceso);
                echo 1;
            }else{
                echo 0;
            }
        break;
        case buscarTodosAnte:
            $objAnte = new Anteproyecto();
            if($objAnte->buscar("SELECT * FROM anteproyecto WHERE statusante='INICIADO' AND idpnf='".$_POST['pnf']."' ORDER BY nomantep ASC",$acceso)){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarDatosDiag:
            $objDiag = new Diagnostico();
            $objProblema = new Problema();
            $objEstudiante = new Estudiante();
            $objSector = new Sectorcomunidad();
            $objComunidad = new Comunidad();
            $objPersonalsector = new Personalsector();
            $objDocente = new Docente();
            if ($objDiag->buscar("select * from diagnostico where iddiagnostico='".$_POST['codigo']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[0] = $acceso->devolver_recordset();
                }else{
                    $fila[0] = -1;
                }
            }else{
                $fila[0] = -1;
            }
            
            if($objProblema->buscar("select * from problema where iddiagnostico='".$_POST['codigo']."'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[1][$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[1] = -2;
                }
            }else{
                $fila[1] = -2;
            }
            
            
/////////////////////////////
            //token de seguridad
                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                //dominio del directorio de personal y estudiantes
                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                // crea cliente soap para buscar persona
                $client = new nusoap_client($wsdl, true);
                
                $ldap = $client->getProxy();
                
                if($client->fault) {
                        die('Error grave');
                } else {
                        if($client->getError())
                                die($client->getError());
                }
               
/////////////////////////////            
            
            
            if($objEstudiante->buscar("select * from estudiante where idgrupo='".$fila[0]['idgrupo']."' ORDER BY nomestudiante,apeestudiante", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila = $acceso->devolver_recordset();
                        // servicio para la busqueda de personas en el directorio
                        $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
                        $fila[2][$i] = $data[0]['data'][0];
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[2] = -3;
                }
            }else{
                $fila[2] = -3;
            }
            
            if($objSector->buscar("select * from sector_comunidad where idsectorcomunidad='".$fila[0]['idsectorcomunidad']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[3] = $acceso->devolver_recordset();
                }else{
                    $fila[3] = -4;
                }
            }else{
                $fila[3] = -4;
            }
            
            if ($objComunidad->buscar("select * from comunidad where idcomuni='".$fila[3]['idcomuni']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[4] = $acceso->devolver_recordset();
                }else{
                    $fila[4] = -5;
                }
            }else{
                $fila[4] = -5;
            }
            
            if($objPersonalsector->buscar("select * from personal_sector_comunidad where idpersona='".$fila[0]['idpersona']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[5] = $acceso->devolver_recordset();
                }else{
                    $fila[5] = -6;
                }
            }else{
                $fila[5] = -6;
            }
            
            if($objEstudiante->buscar("select * from docente ORDER BY nomdocente,apedocente ASC", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[6][$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[6] = -7;
                }
            }else{
                $fila[6] = -7;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarDiag:
            $objDiag = new Diagnostico();
//            $sql = "select d.iddiagnostico, d.descripdiagnostico FROM problema as p, diagnostico as d LEFT JOIN anteproyecto as a  ON
//                    d.iddiagnostico = a.iddiagnostico where d.idpnf='".$_POST['pnf']."' and a.iddiagnostico IS NULL and p.iddiagnostico=d.iddiagnostico
//                    ORDER BY d.descripdiagnostico ASC";
            $sql = "SELECT * FROM diagnostico WHERE idpnf='".$_POST['pnf']."' AND statusdiagnostico='INICIADO' ORDER BY descripdiagnostico ASC";
            if($objDiag->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    $j = 0;
                    do{
                        $fila2 = $acceso->devolver_recordset();
                        if($fila2['iddiagnostico'] != 0){
                            $fila[$j++] = $fila2;
                        }
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[0] = -1;
                }
            }else{
                $fila[0] = -1;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case guardarAnteproyecto:
            $objAnte = new Anteproyecto();
            $objDiagnostico = new Diagnostico();
            $objProblema = new Problema();
            $objPnf = new Pnf();
            
            if ($objDiagnostico->buscar("SELECT * FROM diagnostico WHERE iddiagnostico='".$_POST['dia']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[0] = $acceso->devolver_recordset();
                }else{
                    $fila[0] = -1;
                }
            }else{
                $fila[0] = -1;
            }
            
            if($objProblema->buscar("select * from problema where iddiagnostico='".$_POST['dia']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[1] = $acceso->devolver_recordset();
                }else{
                    $fila[1] = -2;
                }
            }else{
                $fila[1] = -2;
            }
            
            $romanos = array("I","II","III","IV","V","VI","VII","VIII","IX","X");
            $tra = $romanos[$_POST['tra']-1];
//            $datos[1] = 0;
            if($objPnf->buscar("select abrevpnf from pnf where idpnf='".$_POST['pnf']."'",$acceso)){
               if($acceso->registros>0){
                       $fila[2] = $acceso->devolver_recordset();
                       $pnf = $fila[2]['abrevpnf'];
               }else{
                      $pnf = 0;
               }
            }
           
            if($objAnte->buscar("select max(idantep) as maximo from anteproyecto where idpnf='".$_POST['pnf']."'",$acceso)){
               if($acceso->registros>0){
                       $fila[3] = $acceso->devolver_recordset();
                       $antep = $fila[3]['maximo'] + 1;
               }else{
                       $antep = 1;
               }
            }
//             print_r($fila);
            $relleno = '00000';
            $codAntep = $pnf."ANTT".$tra.substr($relleno, count($antep)).$antep;
            $objAnte->setPropiedades($fila[0]['idjefe'], $_POST['per'], $fila[1]['idproblema'], $fila[0]['idgrupo'], $_POST['dia'],$fila[0]['idpersona'], $_POST['doc'], $_POST['tut'], $_POST['pnf'], $_POST['tit'],$_POST['obj'], $_POST['tra'], $_POST['tri'], cambiarFormatoFecha($_POST['fec'],0), $_POST['obs'],'INICIADO',$codAntep);
            if($objAnte->ingresar($acceso)){
                $objDiagnostico->modificar("UPDATE diagnostico SET statusdiagnostico='PROCESADO' WHERE iddiagnostico='".$_POST['dia']."'", $acceso);
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objAnte->buscar("select max(idantep) from anteproyecto", $acceso);
                $cod = $acceso->devolver_recordset();
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE ANTEPROYECTO CON CODIGO: '.$cod['idantep'], $fecha);
                $objSeguridad->ingresar($acceso);
                echo 1;
            }else{
                echo 0;
            }
        break;
        
        case busUsu:
            $objUsuario = new Usuario();
            $objPersonal = new Personalsector();
            if($objUsuario->buscar("select D.iddocente,D.idusuario,D.nomdocente,D.apedocente,D.telefdocente,D.maildocente,C.nomcomuni from docente as D,comunidad as C where ceddocente='".$_POST['cedula']."' AND D.idcomuni=C.idcomuni", $acceso)){
                $fila = $acceso->devolver_recordset();
                $result.='[{"IDUSUARIO":"'.$fila["idusuario"].'","ID":"'.$fila["iddocente"].'","NOMBRE":"'.strtoupper(convUTF('2',$fila["nomdocente"])).'","APELLIDO":"'.strtoupper(convUTF('2',$fila["apedocente"])).'","TELEFONO":"'.$fila["telefdocente"].'","EMAIL":"'.strtoupper($fila["maildocente"]).'","COMUNIDAD":"'.strtoupper(convUTF('2',$fila["nomcomuni"])).'","TIPO":"DOCENTE"}]';
            }else{
//            $resp = $objPersonal->buscar("select * from personal_sector_comunidad where cedpersona='".$_POST['cedula']."'", $acceso);
                $sql = "select P.idpersona,C.nomcomuni,P.nompersona,P.apepersona,P.idpersona,P.telefpersona,P.emailpersona from comunidad as C,personal_sector_comunidad as P 
                    where C.idcomuni IN(select S.idcomuni from sector_comunidad as S where S.idsectorcomunidad IN(select P.idsectorcomunidad from 
                    personal_sector_comunidad as P where cedpersona='".$_POST['cedula']."')) AND P.cedpersona='".$_POST['cedula']."' AND P.statuspersona='1' OR P.statuspersona='2'";
                //if($objPersonal->buscar("select P.idusuario,P.nompersona,P.apepersona,P.telefpersona,P.emailpersona,C.nomcomuni from personal_sector_comunidad as P, comunidad as C where cedpersona='".$_POST['cedula']."' AND P.idcomuni=C.idcomuni", $acceso)){
                if($objPersonal->buscar($sql, $acceso)){
                    $fila = $acceso->devolver_recordset();
                    $result.='[{"IDUSUARIO":"'.$fila["idusuario"].'","ID":"'.$fila["idpersona"].'","NOMBRE":"'.strtoupper(convUTF('2',$fila["nompersona"])).'","APELLIDO":"'.strtoupper(convUTF('2',$fila["apepersona"])).'","TELEFONO":"'.$fila["telefpersona"].'","EMAIL":"'.strtoupper(convUTF('2',$fila["emailpersona"])).'","COMUNIDAD":"'.strtoupper(convUTF('2',$fila["nomcomuni"])).'","TIPO":"COMUNIDAD"}]';
                }else{
                    $fila = 0;
                }
            }
            echo $result;
        break;
        case busTodoUsu:
            $objUsuario = new Usuario();
            $sql = "select u.idusuario as IDUSUARIO, u.login as LOGIN, d.ceddocente as CEDULA, (d.nomdocente || ' ' || d.apedocente) as NOMBRE FROM usuario as u 
                    INNER JOIN docente as d  ON u.idusuario = d.idusuario and u.idusuario != 0";
            if($objUsuario->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[] = $acceso->devolver_recordset();
                        ++$i;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }
            }
            $sql = "select u.idusuario as IDUSUARIO, u.login as LOGIN, p.cedpersona as CEDULA, (p.nompersona || ' ' || p.apepersona) as NOMBRE FROM usuario as u 
                    INNER JOIN personal_sector_comunidad as p  ON u.idusuario = p.idusuario and u.idusuario != 0";
            if($objUsuario->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[] = $acceso->devolver_recordset();
                        ++$i;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case guardarUsu:
            $objUsuario = new Usuario();
            $objDocente = new Docente();
            $objPersona = new Personalsector();
            if($objUsuario->buscar("SELECT * FROM usuario WHERE login='".strtoupper($_POST['login'])."'", $acceso)){
                $resp = 1;
            }else{
                if($objUsuario->buscar("SELECT MAX(idusuario) AS maximo FROM usuario",$acceso)){
                    if($acceso->registros > 0){
                            $fila = $acceso->devolver_recordset();
                            $codigo = $fila['maximo'] + 1;
                    }else{
                            $codigo = 1;
                    }
                }
                $objUsuario->setPropiedades($codigo, $_POST['clave'], strtolower($_POST['login']), date('Y-m-d'), $_POST['perfil']);
                if($objUsuario->ingresar($acceso)){
                    if($objDocente->buscar("SELECT * FROM docente WHERE ceddocente='".$_POST['cedula']."'", $acceso)){
                        $objDocente->modificar("UPDATE docente SET idusuario='".$codigo."' WHERE ceddocente='".$_POST['cedula']."'", $acceso);
                    }else{
                        if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE cedpersona='".$_POST['cedula']."'", $acceso)){
                            $objDocente->modificar("UPDATE personal_sector_comunidad SET idusuario='".$codigo."' WHERE cedpersona='".$_POST['cedula']."'", $acceso);
                        }
                    }
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE USUARIO, CON LOGIN: '.strtolower($_POST['login']), $fecha);
                    $objSeguridad->ingresar($acceso);
                    $resp = 0;
                }
            }
            echo $resp;
        break;
        case buscarUsu:
            $objUsuario = new Usuario();
            $objDocente = new Docente();
            $objPersona = new Personalsector();
            if($objUsuario->buscar("select login, perfilusuario as PERFIL from usuario where idusuario='".$_POST['codigo']."'", $acceso)){
                $fila[] = $acceso->devolver_recordset();
            }
            if($objDocente->buscar("select ceddocente as CEDULA, nomdocente  as NOMBRE, apedocente as APELLIDO, telefdocente as TELEFONO, maildocente as EMAIL from docente where idusuario='".$_POST['codigo']."'", $acceso)){
                $fila[] = $acceso->devolver_recordset();
            }else{
                if($objPersona->buscar("select cedpersona as CEDULA, nompersona as NOMBRE, apepersona as APELLIDO, telefpersona as TELEFONO, emailpersona as EMAIL from personal_sector_comunidad where idusuario='".$_POST['codigo']."'", $acceso)){
                    $fila[] = $acceso->devolver_recordset();
                }
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case modUsuario:
            $objUsuario = new Usuario();
            if($objUsuario->buscar("select * from usuario where idusuario='".$_POST['codigo']."'", $acceso)){
                if($_POST['login'] == $_POST['loginOld']){
                    $resp = 1;
                    //$objUsuario->modificar("update usuario set perfilusuario='".$_POST['perfil']."'", $acceso);
                }else{
                    if($objUsuario->buscar("select * from usuario where login='".strtolower($_POST['login'])."'", $acceso)){
                        $resp = 2;
                    }else{
                        $resp = 1;
                        //$objUsuario->modificar("update usuario set perfilusuario='".$_POST['perfil']."', login='".$_POST['login']."'", $acceso);
                    }
                }
            }else{
                $resp = 0;
            }
            if($resp == 1){
                $objUsuario->modificar("update usuario set perfilusuario='".$_POST['perfil']."', login='".strtolower($_POST['login'])."' where idusuario='".$_POST['codigo']."'", $acceso);
            }
            echo $resp;
        break;
        case elimiUsu:
            $objUsuario = new Usuario();
            $objDocente = new Docente();
            $objPersona = new Personalsector();
            $tablas = array ("denuncia","estudiante","jefe_pnf","noticia","seguridad");
            $w = TRUE;
            for($i = 0;$i < count($tablas);$i++){
                if($objUsuario->buscar("select * from ".$tablas[$i]." where idusuario='".$_POST['codigo']."'", $acceso)){
                    $w = FALSE;
//                    $tab = $tablas[$i];
                    $i = count($tablas);
                }
            }
            if($w){
                if($objDocente->buscar("select * from docente where idusuario='".$_POST['codigo']."'", $acceso)){
                    $objDocente->modificar("update docente set idusuario='0' where idusuario='".$_POST['codigo']."'", $acceso);
                }else{
                    if($objPersona->buscar("select * from personal_sector_comunidad where idusuario='".$_POST['codigo']."'", $acceso)){
                        $objPersona->modificar("update personal_sector_comunidad set idusuario='0' where idusuario='".$_POST['codigo']."'", $acceso);
                    }
                }
                $objUsuario->modificar("delete from usuario where idusuario='".$_POST['codigo']."'", $acceso);
                echo 1;
            }else{
                echo 0;
            }
        break;
        case modificarClave:
            $objUsuario = new Usuario();
            if($objUsuario->buscar("select * from usuario where login='".$_SESSION['varId']."' and  clave='".$_POST['claveactual']."'", $acceso)){
                $objUsuario->modificar("update usuario set clave='".$_POST['clavenueva']."' where login='".$_SESSION['varId']."'", $acceso);
                echo 1;
            }else{
                echo 0;
            }
        break;
//        case buscarCodDia:
//            $objDia = new Diagnostico();
//            $objPnf = new Pnf();
//            $datos[1] = 0;
//            if($objPnf->buscar("select abrevpnf from pnf where idpnf='".$_POST['pnf']."'",$acceso)){
//               if($acceso->registros>0){
//                       $fila = $acceso->devolver_recordset();
//                       $datos[0] = $fila['abrevpnf'];
//               }else{
//                      $datos[0] = 0;
//               }
//            }
//            
//            if($objDia->buscar("select max(iddiagnostico) as maximo from diagnostico where idpnf='".$_POST['pnf']."'",$acceso)){
//               if($acceso->registros>0){
//                       $fila = $acceso->devolver_recordset();
//                       $datos[1] = $fila['maximo'] + 1;
//               }else{
//                       $datos[1] = 1;
//               }
//            }
//            $json=new Services_JSON();
//            $resp=$json->encode($datos);
//            echo $resp;
//        break;
//        case buscarCodAnt:
//            $objAnt = new Anteproyecto();
//            $objPnf = new Pnf();
//            $datos[1] = 0;
//            
//            if($objPnf->buscar("select abrevpnf from pnf where idpnf='".$_POST['pnf']."'", $acceso)){
//                if($acceso->registros>0){
//                       $fila = $acceso->devolver_recordset();
//                       $datos[0] = $fila['abrevpnf'];
//               }else{
//                      $datos[0] = 0;
//               }
//            }
//            
//            if($objAnt->buscar("select max(idantep) as maximo from anteproyecto where idpnf='".$_POST['pnf']."'",$acceso)){
//               if($acceso->registros>0){
//                       $fila = $acceso->devolver_recordset();
//                       $datos[1] = $fila['maximo'] + 1;
//               }else{
//                       $datos[1] = 1;
//               }
//            }
//            $json=new Services_JSON();
//            $resp=$json->encode($datos);
//            echo $resp;
//        break;
//        case buscarCodProy:
//            $objProyecto = new Proyecto();
//            $objPnf = new Pnf();
//            $datos[1] = 0;
//            
//            if($objPnf->buscar("select abrevpnf from pnf where idpnf='".$_POST['pnf']."'", $acceso)){
//                if($acceso->registros>0){
//                       $fila = $acceso->devolver_recordset();
//                       $datos[0] = $fila['abrevpnf'];
//               }else{
//                      $datos[0] = 0;
//               }
//            }
//            
//            if($objProyecto->buscar("select max(idproyecto) as maximo from proyecto where idpnf='".$_POST['pnf']."'",$acceso)){
//               if($acceso->registros>0){
//                       $fila = $acceso->devolver_recordset();
//                       $datos[1] = $fila['maximo'] + 1;
//               }else{
//                       $datos[1] = 1;
//               }
//            }
//            $json=new Services_JSON();
//            $resp=$json->encode($datos);
//            echo $resp;
//        break;
        case eliminarAntep:
            $objAntep = new Anteproyecto();
            $objDiag = new Diagnostico();
            $w = FALSE;
            if($objAntep->buscar("SELECT * FROM proyecto WHERE idantep='".$_POST['codigo']."'", $acceso)){
                if($acceso->registros > 0){
                    $w = FALSE;
                }else{
                    $w = TRUE;
                }
            }else{
                $w = TRUE;
            }
            
            if($w){
                $objAntep->modificar("DELETE FROM anteproyecto WHERE idantep='".$_POST['codigo']."'", $acceso);
                $objDiag->modificar("UPDATE diagnostico SET statusdiagnostico='INICIADO' WHERE iddiagnostico='".$_POST['codDiag']."'", $acceso);
                $fila = 1;
            }else{
                $fila = 0;
            }
            echo $fila;
        break;
        case eliminarProy:
            $objProyecto = new Proyecto();
            $objAntep = new Anteproyecto();
            $w = FALSE;
            if($objProyecto->buscar("SELECT * FROM evaluacion_proyecto WHERE idproyecto='".$_POST['codigo']."'", $acceso)){
                if($acceso->registros > 0){
                    $w = FALSE;
                }else{
                    $w = TRUE;
                }
            }else{
                $w = TRUE;
            }
            if($w){
                $objProyecto->modificar("DELETE FROM proyecto WHERE idproyecto='".$_POST['codigo']."'", $acceso);
                $objAntep->modificar("UPDATE anteproyecto SET statusante='INICIADO' WHERE iddiagnostico='".$_POST['codDiag']."'", $acceso);
                $fila = 1;
            }else{
                $fila = 0;
            }
            echo $fila;
        break;
        case buscarAntep:
            $objAnte = new Anteproyecto();
            $objDiag = new Diagnostico();
            $w = FALSE;
            if($objAnte->buscar("SELECT * FROM proyecto WHERE idantep='".$_POST['codigo']."'", $acceso)){
                if($acceso->registros > 0){
                    $w = TRUE;
                    $fila = -5;
                }else{
                    $w = FALSE;
                }
            }
            if(!$w){
                if($objAnte->buscar("SELECT * FROM anteproyecto WHERE idantep='".$_POST['codigo']."'", $acceso)){
                    if($acceso->registros > 0){
                        $fila[0] = $acceso->devolver_recordset();
                    }else{
                        $fila[0] = -1;
                    }
                }else{
                    $fila[0] = -1;
                }
                $sql = "select d.iddiagnostico, d.descripdiagnostico FROM problema as p, diagnostico as d LEFT JOIN anteproyecto as a  ON
                    d.iddiagnostico = a.iddiagnostico where d.idpnf='".$fila[0]['idpnf']."' and a.iddiagnostico IS NULL and p.iddiagnostico=d.iddiagnostico
                    ORDER BY d.descripdiagnostico ASC";
                if($objDiag->buscar($sql, $acceso)){
                    if($acceso->registros > 0){
                        $j = $i = 0;
                        do{
                            $fila2 = $acceso->devolver_recordset();
                            if($fila2['iddiagnostico'] != 0){
                                $fila[1][$j++] = $fila2;
                            }
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    }else{
                        $fila[1] = -1;
                    }
                }else{
                    $fila[1] = -1;
                }
                if($objDiag->buscar("SELECT * FROM diagnostico WHERE iddiagnostico='".$fila[0]['iddiagnostico']."'", $acceso)){
                    if($acceso->registros > 0){
                        $i = 0;
                        do{
                            $fila[2] = $acceso->devolver_recordset();
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    }else{
                        $fila[2] = -1;
                    }
                }else{
                    $fila[2] = -1;
                }
                
                if($objDiag->buscar("SELECT * FROM problema WHERE idproblema='".$fila[0]['idproblema']."'", $acceso)){
                    if($acceso->registros > 0){
                            $fila[3] = $acceso->devolver_recordset();
                            $i++;
                    }else{
                        $fila[3] = -1;
                    }
                }else{
                    $fila[3] = -1;
                }
                
                
/////////////////////////////////////
                //token de seguridad
                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                //dominio del directorio de personal y estudiantes
                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                // crea cliente soap para buscar persona
                $client = new nusoap_client($wsdl, true);
                
                $ldap = $client->getProxy();
                
                if($client->fault) {
                        die('Error grave');
                } else {
                        if($client->getError())
                                die($client->getError());
                }
               // servicio para la busqueda de personas en el directorio
//               $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
                
/////////////////////////////////////                
                
                
                if($objDiag->buscar("SELECT * FROM estudiante WHERE idgrupo='".$fila[0]['idgrupo']."'", $acceso)){
                    if($acceso->registros > 0){
                        $j = $i = 0;
                        do{
                            $fila = $acceso->devolver_recordset();
                            $data = $ldap->searchPersonOnDirectory($clientToken,$fila['cedestudiante']);;
                            $fila[4][$j++] = $data[0]['data'][0];
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    }else{
                        $fila[4] = -1;
                    }
                }else{
                    $fila[4] = -1;
                }
                $sql = "SELECT D.nomconsejocomunal, C.nomcomuni,S.descripsector,P.nompersona,P.apepersona FROM diagnostico as D, sector_comunidad as S, comunidad as C,
                        personal_sector_comunidad as P WHERE D.iddiagnostico='".$fila[0]['iddiagnostico']."' AND D.idsectorcomunidad=S.idsectorcomunidad AND S.idcomuni=C.idcomuni
                        AND S.idsectorcomunidad=P.idsectorcomunidad";
                if($objDiag->buscar($sql, $acceso)){
                    if($acceso->registros > 0){
                            $fila[5] = $acceso->devolver_recordset();
                            $i++;
                    }else{
                        $fila[5] = -1;
                    }
                }else{
                    $fila[5] = -1;
                }
                
                if($objDiag->buscar("SELECT * FROM docente WHERE idpnf='".$fila[0]['idpnf']."'", $acceso)){
                    if($acceso->registros > 0){
                        $j = $i = 0;
                        do{
                            $fila[6][$j++] = $acceso->devolver_recordset();
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    }else{
                        $fila[6] = -1;
                    }
                }else{
                    $fila[6] = -1;
                }
            }
            
            
//            print_r($fila);
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarAnteproy:
            $objAnt = new Anteproyecto();
            //HAY QUE BUSCAR TODOS LOS ANTEPROYECTOS LOS CUALES NO TENGAN ASOCIADO UN PROYECTO
//            $sql = "select * from anteproyecto WHERE idantep NOT IN (select idantep from proyecto) AND idpnf = '".$_POST['pnf']."'";
            $sql = "SELECT * FROM anteproyecto WHERE statusante='INICIADO' AND idpnf='".$_POST['pnf']."'";
//            print_r($sql);
            if($objAnt->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    $j = 0;
                    do{
                        $fila2 = $acceso->devolver_recordset();
                        if($fila2['idantep'] != 0){
                            $fila[$j++] = $fila2;
                        }
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[0] = -1;
                }
            }else{
                $fila[0] = -1;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarDatosAnt:
            $objAnt = new Anteproyecto();
            $objProblema = new Problema();
            $objEstudiante = new Estudiante();
            $objPersonalsector = new Personalsector();
            if($objAnt->buscar("select * from anteproyecto where idantep='".$_POST['codigo']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[0] = $acceso->devolver_recordset();
                }else{
                    $fila[0] = -1;
                }
            }else{
                $fila[0] = -1;
            }
            if($objProblema->buscar("select * from problema where iddiagnostico='".$fila[0]['iddiagnostico']."' and seleccionado='1'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[1][$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[1] = -2;
                }
            }else{
                $fila[1] = -2;
            }
            
///////////////////////////////////////////
            
            //token de seguridad
            $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

            //dominio del directorio de personal y estudiantes
            $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

            // crea cliente soap para buscar persona
            $client = new nusoap_client($wsdl, true);

            $ldap = $client->getProxy();

            if($client->fault) {
                    die('Error grave');
            } else {
                    if($client->getError())
                            die($client->getError());
            }
           // servicio para la busqueda de personas en el directorio
//           $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
//////////////////////////////////////////           
            if($objEstudiante->buscar("select * from estudiante where idgrupo='".$fila[0]['idgrupo']."' ORDER BY nomestudiante,apeestudiante", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila = $acceso->devolver_recordset();
                        $data = $ldap->searchPersonOnDirectory($clientToken,$fila['cedestudiante']);
                        $fila[2][$i] = $data[0]['data'][0];
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[2] = -3;
                }
            }else{
                $fila[2] = -3;
            }
            $sql = "SELECT 
                        A.nomconsejocomunal, 
                        C.descripsector, 
                        B.nomcomuni, 
                        B.idcomuni,
                        D.cedpersona, 
                        D.nompersona, 
                        D.apepersona
                      FROM 
                        diagnostico as A, 
                        comunidad as B, 
                        sector_comunidad as C, 
                        personal_sector_comunidad as D
                      WHERE 
                        A.idsectorcomunidad = C.idsectorcomunidad AND
                        C.idcomuni = B.idcomuni AND
                        C.idsectorcomunidad = D.idsectorcomunidad AND
                        A.iddiagnostico = '".$fila[0]['iddiagnostico']."'";
            if($objAnt->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $fila[3] = $acceso->devolver_recordset();
                }else{
                    $fila[3] = -4;
                }
            }else{
                $fila[3] = -4;
            }
//            if($objPersonalsector->buscar("select * from personal_sector_comunidad where idpersona='".$fila[0]['idpersona']."'", $acceso)){
//                if($acceso->registros > 0){
//                    $fila[4] = $acceso->devolver_recordset();
//                }else{
//                    $fila[4] = -5;
//                }
//            }else{
//                $fila[4] = -5;
//            }
            if($objEstudiante->buscar("select * from docente ORDER BY nomdocente,apedocente ASC", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[5][$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[5] = -6;
                }
            }else{
                $fila[5] = -6;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarProLet:
            $objProyecto = new Proyecto();
            if($objProyecto->buscar("SELECT * FROM proyecto WHERE idpnf='".$_POST['pnf']."' AND nomproyecto LIKE '".strtoupper($_POST['letras'])."%'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarDatosProy:
            $objProyecto = new Proyecto();
            $objEstu = new Estudiante();
            $objDoc = new Docente();
            if($objProyecto->buscar("SELECT* FROM proyecto WHERE idproyecto='".$_POST['codigo']."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[0] = $acceso->devolver_recordset();
                }else{
                    $fila[0] = 0;
                }
            }else{
                $fila[0] = 0;
            }
            if($fila[0] != 0){
////////////////////////////////////
                //token de seguridad
                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                //dominio del directorio de personal y estudiantes
                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                // crea cliente soap para buscar persona
                $client = new nusoap_client($wsdl, true);
                
                $ldap = $client->getProxy();
                
                if($client->fault) {
                        die('Error grave');
                } else {
                        if($client->getError())
                                die($client->getError());
                }
               // servicio para la busqueda de personas en el directorio
               
                
///////////////////////////////////                
                if($objEstu->buscar("SELECT * FROM estudiante WHERE idgrupo='".$fila[0]['idgrupo']."'", $acceso)){
                    if($acceso->registros > 0){
                        $i = 0;
                        do{
                            $fila = $acceso->devolver_recordset();
                            $data = $ldap->searchPersonOnDirectory($clientToken,$fila['cedestudiante']);
                            $fila[1][$i] = $data[0]['data'][0];
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros)); 
                    }else{
                        $fila[1] = 0;
                    }
                }else{
                    $fila[1] = 0;
                }
                if($objDoc->buscar("SELECT * FROM docente WHERE iddocente='".$fila[0]['doc_iddocente']."'", $acceso)){
                    if($acceso->registros > 0){
                        $fila[2] = $acceso->devolver_recordset();
                    }else{
                        $fila[2] = 0;
                    }
                }else{
                    $fila[2] = 0;
                }
                if ($objProyecto->buscar("SELECT * FROM diagnostico WHERE iddiagnostico='".$fila[0]['iddiagnostico']."'", $acceso)) {
                    if($acceso->registros > 0){
                        $fila[3] = $acceso->devolver_recordset();
                    }else{
                        $fila[3] = 0;
                    }
                }else{
                    $fila[3] = 0;
                }
            }
            
            
            
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case guardarPnf:
            $objPnf = new Pnf();
            if($objPnf->buscar("SELECT * FROM pnf WHERE descripcionpnf='".strtoupper($_POST['nombre'])."'", $acceso)){
                $resp = 2;//EXISTE UN PNF CON EL MISMO NOMBRE
            }else{
                if($objPnf->buscar("SELECT * FROM pnf WHERE abrevpnf='".strtoupper($_POST['abrev'])."'", $acceso)){
                    $resp = 3;//EXISTE UN PNF CON EL MISMO ABREVIADO
                }else{
                    $objPnf->setPropiedades(strtoupper($_POST['nombre']), cambiarFormatoFecha($_POST['inicio'], '2'), $_POST['abrev']);
                    if($objPnf->ingresar($acceso)){
                        $objSeguridad = new Seguridad();
                        $fecha = date('Y-m-d H:i:s');
                        $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE PNF CON ABREVIADO: '.$_POST['abrev'], $fecha);
                        $objSeguridad->ingresar($acceso);
                        $resp = 1;
                    }else{
                        $resp = 0;
                    }
                }
            }
            echo $resp;
        break;
        case buscarTodosPnf:
            $objPnf = new Pnf();
            if($objPnf->buscar("SELECT * FROM pnf ORDER BY descripcionpnf, abrevpnf ASC", $acceso)){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                    echo $resp;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        break;
        case buscarPerComi:
            $objDocente = new Docente();
            if($objDocente->buscar("SELECT * FROM docente WHERE nomdocente LIKE '".strtoupper($_POST['letras'])."%' OR apedocente LIKE '".strtoupper($_POST['letras'])."%' ORDER BY nomdocente,apedocente", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        ////////////////// INTEGRANTE COMUNIDAD
        case buscarIntegranteCom:
            $objPersona = new Personalsector();
            if($objPersona->buscar("select * from personal_sector_comunidad where cedpersona='".$_POST['cedula']."'", $acceso)){
                echo 1;
            }else{
                echo 0;
            }
        break;
        case guardarPersona:
            $objPersona = new Personalsector();
            if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE cedpersona='".$_POST['cedula']."'", $acceso)){
                echo 3;// LA CEDULA INGRESADA EXISTE
            }else{
                if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE emailpersona='".strtoupper($_POST['mail'])."'", $acceso)){
                    echo 2;// EL EMAIL INGRESADO EXISTE
                }else{
                    if($_POST['status'] == 2){
                        if($objPersona->buscar("SELECT idpersona FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' AND statuspersona='2'", $acceso)){
                            if($acceso->registros > 0){
                                $fila = $acceso->devolver_recordset();
                                $objPersona->modificar("UPDATE personal_sector_comunidad SET statuspersona='1' WHERE idpersona='".$fila['idpersona']."' AND idsectorcomunidad='".$_POST['sector']."'", $acceso);
                            }
                        }
                    }
                }
                if($objPersona->buscar("select max(idpersona) as maximo from personal_sector_comunidad",$acceso)){
                    if($acceso->registros>0){
                        $fila = $acceso->devolver_recordset();
                        $codigo = $fila['maximo'] + 1;
                    }else{
                        $codigo = 1;
                    }
                }
                $fila = $codigo;

                $objPersona->setPropiedades($fila,$_POST['sector'], '0', $_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['direccion'], $_POST['mail'], $_POST['status'], $_POST['sexo']);
                if($objPersona->ingresar($acceso)){
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE PERSONAL COMUNIDAD: '.$fila, $fecha);
                    $objSeguridad->ingresar($acceso);
                    
                    $sql="SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' AND statuspersona='2' ORDER BY nompersona,apepersona ASC";
                    if($objPersona->buscar($sql, $acceso)){
                        if($acceso->registros>0){
                            $fila = $acceso->devolver_recordset();
                            $json=new Services_JSON();
                            $resp=$json->encode($fila);
                            echo $resp;
                        }
                    }
                }else{
                    echo 0;
                }
            }
        break;
        case buscarTodosInCo:
            $objPersona = new Personalsector();
           if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' ORDER BY nompersona,apepersona ASC",$acceso)){
                if($acceso->registros>0){
                    $i=0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    $json=new Services_JSON();
                    $resp=$json->encode($fila);
                    echo $resp;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        break;
        case buscarInCo:
           $objPersona = new Personalsector();
           $objCom = new Comunidad();
           $objPar = new Parroquia();
           $objMun = new Municipio();
           $objPar = new Parroquia();
           $objSec = new Sectorcomunidad();
           if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE idpersona='".$_POST['codigo']."'", $acceso)){
               if($acceso->registros>0){
                   $fila[0] = $acceso->devolver_recordset();
                   $json=new Services_JSON();
                   $resp=$json->encode($fila);
                   echo $resp;
               }else{
                   echo 2;
               }
           }else{
               echo 1;
           }
        break;
        case modificarPersonaIn:
            $objPersona = new Personalsector();
           /*   
             *  0   ESTADO
             *  1   MUNICIPIO
             *  2   PARROQUIA
             *  3   COMUNIDAD
             *  4   SECTOR
             *  5   CEDULA
             *  6   NOMBRE
             *  7   APELLIDO
             *  8   SEXO
             *  9   TELEFONO
             *  10  DIRECCION  
             *  12  EMAIL
             *  17  TIPO 1 ACTIVO - -1 INACTIVO - 2 REPRESENTANTE
             */
            if($_POST['cedOld'] == $_POST['cedula']){
                $w = 1;//LA CEDULA NO FUE MODIFICADA
            }else{
                if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE cedpersona='".$_POST['cedula']."'", $acceso)){
                    $w = 2;//EXISTE UNA PERSONA CON LA MISMA CEDULA
                }else{
                    $w = 1;//LA CEDULA MODIFICADA NO EXISTE
                }
            }
            if($w == 1){
                if(strtoupper($_POST['mailOld'])  == strtoupper($_POST['mail'])){
                    $w = 1;//EL EMAIL NO FUE MODIFICADO
                }else{
                    if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE emailpersona='".strtoupper($_POST['mail'])."'", $acceso)){
                        $w = 3;//EXISTE UNA PERSONA CON EL EMAIL MODIFICADO
                    }else{
                        $w = 1;//EL EMAIL MODIFICADOP NO EXISTE
                    }
                } 
            }
            if($_POST['status'] == 2){
                if($objPersona->buscar("SELECT idpersona FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' AND statuspersona='2'", $acceso)){
                    if($acceso->registros > 0){
                        $fila = $acceso->devolver_recordset();
                        $objPersona->modificar("UPDATE personal_sector_comunidad SET statuspersona='1' WHERE idpersona='".$fila['idpersona']."' AND idsectorcomunidad='".$_POST['sector']."'", $acceso);
                    }
                }
            }
            
            if($w == 1){
                if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE idpersona='".$_POST['id']."'", $acceso)){
                    $objPersona->modificar("UPDATE personal_sector_comunidad SET idsectorcomunidad='".$_POST['sector']."',cedpersona='".$_POST['cedula']."',nompersona='".strtoupper($_POST['nombre'])."',apepersona='".strtoupper($_POST['apellido'])."', sexopersona='".$_POST['sexo']."',dirpersona='".htmlspecialchars(strtoupper($_POST['direccion']))."',telefpersona='".$_POST['telefono']."',emailpersona='".strtoupper($_POST['mail'])."',statuspersona='".$_POST['status']."' WHERE idpersona='".$_POST['id']."'", $acceso);
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'MODIFICACION DE PERSONAL SECTOR COMUNIDAD CON CODIGO: '.$_POST['id'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    $sql="SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' AND statuspersona='2' ORDER BY nompersona,apepersona ASC";
                    if($objPersona->buscar($sql, $acceso)){
                        if($acceso->registros>0){
                            $fila = $acceso->devolver_recordset();
                            $json=new Services_JSON();
                            $resp=$json->encode($fila);
                            echo $resp;
                        }
                    }
//                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo $w;
            }
        break;
        case eliminarPersonaIn:
            $objPersona = new Personalsector();
            $w=false;
            if($objPersona->buscar("select count(*) as cantidad from diagnostico where idpersona='".$_POST['id']."'", $acceso)){
                $fila=$acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w=1;
                }
            }
            if($objPersona->buscar("select count(*) as cantidad from evaluacion_proyecto where idpersona='".$_POST['id']."'", $acceso)){
                $fila=$acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w=1;
                }
            }
            if($objPersona->buscar("select count(*) as cantidad from anteproyecto where idpersona='".$_POST['id']."'", $acceso)){
                $fila=$acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w=1;
                }
            }
            if($objPersona->buscar("select count(*) as cantidad from comision_tecnica where idpersona='".$_POST['id']."'", $acceso)){
                $fila=$acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w=1;
                }
            }
            if($objPersona->buscar("select count(*) as cantidad from personal_sector_comunidad where statuspersona='2' AND idpersona='".$_POST['id']."'", $acceso)){
                $fila=$acceso->devolver_recordset();
                if($fila['cantidad']>0){
                    $w=2;
                }
            }
            if($w != 1 && $w != 2){
                $objPersona->modificar("delete from personal_sector_comunidad where idpersona='".$_POST['id']."'", $acceso);
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'ELIMINACION DE PERSONA COMUNIDAD CON CODIGO: '.$_POST['id'], $fecha);
                $objSeguridad->ingresar($acceso);
                $w = 3;
            }
            echo $w;
        break;
        ////////////////// FIN INTEGRANTE COMUNIDAD
        case buscarIntComi:
            $objPersona = new Personalsector();
            if($objPersona->buscar("SELECT * FROM personal_sector_comunidad WHERE idsectorcomunidad='".$_POST['sector']."' AND (nompersona LIKE '".strtoupper($_POST['letras'])."%' OR apepersona LIKE '".strtoupper($_POST['letras'])."%') ORDER BY nompersona,apepersona", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case guardarEva:
            $objEva = new Evaluacion();
            $objComision = new Comision();
            $objProyecto = new Proyecto();
            $periodo = $_POST['periodo'];
            $trayecto = $_POST['trayecto'];
            $comi = $_POST['comision'];
            $nota = $_POST['nota'];
            $observacion = $_POST['observacion'];
            $codProyecto = $_POST['proyecto'];
            if($objEva->buscar("SELECT MAX(idevaluacion) AS maximo FROM evaluacion_proyecto",$acceso)){
                if($acceso->registros>0){
                    $row = $acceso->devolver_recordset();
                    $codigo = $row['maximo'] + 1;
                }else{
                    $codigo = 1;
                }
                $fila[0][0]=$codigo; //CODIGO DE LA EVALUACION
            }
            
            $comision = split(',', $comi);
            if($objComision->buscar("SELECT MAX(codigocomision) AS maximo FROM comision_tecnica",$acceso)){
                if($acceso->registros>0){
                    $row = $acceso->devolver_recordset();
                    $codigo = $row['maximo'] + 1;
                }else{
                    $codigo = 1;
                }
                $fila[1][0]=$codigo;//CODIGO DE LA COMISION PARA EVALUACION
            }
            $fecha = date('Y-m-d');
            for($i = 0;$i < count($comision);$i++){
                $persona = split('-', $comision[$i]);
                if($persona[3] == 'D' || $persona[3] == 'T'){
                    $objComision->setPropiedades('0', $persona[0], $fecha, '', $persona[3], $fila[1][0]);
                }else if($persona[3] == 'I'){
                    $objComision->setPropiedades($persona[0],'0', $fecha, '', $persona[3], $fila[1][0]);
                }
                $objComision->ingresar($acceso);
            }
            if($objEva->buscar("SELECT * FROM proyecto WHERE idproyecto='".$codProyecto."'", $acceso)){
                if($acceso->registros > 0){
                    $fila[2] = $acceso->devolver_recordset();
                }else{
                    $fila[2] = 0;
                }
            }else{
                $fila[2] = 0;
            }
            
            $objEva->setPropiedades($fila[0][0],$fila[1][0], $codProyecto, $fila[2]['idpersona'], $fila[2]['iddocente'], $fila[2]['idgrupo'], $fila[2]['doc_iddocente'], $fila[2]['idpersona'], $nota, $observacion, $trayecto);
            if($objEva->ingresar($acceso)){
                $objProyecto->modificar("UPDATE proyecto SET statusproy='EVALUADO' WHERE idproyecto='".$codProyecto."'", $acceso);
                $objSeguridad = new Seguridad();
                $fecha = date('Y-m-d H:i:s');
                $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE EVALUACION NRO: '.$fila[0][0], $fecha);
                $objSeguridad->ingresar($acceso);
                $resp = 1;
            }else{
                $resp = 2;
            }
            echo $resp;
        break;
        case buscaTEva:
            $objEva = new Evaluacion();
            $sql = "SELECT P.nomproyecto,P.idproyecto,E.notadescriptiva,E.idevaluacion FROM evaluacion_proyecto as E INNER JOIN proyecto as P ON 
                    E.idproyecto = P.idproyecto AND P.idpnf = '".$_POST['pnf']."'";
            if($objEva->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarRepor:
            $objDiag = new Diagnostico();
            $tipo = $_POST['tipo'];
            $pnf = $_POST['pnf'];
            $fechaI = cambiarFormatoFecha($_POST['fechai'],2);
            $fechaF = cambiarFormatoFecha($_POST['fechaf'],2);
            $sector = $_POST['sector'];
            if($tipo == 'diagnostico'){
                $fecha = 'fechadiagnostico';
                $seleccion = 'iddiagnostico, descripdiagnostico';
                $status = 'statusdiagnostico';
                $ordenar = 'descripdiagnostico';
            }else if($tipo == 'anteproyecto'){
                $fecha = 'fechaante';
                $seleccion = 'idantep,nomantep,iddiagnostico';
                $status = 'statusante';
                $ordenar = 'nomantep';
            }else{
                $fecha = 'fechaproy';
                $seleccion = 'idproyecto,nomproyecto,iddiagnostico';
                $status = 'statusproy';
                $ordenar = 'nomproyecto';
            }
            
            $sql = "SELECT ".$seleccion." FROM ".$tipo." WHERE idpnf='".$pnf."' and ".$status."='INICIADO' and ".$fecha." BETWEEN '".$fechaI."' AND '".$fechaF."' ORDER BY ".$ordenar." ASC";
            
            if($objDiag->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = -1;
                }
            }else{
                $fila = -1;
            }
            if($fila != -1){
                $sql = "SELECT * FROM diagnostico WHERE idsectorcomunidad='".$sector."'";
                if($objDiag->buscar($sql, $acceso)){
                    if($acceso->registros > 0){
                        $i = 0;
                        do{
                            $fila2[$i] = $acceso->devolver_recordset();
                            $i++;
                        }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    }else{
                        $fila2 = -1;
                    }
                }else{
                    $fila2 = -1;
                } 
                $k = 0;
                for($i=0;$i<count($fila);$i++){
                    for($j=0;$j<count($fila2);$j++){
                        if($fila[$i]['iddiagnostico'] == $fila2[$j]['iddiagnostico']){     
                            $fila3[$k++] = $fila[$i];
                        }
                    }
                }
            }
            if($k == 0){
                echo $k;
            }else{
                $json=new Services_JSON();
                $resp=$json->encode($fila3);
                echo $resp;
            }
            
        break;
        case buscarDetalleList:
            $objDiag = new Diagnostico();
            $objPersona = new Personalsector();
            $objDocente = new Docente();
            $objSector = new Sectorcomunidad();
            $tipo = $_POST['tipo'];
            $codigo= $_POST['codigo'];
            $opcion = $_POST['opcion'];//REPORTE || SEGUIMIENTO
            if($tipo == 'diagnostico'){
                $tabla = $tipo;
                $condicion = "iddiagnostico='".$codigo."'";
                $seleccion = "iddiagnostico,idpersona,iddocente,doc_iddocente,idsectorcomunidad,idgrupo,idperiodo,nomconsejocomunal,fechadiagnostico AS fecha,
                              observaciondiagnostico AS observacion,trayectodiagnostico AS trayecto, trimestrediagnostico AS trimestre,
                              descripdiagnostico AS titulo, coddiag AS codigo,idpnf,statusdiagnostico AS estado,observaciondiagnostico AS observacion";
            }else if($tipo == 'anteproyecto'){
                $tabla = $tipo.' as A,diagnostico as D';
                $condicion = "idantep='".$codigo."' AND A.iddiagnostico=D.iddiagnostico";
                $seleccion = "A.idperiodo,A.idproblema,A.idgrupo,A.idpersona,A.iddocente,A.doc_iddocente,A.nomantep AS titulo,
                              A.trayectoante AS trayecto,A.trimestreante AS trimestre,A.fechaante AS fecha,A.observante AS observacion,
                              A.codantep AS codigo,A.idpnf,A.statusante AS estado,A.observante AS observacion,D.idsectorcomunidad,
                              D.nomconsejocomunal,D.iddiagnostico";
            }else{
                $tabla = $tipo.' as P,diagnostico as D';
                $condicion = "idproyecto='".$codigo."' AND P.iddiagnostico=D.iddiagnostico";
                $seleccion = "P.idgrupo,P.iddocente,P.doc_iddocente,P.idpersona,P.idproblema,P.idperiodo,P.codproy AS codigo,P.nomproyecto AS titulo,
                              P.trimestreproy AS trimestre,P.trayectoproy AS trayecto,P.fechaproy AS fecha,P.observproy AS observacion,P.idpnf,
                              P.statusproy AS estado,P.observproy,D.idsectorcomunidad,D.nomconsejocomunal,D.iddiagnostico";
            }
            
            $sql = "SELECT ".$seleccion." FROM ".$tabla." WHERE ".$condicion;
            if($objDiag->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[0] = $acceso->devolver_recordset();
                }else{
                    $fila[0] = 0;
                }
            }else{
                $fila[0] = 0;
            }
            
            $sql = "SELECT * FROM personal_sector_comunidad WHERE idpersona='".$fila[0]['idpersona']."'";
            if($objPersona->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[1] = $acceso->devolver_recordset();
                }else{
                    $fila[1] = 0;
                }
            }else{
                $fila[1] = 0;
            }
            
            $sql = "SELECT * FROM docente WHERE iddocente='".$fila[0]['iddocente']."'";
            if($objDocente->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[2] = $acceso->devolver_recordset();
                }else{
                    $fila[2] = 0;
                }
            }else{
                $fila[2] = 0;
            }
            
            $sql = "SELECT * FROM docente WHERE iddocente='".$fila[0]['doc_iddocente']."'";
            if($objDocente->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[3] = $acceso->devolver_recordset();
                }else{
                    $fila[3] = 0;
                }
            }else{
                $fila[3] = 0;
            }
            $sql = "SELECT * FROM sector_comunidad WHERE idsectorcomunidad='".$fila[0]['idsectorcomunidad']."'";
            if($objSector->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[4] = $acceso->devolver_recordset();
                }else{
                    $fila[4] = 0;
                }
            }else{
                $fila[4] = 0;
            }
            
            $objEstudiante = new Estudiante();
            
////////////////////////////////
            
            //token de seguridad
            $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

            //dominio del directorio de personal y estudiantes
            $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

            // crea cliente soap para buscar persona
            $client = new nusoap_client($wsdl, true);

            $ldap = $client->getProxy();

            if($client->fault) {
                    die('Error grave');
            } else {
                    if($client->getError())
                            die($client->getError());
            }
           // servicio para la busqueda de personas en el directorio
//           $data = 
////////////////////////////////            
           $sql = "SELECT * FROM estudiante WHERE idgrupo='".$fila[0]['idgrupo']."'";
            if($objEstudiante->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila = $acceso->devolver_recordset();
                        $data = $ldap->searchPersonOnDirectory($clientToken,$fila['cedestudiante']);
                        $fila[5][$i] = $data[0]['data'][0];
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila[5] = 0;
                }
            }else{
                $fila[5] = 0;
            }
            
            $objPeriodo = new Periodo();
            $sql = "SELECT * FROM periodo_academico WHERE idperiodo='".$fila[0]['idperiodo']."'";
            if($objPeriodo->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[6] = $acceso->devolver_recordset();
                }else{
                    $fila[6] = 0;
                }
            }else{
                $fila[6] = 0;
            }
            
            $objPnf = new Pnf();
            $sql = "SELECT * FROM pnf WHERE idpnf='".$fila[0]['idpnf']."'";
            if($objPnf->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[7] = $acceso->devolver_recordset();
                }else{
                    $fila[7] = 0;
                }
            }else{
                $fila[7] = 0;
            }
            
            $objSector = new Sectorcomunidad();
            $sql = "SELECT * FROM comunidad WHERE idcomuni='".$fila[4]['idcomuni']."'";
            if($objSector->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[8] = $acceso->devolver_recordset();
                }else{
                    $fila[8] = 0;
                }
            }else{
                $fila[8] = 0;
            }
            
            $objParroquia = new Parroquia();
            $sql = "SELECT * FROM parroquia WHERE idparroquia='".$fila[8]['idparroquia']."'";
            if($objParroquia->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[9] = $acceso->devolver_recordset();
                }else{
                    $fila[9] = 0;
                }
            }else{
                $fila[9] = 0;
            }
            
            $objMunicipio = new Municipio();
            $sql = "SELECT * FROM municipio WHERE idmunicipio='".$fila[9]['idmunicipio']."'";
            if($objMunicipio->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[10] = $acceso->devolver_recordset();
                }else{
                    $fila[10] = 0;
                }
            }else{
                $fila[10] = 0;
            }
            $objEstado = new Estado();
            $sql = "SELECT * FROM estado WHERE idestado='".$fila[10]['idestado']."'";
            if($objEstado->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[11] = $acceso->devolver_recordset();
                }else{
                    $fila[11] = 0;
                }
            }else{
                $fila[11] = 0;
            }
            
            $objGrupo = new Grupo();
            $sql = "SELECT * FROM grupo WHERE idgrupo='".$fila[0]['idgrupo']."'";
            if($objGrupo->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[12] = $acceso->devolver_recordset();
                }else{
                    $fila[12] = 0;
                }
            }else{
                $fila[12] = 0;
            }
            
            $objProblema = new Problema();
            $sql = "SELECT * FROM problema WHERE iddiagnostico='".$fila[0]['iddiagnostico']."' AND seleccionado='1'";
            if($objGrupo->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila[15] = $acceso->devolver_recordset();
                }else{
                    $fila[15] = 0;
                }
            }else{
                $fila[15] = 0;
            }
            
            if($opcion == 'reporte'){
                $objDenuncia = new Denuncia();
                $sql = "SELECT * FROM denuncia WHERE fechadenuncia IN (SELECT MAX (fechadenuncia) FROM denuncia WHERE codtipo='".$fila[0]['codigo']."')";                
                if($objDenuncia->buscar($sql, $acceso)){
                    if($acceso->registros > 0){
                        $fila[13] = $acceso->devolver_recordset();
                    }else{
                        $fila[13] = 0;
                    }
                }else{
                    $fila[13] = 0;
                }
                if($objDenuncia->buscar("SELECT ceddocente AS cedula,nomdocente AS nombre,apedocente AS apellido,
                    telefdocente AS telefono, maildocente AS email FROM docente WHERE idusuario='".$fila[13]['idusuario']."'", $acceso)){
                    if($acceso->registros > 0){
                        $h = false;
                        $fila[14] = $acceso->devolver_recordset();
                    }else{
                        $h = true;
                    }
                }else{
                    $h = true;
                }
                if($h){
                    if($objDenuncia->buscar("SELECT cedpersona AS cedula,nompersona AS nombre,apepersona AS apellido, 
                        telefpersona AS telefono,emailpersona AS email FROM personal_sector_comunidad WHERE idusuario='".$fila[13]['idusuario']."'", $acceso)){
                        if($acceso->registros > 0){
                            $h = false;
                            $fila[14] = $acceso->devolver_recordset();
                        }else{
                            $h = true;
                        }
                    }else{
                        $h = true;
                    }
                }
            }
            
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        
        case buscarConsejo:
            $objConsejo = new Consejo();
            if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE idsectorcomunidad='".$_POST['sector']."'", $acceso)){
                if($acceso->registros > 0){
                        $fila = $acceso->devolver_recordset();
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case guardarConsejo:
            $objConsejo = new Consejo();
            
            if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE rifconsejo='".strtoupper($_POST['rif'])."'", $acceso)){
                $fila = "El R.I.F. ingresado se encuentra registrado, verifique";
            }else{
                if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE sicomconsejo='".$_POST['sicom']."'", $acceso)){
                    $fila = "El c&oacute;digo SICOM ingresado se encuentra registrado, verifique";
                }else{
                    if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE nomconsejo='".strtoupper($_POST['nombre'])."'", $acceso)){
                        $fila = "El nombre ingresado se encuentra registrado, verifique";
                    }else{
                        if($objConsejo->buscar("select max(idconsejo) as maximo from consejo_comunal",$acceso)){
                            if($acceso->registros>0){
                                $row = $acceso->devolver_recordset();
                                $codigo = $row['maximo'] + 1;
                            }else{
                                $codigo = 1;
                            }
                        }
                        if($_POST['fecha'] != ''){
                            $fecha = cambiarFormatoFecha($_POST['fecha'],0);
                        }else{
                            $fecha = '1900-01-01';
                        }
                        $cod[0] = $codigo;
//                        $objConsejo->setPropiedades($id, $idsector, $rif, $sicom, $fechaeleccion, $nombre)
                        $objConsejo->setPropiedades($cod[0], $_POST['sector'], $_POST['rif'], $_POST['sicom'], $fecha, $_POST['nombre']);
                        if($objConsejo->ingresar($acceso)){
                            $objSeguridad = new Seguridad();
                            $fecha = date('Y-m-d H:i:s');
                            $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: '.$_POST['rif'], $_POST['fecha']);
                            $objSeguridad->ingresar($acceso);
                            $fila = 1;
                        }
                    }
                }
            }
            echo $fila;
        break;
        case modificarConsejo:
            $objConsejo = new Consejo();
            if($_POST['rifold'] != $_POST['rif']){
                if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE rifconsejo='".strtoupper($_POST['rif'])."'", $acceso)){
                    echo "2";
                    break;
                }
            }
            if($_POST['sicomold'] != $_POST['sicom']){
                if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE sicomconsejo='".$_POST['sicom']."'", $acceso)){
                    echo "3";
                    break;
                }
            }
            if($_POST['nombreold'] != $_POST['nombre']){
                if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE nomconsejo='".strtoupper($_POST['nombre'])."'", $acceso)){
                    echo "4";
                    break;
                }
            }
            
            if($_POST['sectorold'] != $_POST['sector']){
                if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE idsectorcomunidad='".$_POST['sector']."'", $acceso)){
                    echo "5";
                    break;
                }
            }
            
            $objConsejo->modificar("UPDATE consejo_comunal SET idsectorcomunidad='".$_POST['sector']."',rifconsejo='".strtoupper($_POST['rif'])."',
                                    sicomconsejo='".$_POST['sicom']."',feculteleccion='".cambiarFormatoFecha($_POST['fecha'],0)."',
                                    nomconsejo='".htmlspecialchars(strtoupper($_POST['nombre']))."' WHERE idconsejo='".$_POST['codigo']."'", $acceso);
            $objSeguridad = new Seguridad();
            $fecha = date('Y-m-d H:i:s');
            $objSeguridad->setPropiedades($_SESSION['codUsu'], 'CONSEJO COMUNAL MODIIFCADO CON CODIGO: '.$_POST['codigo'], $fecha);
            $objSeguridad->ingresar($acceso);
            echo '1';
            
        break;
        case buscarConsejoSect:
            $objConsejo = new Consejo();
            if($objConsejo->buscar("SELECT * FROM consejo_comunal WHERE idsectorcomunidad='".$_POST['sector']."'", $acceso)){
               if($acceso->registros > 0){
                        $fila = $acceso->devolver_recordset();
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case guardarReportar:
            $objDenuncia = new Denuncia();
            if($objDenuncia->buscar("SELECT MAX(iddenuncia) AS maximo FROM denuncia",$acceso)){
                if($acceso->registros>0){
                    $row = $acceso->devolver_recordset();
                    $codigo = $row['maximo'] + 1;
                }else{
                    $codigo = 1;
                }
                $fecha = date('Y-m-d H:i:s');
                $hora = date('H:i:s');
                $objDenuncia->setPropiedades($codigo, $_SESSION['codUsu'], $_POST['descripcion'], $_POST['tipo'], $_POST['codtipo'], $fecha, $hora);
                if($objDenuncia->ingresar($acceso)){
                    $tabla = $_POST['tipo'];
                    if($tabla == 'diagnostico'){
                        $status = 'statusdiagnostico';
                        $codigo = 'iddiagnostico';
                    }else if($tabla == 'anteproyecto'){
                        $status = 'statusante';
                        $codigo = 'idantep';
                    }else{
                        $status = 'statusproy';
                        $codigo = 'idproyecto';
                    }
                    $sql = "UPDATE ".$tabla." SET ".$status."='REPORTADO' WHERE ".$codigo."='".$_POST['codigo']."'";
                    $objDenuncia->modificar($sql, $acceso);
                    $objSeguridad = new Seguridad();
                    $fecha = date('Y-m-d H:i:s');
                    $objSeguridad->setPropiedades($_SESSION['codUsu'], 'REPORTE DEL '.strtoupper($tabla).': '.$_POST['codigo'], $fecha);
                    $objSeguridad->ingresar($acceso);
                    echo 1;
                }else{
                    echo 0;
                }
            }
        break;
        case buscarTemas:
            $objDiag = new Diagnostico();
            $pnf = $_POST['pnf'];
            $fila2[1][0] = -1;
            $fila2[2][0] = -1;
            $fila2[3][0] = -1;
            
            $sql = "SELECT iddiagnostico AS codigo,descripdiagnostico AS titulo FROM diagnostico WHERE idpnf='".$pnf."' AND statusdiagnostico='REPORTADO'";
            $objDiag->buscar($sql, $acceso);
            if($acceso->registros>0){
                $i = 0;
                do{
                    $fila[1][$i] = $acceso->devolver_recordset();
                    $i++;
                }while(($acceso->siguiente())&&($i!=$acceso->registros));
            }else{
                $fila[1][0] = -1;
            }

            $sql = "SELECT idantep AS codigo,nomantep AS titulo FROM anteproyecto WHERE idpnf='".$pnf."' AND statusante='REPORTADO'";
            $objDiag->buscar($sql, $acceso);
            if($acceso->registros>0){
                $i = 0;
                do{
                    $fila[2][$i] = $acceso->devolver_recordset();
                    $i++;
                }while(($acceso->siguiente())&&($i!=$acceso->registros));
            }else{
                $fila[2][0] = -1;
            }

            $sql = "SELECT idproyecto AS codigo,nomproyecto AS titulo FROM proyecto WHERE idpnf='".$pnf."' AND statusproy='REPORTADO'";
            $objDiag->buscar($sql, $acceso);
            if($acceso->registros>0){
                $i = 0;
                do{
                    $fila[3][$i] = $acceso->devolver_recordset();
                    $i++;
                }while(($acceso->siguiente())&&($i!=$acceso->registros));
            }else{
                $fila[3][0] = -1;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case liberarReporte:
            $objDiag = new Diagnostico();
            $codigo = $_POST['codigo'];
//            $codtipo = $_POST['codtipo'];
            $tipo = $_POST['tipo'];
            
            if($tipo == 'diagnostico'){
                $campo1 = 'statusdiagnostico';
                $campo2 = 'iddiagnostico';
            }else if($tipo == 'anteproyecto'){
                $campo1 = 'statusante';
                $campo2 = 'idantep';
            }else{
                $campo1 = 'statusproy';
                $campo2 = 'idproyecto';
            }
            $sql = "UPDATE ".$tipo." SET ".$campo1."='INICIADO' WHERE ".$campo2."='".$codigo."'";
            if(!$objDiag->modificar($sql, $acceso)){
                echo 1;
            }else{
                echo 0;
            }
        break;
        case buscarProbleLet:
            $objProblema = new Problema();
            if($objProblema->buscar("SELECT * FROM problema WHERE seleccionado='0' AND descripcionproblema LIKE '".strtoupper($_POST['letras'])."%'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarTodosProble:
            $objProblema = new Problema();
             if($objProblema->buscar("SELECT * FROM problema WHERE seleccionado='0'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarDatosProble:
            $objProblema = new Problema();
            $sql = "SELECT P.idsectorcomunidad, P.descripcionproblema, P.posiblesolucion, S.idsectorcomunidad, S.idcomuni, S.descripsector, 
                    C.idcomuni, C.idparroquia, C.nomcomuni, A.idparroquia, A.idmunicipio, A.descripparroquia, M.idmunicipio, M.idestado, 
                    M.descripmunicipio, T.idestado, T.descripestado, E.idpersona, E.idsectorcomunidad, E.idusuario, E.cedpersona, 
                    E.nompersona, E.apepersona, E.telefpersona, E.dirpersona, E.emailpersona, E.statuspersona, E.sexopersona, P.idproblema, 
                    P.iddiagnostico, P.seleccionado, S.dirsector, C.dircomuni, B.idconsejo, B.rifconsejo, B.sicomconsejo, B.feculteleccion, 
                    B.nomconsejo, B.idsectorcomunidad
                  FROM 
                    problema AS P, sector_comunidad AS S, comunidad AS C, parroquia AS A, municipio AS M, estado AS T,
                    personal_sector_comunidad AS E, consejo_comunal AS B
                  WHERE 
                    P.idsectorcomunidad = S.idsectorcomunidad AND
                    P.idsectorcomunidad = E.idsectorcomunidad AND
                    P.idsectorcomunidad = B.idsectorcomunidad AND
                    S.idcomuni = C.idcomuni AND
                    C.idparroquia = A.idparroquia AND
                    A.idmunicipio = M.idmunicipio AND
                    M.idestado = T.idestado AND
                    P.idproblema = '".$_POST['codigo']."' AND 
                    P.seleccionado = '0'";
            if($objProblema->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                        $fila = $acceso->devolver_recordset();
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case bdiaggru:
            $objDiag = new Diagnostico();
             if($objDiag->buscar("SELECT * FROM diagnostico WHERE idpnf='".$_POST['pnf']."' AND statusdiagnostico='INICIADO'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                    
//                    for($i = 0;$i < count($fila[0]);$i++){
//                        if($objDiag->buscar("SELECT * FROM estudiante WHERE idgrupo='".$fila[0][$i]['idgrupo']."'", $acceso)){
//                            if($acceso->registros > 0){
//                                $j = 0;
//                                do{
//                                    $fila[1][$i][$j] = $acceso->devolver_recordset();
//                                    $j++;
//                                }while(($acceso->siguiente())&&($j!=$acceso->registros));
//                            }
//                        }
//                    }
                    
                    
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
//            print_r($fila);
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case bgrupdiag:
            $objEstu = new Estudiante();
/////////////////////////////////
            //token de seguridad
            $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

            //dominio del directorio de personal y estudiantes
            $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

            // crea cliente soap para buscar persona
            $client = new nusoap_client($wsdl, true);

            $ldap = $client->getProxy();

            if($client->fault) {
                    die('Error grave');
            } else {
                    if($client->getError())
                            die($client->getError());
            }
           // servicio para la busqueda de personas en el directorio
           
/////////////////////////////////            
            if($objEstu->buscar("SELECT * FROM estudiante WHERE idgrupo='".$_POST['idgrupo']."'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila = $acceso->devolver_recordset();
                        $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
                        $fila[$i] = $data[0]['data'][0];
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case modGrupo:
            $objEstudiante = new Estudiante();
            $codGrupo = $_POST['codgrupo'];
            $grupo = explode('-', $_POST['grupo']);
            
            $objEstudiante->modificar("UPDATE estudiante SET idgrupo='0' where idgrupo='".$codGrupo."'", $acceso);
            for($i=0;$i<count($grupo);$i++){//LUEGO SE MODIFICA EL ESTUDIANTE INGRESANDOLE EL GRUPO
                $objEstudiante->modificar("UPDATE estudiante set idgrupo='".$codGrupo."' where idestudiante='".$grupo[$i]."'", $acceso);
            }
            echo 1;
        bfreak;
        case datosReporte:
            $objDiag = new Diagnostico();
            $pnf = $_POST['pnf'];
            $per = $_POST['per'];
            $tra = $_POST['tra'];
            $tri = $_POST['tri'];
            $fechai = $_POST['fechi'];
            $fechaf = $_POST['fechaf'];
            $tabla = $_POST['tipo'];
            
            
            if($tabla == 'diagnostico'){
                $campo1 = 'iddiagnostico';
                $campo2 = 'descripdiagnostico';
                $trayecto = 'trayectodiagnostico';
                $trimestre = 'trimestrediagnostico';
                $fecha = 'fechadiagnostico';
            }else if($tabla == 'anteproyecto'){
                $campo1 = 'idantep';
                $campo2 = 'nomantep';
                $trayecto = 'trayectoante';
                $trimestre = 'trimestreante';
                $fecha = 'fechaante';
            }else{
                $campo1 = 'idproyecto';
                $campo2 = 'nomproyecto';
                $trayecto = 'trayectoproy';
                $trimestre = 'trimestreproy';
                $fecha = 'fechaproy';
            }
            
            $condicion1 = " idpnf='".$pnf."'";
            if($per != -1){
                $condicion2 = " AND idperiodo='".$per."'";
            }else{
                $condicion2 = '';
            }
            if($tra != -1){
                $condicion3 = " AND ".$trayecto."='".$tra."'";
            }else{
                $condicion3 = '';
            }
            if($tri != -1){
                $condicion4 = " AND ".$trimestre."='".$tri."'";
            }else{
                $condicion4 = '';
            }
            if($fechai != '' && $fechaf != ''){
                $condicion5 = " AND ".$fecha." BETWEEN '".cambiarFormatoFecha($fechai,0)."' AND '".cambiarFormatoFecha($fechaf,0)."'";
            }else{
                $condicion5 = '';
            }
            $sql = "SELECT ".$campo1." AS codigo,".$campo2." AS titulo FROM ".$tabla." WHERE ".$condicion1.$condicion2.$condicion3.$condicion4.$condicion5." ORDER BY ".$campo2;
            if($objDiag->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }
            }else{
                $fila = -1;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case datosReporteEva:
            $objEva = new Evaluacion();
            $pnf = $_POST['pnf'];
            $sql = "SELECT E.idevaluacion AS codigo, P.nomproyecto AS titulo FROM evaluacion_proyecto AS E, proyecto AS P
                    WHERE P.idproyecto = E.idproyecto AND P.idpnf = '".$pnf."'";
            if($objEva->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = -1;
                }
            }else{
                $fila = -1;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarDetalleListEva:
            $objEva = new Evaluacion();
            $objProy = new Proyecto();
            $codigo = $_POST['codigo'];
            
            $sql = "SELECT * FROM evaluacion_proyecto WHERE idevaluacion='".$codigo."'";
            if($objEva->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $fila[0] = $acceso->devolver_recordset();//DATOS DE LA EVALUACION
                    
//////////////////////////////////////////////
                //token de seguridad
                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                //dominio del directorio de personal y estudiantes
                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                // crea cliente soap para buscar persona
                $client = new nusoap_client($wsdl, true);
                
                $ldap = $client->getProxy();
                
                if($client->fault) {
                        die('Error grave');
                } else {
                        if($client->getError())
                                die($client->getError());
                }
               // servicio para la busqueda de personas en el directorio
               
//////////////////////////////////////////////                    
                    $sql = "SELECT * FROM estudiante WHERE idgrupo='".$fila[0]['idgrupo']."'";
                    if($objEva->buscar($sql, $acceso)){
                         if($acceso->registros > 0){
                            $i = 0;
                            do{
                                $fila = $acceso->devolver_recordset(); //ESTUDIANTES DEL GRUPO
                                $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
                                $fila[1][$i] = $data[0]['data'][0];
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }
                    
                    $sql = "SELECT * FROM comision_tecnica WHERE codigocomision='".$fila[0]['idcomision']."'";
                    if($objEva->buscar($sql, $acceso)){
                         if($acceso->registros > 0){
                            $i = 0;
                            do{
                                $fila[2][$i] = $acceso->devolver_recordset(); //CODIGOS DE LOS MIEMBROS DE LA COMISION
                                $i++;
                            }while(($acceso->siguiente())&&($i!=$acceso->registros));
                        }
                    }
                    $j = 0;
//                    for ($i = 0;$i < count($fila[2]);$i++){
//                        if($fila[2][$i]['identificador'] == 'D'){
//                            $sql = "SELECT ceddocente AS cedula, nomdocente AS nombre, apedocente AS apellido FROM docente WHERE iddocente='".$fila[2][$i]['iddocente']."'";
//                        }else{
//                            $sql = "SELECT cedpersona AS cedula, nompersona AS nombre, apepersona AS apellido FROM personal_sector_comunidad WHERE idpersona='".$fila[2][$i]['idpersona']."'";
//                        }
//                        if($objEva->buscar($sql, $acceso)){
//                            if($acceso->registros > 0){ 
//                                $fila[3][$j++] = $acceso->devolver_recordset(); //DATOS DE LOS INTEGRANTES DE LA COMINISION
//                            }
//                        }
//                    }
                    
                    for ($i = 0;$i < count($fila[2]);$i++){
                        if($fila[2][$i]['identificador'] == 'I'){
                            $sql = "SELECT cedpersona AS cedula, nompersona AS nombre, apepersona AS apellido FROM personal_sector_comunidad WHERE idpersona='".$fila[2][$i]['idpersona']."'";                            
                        }else{
                            $sql = "SELECT ceddocente AS cedula, nomdocente AS nombre, apedocente AS apellido FROM docente WHERE iddocente='".$fila[2][$i]['iddocente']."'";
                        }
                        if($objEva->buscar($sql, $acceso)){
                            if($acceso->registros > 0){ 
                                $fila[3][$j++] = $acceso->devolver_recordset(); //DATOS DE LOS INTEGRANTES DE LA COMINISION
                            }
                        }
                    }
                    
                    $sql = "SELECT * FROM docente WHERE iddocente='".$fila[0]['iddocente']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[4] = $acceso->devolver_recordset();//DATOS DEL DOCENTE DEL PROYECTO
                        }
                    }
                    
                    $sql = "SELECT * FROM docente WHERE iddocente='".$fila[0]['doc_iddocente']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[5] = $acceso->devolver_recordset();//DATOS DEL TUTOR ACADEMICO
                        }
                    }
                    
                    $sql = "SELECT * FROM personal_sector_comunidad WHERE idpersona='".$fila[0]['idpersona']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[6] = $acceso->devolver_recordset();//DATOS DEL TUTOR COMUNITARIO
                        }
                    }
                    
                    $sql = "SELECT * FROM proyecto WHERE idproyecto='".$fila[0]['idproyecto']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[7] = $acceso->devolver_recordset();//DATOS DEL PROYECTO
                        }
                    }
                    
                    $sql = "SELECT * FROM consejo_comunal WHERE idsectorcomunidad='".$fila[6]['idsectorcomunidad']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[8] = $acceso->devolver_recordset();//DATOS DEL CONSEJO COMUNAL
                        }
                    }
                    
                    $sql = "SELECT * FROM sector_comunidad WHERE idsectorcomunidad='".$fila[6]['idsectorcomunidad']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[9] = $acceso->devolver_recordset();//DATOS DL SECTOR DE LA COMUNIDAD
                        }
                    }
                    
                    $sql = "SELECT * FROM comunidad WHERE idcomuni='".$fila[9]['idcomuni']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[10] = $acceso->devolver_recordset();//DATOS  DE LA COMUNIDAD
                        }
                    }
                    
                    $sql = "SELECT * FROM parroquia WHERE idparroquia='".$fila[10]['idparroquia']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[11] = $acceso->devolver_recordset();//DATOS DE LA PARROQUIA
                        }
                    }
                    
                    $sql = "SELECT * FROM municipio WHERE idmunicipio='".$fila[11]['idmunicipio']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[12] = $acceso->devolver_recordset();//DATOS DEL MUNICIPIO
                        }
                    }
                    
                    $sql = "SELECT * FROM estado WHERE idestado='".$fila[12]['idestado']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[13] = $acceso->devolver_recordset();//DATOS DEL ESTADO
                        }
                    }
                    
                    $sql = "SELECT * FROM grupo WHERE idgrupo='".$fila[0]['idgrupo']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[14] = $acceso->devolver_recordset();//DATOS DEL ESTADO
                        }
                    }
                    
                    $sql = "SELECT * FROM pnf WHERE idpnf='".$fila[7]['idpnf']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[15] = $acceso->devolver_recordset();//DATOS DEL ESTADO
                        }
                    }
                   
                    $sql = "SELECT * FROM periodo_academico WHERE idperiodo='".$fila[7]['idperiodo']."'";
                    if($objEva->buscar($sql, $acceso)){
                        if($acceso->registros > 0){
                            $fila[16] = $acceso->devolver_recordset();//DATOS DEL ESTADO
                        }
                    }
                    
                }else{
                    $fila = -1;
                }
            }else{
                $fila = -1;
            }
//            print_r($fila);   OJO 260613
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarDiagLet:
            $objDiag = new Diagnostico();
            if($objDiag->buscar("SELECT * FROM diagnostico WHERE idpnf='".$_POST['pnf']."' AND statusdiagnostico='INICIADO' AND descripdiagnostico LIKE '".strtoupper($_POST['letras'])."%'", $acceso)){
                if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[$i] = $acceso->devolver_recordset();
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }else{
                    $fila = 0;
                }
            }else{
                $fila = 0;
            }
            $json=new Services_JSON();
            $resp=$json->encode($fila);
            echo $resp;
        break;
        case buscarAgreEstu:
            $objEstudiante = new Estudiante();
            $cedula = $_POST['ced'];
/*################# NUEVO UPTOS ############################*/
//                $cedula='16818597';
                //token de seguridad
                $clientToken = 'b2fa185110314ab3ac3c080fa2aecb83';

                //dominio del directorio de personal y estudiantes
                $wsdl = 'http://api.iutcumana.edu.ve/1/directory/xml.php?wsdl';

                // crea cliente soap para buscar persona
                $client = new nusoap_client($wsdl, true);
                
                $ldap = $client->getProxy();
                
                if($client->fault) {
                        die('Error grave');
                } else {
                        if($client->getError())
                                die($client->getError());
                }
               // servicio para la busqueda de personas en el directorio
               $data = $ldap->searchPersonOnDirectory($clientToken,$cedula);
               
//               print_r('cedula: '.$data[0]['data'][0]['pin']);
               
               $sql = "SELECT * FROM estudiante WHERE cedestudiante='".$data[0]['data'][0]['pin']."'";
//               if($objEstudiante->buscar($sql, $acceso)){
                    $objEstudiante->buscar($sql, $acceso);
                   if($acceso->registros > 0){
                       // NO HACE NADA
                       print_r("NO REGISTRO"); 
                   }else{
                       if($objEstudiante->buscar("SELECT MAX(idestudiante) AS maximo FROM estudiante",$acceso)){
                            if($acceso->registros>0){
                                $row = $acceso->devolver_recordset();
                                $idestu = $row['maximo'] + 1;
                            }else{
                                $idestu = 1;
                            }
                       }
                       $sql = "INSERT INTO estudiante (idestudiante,cedestudiante,idusuario,idgrupo) VALUES ('".$idestu."','".$data[0]['data'][0]['pin']."','0','0')";
                       print_r($sql);                      
                       if($objEstudiante->setCedula($sql, $acceso)){
                           print_r("registro");                           die();
                           $data[0]['data'][0]['idInterno'] = $idestu;
                       }else{
                            print_r("no");  
                           $data = 5;
                       }
                   }
//               }else{
//                   print_r("data es 6");
//                   $data = 6;
//               }
               
                $json = new Services_JSON();
                $resp = $json->encode($data[0]['data'][0]);
                echo $resp;
/*################# NUEVO UPTOS ############################*/
            
//            if($objEstudiante->buscar("SELECT * FROM estudiante WHERE cedestudiante='".$ced."'", $acceso)){
//                if($acceso->registros > 0){
//                    $fila = $acceso->devolver_recordset();
//                }else{
//                    $fila = -1;
//                }
//            }else{
//                $fila = 0;
//            }
//            $json=new Services_JSON();
//            $resp=$json->encode($fila);
//            echo $resp;
        break;
} //fin switch
?>