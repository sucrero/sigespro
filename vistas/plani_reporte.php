<?php
    require '../clases/PDF_MC_Table.php';
    include_once '../Modelo.php';
   
    $objEva = new Evaluacion();
    $codEva = $_GET['codigo'];
    $motivo = $_GET['motivo'];
    $tipoG = $_GET['tipo'];
    $romanos = array("I","II","III","IV");
    
    if($tipoG == 'diagnostico'){
        $cod = 'iddiagnostico';
        $tipo = 'DIAGN&Oacute;STICO';
        $campo1 = 'trayectodiagnostico';
        $campo2 = 'trimestrediagnostico';
        $campo3 = 'descripdiagnosico';
        $campo4 = 'fechadiagnostico';
    }else if($tipoG == 'anteproyecto'){
        $cod = 'idantep';
        $tipo = 'ANTEPROYECTO';
        $campo1 = 'trayectoante';
        $campo2 = 'trimestreante';
        $campo3 = 'nomantep';
        $campo4 = 'fechaante';
    }else{
        $cod = 'idproyecto';
        $tipo = 'PROYECTO';
        $campo1 = 'trayectoproy';
        $campo2 = 'trimestreproy';
        $campo3 = 'nomproyecto';
        $campo4 = 'fechaproy';
    }
    
    $sql = "SELECT ".$campo1." AS trayecto,".$campo2." AS trimestre,".$campo3." AS titulo,".$campo4." AS fecha,idgrupo, 
        iddocente, doc_iddocente, idpersona, idpnf, idperiodo FROM ".$tipoG." WHERE ".$cod."='".$codEva."'";
    
    
//    $sql = "SELECT * FROM proyecto WHERE idproyecto='".$cod."'";
    if($objEva->buscar($sql, $acceso)){
        if($acceso->registros > 0){
            $fila[0] = $acceso->devolver_recordset();//DATOS DE LA EVALUACION

            $sql = "SELECT * FROM estudiante WHERE idgrupo='".$fila[0]['idgrupo']."'";
            if($objEva->buscar($sql, $acceso)){
                 if($acceso->registros > 0){
                    $i = 0;
                    do{
                        $fila[1][$i] = $acceso->devolver_recordset(); //ESTUDIANTES DEL GRUPO
                        $i++;
                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
                }
            }

//            $sql = "SELECT * FROM comision_tecnica WHERE codigocomision='".$fila[0]['idcomision']."'";
//            if($objEva->buscar($sql, $acceso)){
//                 if($acceso->registros > 0){
//                    $i = 0;
//                    do{
//                        $fila[2][$i] = $acceso->devolver_recordset(); //CODIGOS DE LOS MIEMBROS DE LA COMISION
//                        $i++;
//                    }while(($acceso->siguiente())&&($i!=$acceso->registros));
//                }
//            }
//            $j = 0;
//            for ($i = 0;$i < count($fila[2]);$i++){
//                if($fila[2][$i]['identificador'] == 'D'){
//                    $sql = "SELECT ceddocente AS cedula, nomdocente AS nombre, apedocente AS apellido FROM docente WHERE iddocente='".$fila[2][$i]['iddocente']."'";
//                }else{
//                    $sql = "SELECT cedpersona AS cedula, nompersona AS nombre, apepersona AS apellido FROM personal_sector_comunidad WHERE idpersona='".$fila[2][$i]['idpersona']."'";
//                }
//                if($objEva->buscar($sql, $acceso)){
//                    if($acceso->registros > 0){ 
//                        $fila[3][$j++] = $acceso->devolver_recordset(); //DATOS DE LOS INTEGRANTES DE LA COMINISION
//                    }
//                }
//            }

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

//            $sql = "SELECT * FROM proyecto WHERE idproyecto='".$fila[0]['idproyecto']."'";
//            if($objEva->buscar($sql, $acceso)){
//                if($acceso->registros > 0){
//                    $fila[7] = $acceso->devolver_recordset();//DATOS DEL PROYECTO
//                }
//            }

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

            $sql = "SELECT * FROM pnf WHERE idpnf='".$fila[0]['idpnf']."'";
            if($objEva->buscar($sql, $acceso)){
                if($acceso->registros > 0){
                    $fila[15] = $acceso->devolver_recordset();//DATOS DEL ESTADO
                }
            }

            $sql = "SELECT * FROM periodo_academico WHERE idperiodo='".$fila[0]['idperiodo']."'";
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
    


    class PDF extends PDF_MC_Table{
        function Header() {
            global $tipo;
            $size = 150;
            $absx = (210 - $size) / 2;
            $this->Image('../img/MembreteUPTOS.jpg', $absx, 5, $size);
            $this->Ln(10);
            //Movemos a la derecha
            $this->Cell(180);
            //Arial bold 15
            $this->SetFont('Arial', 'B', 5);
            $this->Cell(190,2, 'IMPRESO POR: '.$_SESSION['varEntrante'], 0, 1, 'C');
            //Salto de linea
            $this->Ln(10);
            //Arial bold 10
            $this->SetFont('Arial', 'B', 10);
            //Titulo
            $this->Cell(0, 10, html_entity_decode($tipo.' REPORTADO'), 0, 0, 'C');
        }
        
       function Footer() {
            $dias = array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            //Posicion a 1,5 cm del final DEL EJE Y
            $this->SetY(-15);
            //Arial italic 8
            $this->SetFont('Arial', 'I', 7);
            $this->SetTextColor(128);
            //Numero de pagina
            $this->Cell(60,4,  html_entity_decode($dias[date('w')]).' '.date('j').' de '.$meses[date('n')-1].' de '.date('Y').' - '.date("H:i:s"),0,0,'L');
            $this->Cell(60,4, 'Impreso por: '.html_entity_decode($_SESSION['varEntrante']), 0, 0, 'C');
            $this->Cell(0, 4, 'Pagina '.$this->PageNo().'/{nb}', 0, 1, 'R');
        }
        
        function titulo($titulo){
//            $this->SetFont('Arial', '', 8);
            $this->Ln(15);
            $this->MultiCell(0, 5, strtoupper(html_entity_decode(utf8_decode($titulo['titulo']))),0,'C');
            $this->Ln(4);
        }
        
        function contenido($datos){
            global $romanos;
            $this->SetFont('Arial','',7);
            //Movemos a la derecha
//            $this->Cell(180);
            $this->Ln(5);
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,html_entity_decode('PER&Iacute;ODO: '), 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(17, 5,$datos[16]['codperiodo'], 0, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,'TRAYECTO: ', 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(15, 5,$romanos[$datos[0]['trayecto']-1], 0, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(45, 5,'TRIMESTRE: ', 0, 0, 'R');
            $this->SetFont('Arial','',7);
            $this->Cell(17, 5,$romanos[$datos[0]['trimestre']-1], 0, 1, 'L');
            $this->Ln(5);
           
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'ESTADO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(44, 5,strtoupper(html_entity_decode(utf8_decode($datos[13]['descripestado']))), 1, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'MUNICIPIO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(44, 5,strtoupper(html_entity_decode(utf8_decode($datos[12]['descripmunicipio']))), 1, 0, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(20, 5,'PARROQUIA: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[11]['descripparroquia']))), 1, 1, 'L');
            
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'COMUNIDAD: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[10]['nomcomuni']))), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'SECTOR: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(html_entity_decode(utf8_decode($datos[9]['descripsector']))), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'RESPONSABLE: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
//            $detalle = split('-', $datos[6]['responsable']);
            $nac = substr($datos[6]['cedpersona'], 0, 1);
            $ced = substr($datos[6]['cedpersona'], 1);
            $this->Cell(0, 5,  $nac.' - '.$ced.'  '.strtoupper(utf8_decode($datos[6]['nompersona'].' '.$datos[6]['apepersona'])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'CONSEJO COMUNAL: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5,strtoupper(utf8_decode($datos[8]['nomconsejo'])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'FECHA DE REGISTRO: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $this->Cell(0, 5, cambiarFormatoFecha($datos[0]['fecha'],1), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,'DOCENTE: ', 1, 0, 'L');
            $this->SetFont('Arial','',7);
            $nac = substr($datos[4]['ceddocente'], 0, 1);
            $ced = substr($datos[4]['ceddocente'], 1);
            $this->Cell(0, 5, strtoupper($nac).' - '.number_format($ced,'0','','.').'  '.utf8_decode($datos[4]['nomdocente'].' '.$datos[4]['apedocente']), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Cell(38, 5,  html_entity_decode('TUTOR ACAD&Eacute;MICO: '), 1, 0, 'L');
            $this->SetFont('Arial','',7);
             $nac = substr($datos[5]['ceddocente'], 0, 1);
            $ced = substr($datos[5]['ceddocente'], 1);
            $this->Cell(0, 5, strtoupper($nac).' - '.number_format($ced,'0','','.').'  '.strtoupper(utf8_decode($datos[5]['nomdocente'].' '.$datos[5]['apedocente'])), 1, 1, 'L');
            $this->SetFont('Arial','B',7);
            $this->Ln(10);
        }
        function tablaGrupo($cont){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 5,'INTEGRANTE(S) DEL GRUPO ', 0, 1, 'C');
            //anchura de las columnas
            $w = array(10,25,0);
            //cabeceras de la tabla
            $cabecera = array('Nro.','C&Eacute;DULA','NOMBRES Y APELLIDOS');
            for($i=0;$i<count($cabecera);$i++){
                $this->Cell($w[$i], 7, html_entity_decode($cabecera[$i]), 1, 0, 'C');
            }
            $this->SetFont('Arial','',7);
            $this->Ln();
            for($i=0;$i<count($cont);$i++){
                $this->Cell($w[0], 7, $i+1, 1, 0, 'C');
                $nac = substr($cont[$i]['cedestudiante'], 0, 1);
                $ced = substr($cont[$i]['cedestudiante'], 1);
                $this->Cell($w[1], 7, strtoupper($nac).' - '.number_format($ced,'0','','.'), 1, 0, 'R');
                $this->Cell($w[2], 7, strtoupper(utf8_decode($cont[$i]['nomestudiante'].' '.$cont[$i]['apeestudiante'])), 1, 0, 'L');
                $this->Ln();
            }
            $this->Ln(10);
        }
        function tablaComision($cont){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 5,  html_entity_decode('INTEGRANTES DE LA COMISI&Oacute;N T&Eacute;CNICA'), 0, 1, 'C');
            //anchura de las columnas
            $w = array(10,25,0);
            //cabeceras de la tabla
            $cabecera = array('Nro.','C&Eacute;DULA','NOMBRES Y APELLIDOS');
            for($i=0;$i<count($cabecera);$i++){
                $this->Cell($w[$i], 7, html_entity_decode($cabecera[$i]), 1, 0, 'C');
            }
            $this->SetFont('Arial','',7);
            $this->Ln();
            for($i=0;$i<count($cont);$i++){
                $this->Cell($w[0], 7, $i+1, 1, 0, 'C');
                $nac = substr($cont[$i]['cedula'], 0, 1);
                $ced = substr($cont[$i]['cedula'], 1);
                $this->Cell($w[1], 7, strtoupper($nac).' - '.number_format($ced,'0','','.'), 1, 0, 'R');
                $this->Cell($w[2], 7, strtoupper(utf8_decode($cont[$i]['nombre'].' '.$cont[$i]['apellido'])), 1, 0, 'L');
                $this->Ln();
            }
            $this->Ln(10);
        }
       
        
        function observaciones($datos){
            $this->SetFont('Arial','IB',7);
            $this->Cell(0, 7, 'MOTIVO DEL REPORTE', 0, 1, 'C');
            $this->SetFont('Arial','',7);
            $this->MultiCell(0, 7,strtoupper(html_entity_decode(utf8_decode($datos))), 0, 'J', FALSE);
        }
    }
    
  
    $pdf = new PDF();
    
   
    $pdf->AliasNbPages();
   //$pdf->SetMargins(15, 15, 15);
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    $pdf->titulo($fila[0]);
    $pdf->contenido($fila);
    $pdf->tablaGrupo($fila[1]);
//    $pdf->tablaComision($fila[3]);
    $pdf->observaciones($motivo);

//    $nombre = "Planilla Diagnostico_".$codigoDiagnostico;
    $pdf->Output();
?>